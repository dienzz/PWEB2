<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Member;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class LaporanController extends Controller
{
    private function checkSession()
    {
        if (!session()->has('user_email') && !session()->has('user_id')) {
            return redirect()->route('login')->send();
        }
        return null;
    }

    public function index(Request $request)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $query = Laporan::query()->with(['member', 'payment']); // Eager load both member and payment

        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('no_kartu', 'like', '%' . $search . '%')
                  ->orWhere('jumlah', 'like', '%' . $search . '%')
                  ->orWhereHas('member', function ($qr) use ($search) {
                      $qr->where('nama', 'like', '%' . $search . '%');
                  });
            });
        }

        if ($request->has('jenis_pemasukan_filter') && !empty($request->jenis_pemasukan_filter)) {
            $query->where('jenis_pemasukan', $request->jenis_pemasukan_filter);
        }

        if ($request->has('month_filter') && !empty($request->month_filter)) {
            $query->whereMonth('tanggal', $request->month_filter);
        }
        if ($request->has('year_filter') && !empty($request->year_filter)) {
            $query->whereYear('tanggal', $request->year_filter);
        }

        $query->orderBy('tanggal', 'desc')->orderBy('created_at', 'desc');

        $laporans = $query->paginate(10);
        $laporans->appends($request->all());

        $months = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[$i] = Carbon::create()->month($i)->format('F');
        }

        return view('laporans.index', compact('laporans', 'months'));
    }

    public function create()
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $members = Member::all();
        $payments = Payment::all(); // Tambahkan daftar pembayaran untuk dropdown
        return view('laporans.create', compact('members', 'payments'));
    }

    public function store(Request $request)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $request->validate([
            'no_kartu' => 'required|string|exists:members,no_kartu',
            'tanggal' => 'required|date',
            'jenis_pemasukan' => 'required|in:pendaftaran,langganan',
            'jumlah' => 'required|numeric|min:0',
            'payment_id' => 'nullable|exists:payments,id', // Validasi untuk payment_id
        ]);

        $laporan = new Laporan();
        $laporan->no_kartu = $request->no_kartu;
        $laporan->tanggal = $request->tanggal;
        $laporan->jenis_pemasukan = $request->jenis_pemasukan;
        $laporan->jumlah = $request->jumlah;
        $laporan->payment_id = $request->payment_id; // Simpan payment_id jika ada

        // Hapus validasi manual yang menyebabkan error
        // Jika Anda tetap ingin memvalidasi jumlah dengan harga, gunakan pendekatan lain (misalnya, pesan info)
        if ($request->payment_id) {
            $payment = Payment::find($request->payment_id);
            if ($payment && $request->jumlah != $payment->harga) {
                // Alih-alih error, beri peringatan atau sesuaikan jumlah secara otomatis
                $laporan->jumlah = $payment->harga; // Set jumlah sesuai harga pembayaran
                // Atau tambahkan pesan info untuk pengguna
                session()->flash('info', 'Jumlah telah disesuaikan dengan harga pembayaran (' . number_format($payment->harga, 2, ',', '.') . ' Rp).');
            }
        }

        $laporan->save();

        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil ditambahkan!');
    }

    public function show(Laporan $laporan)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $laporan->load('member', 'payment'); // Eager load both relationships
        return view('laporans.show', compact('laporan'));
    }

    public function destroy(Laporan $laporan)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $laporan->delete();
        return redirect()->route('laporans.index')->with('success', 'Laporan berhasil dihapus!');
    }
}