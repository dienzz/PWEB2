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

        $query = Laporan::query()->with(['member', 'payment']); 

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
        $payments = Payment::all(); 
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
            'payment_id' => 'nullable|exists:payments,id',
        ]);

        $laporan = new Laporan();
        $laporan->no_kartu = $request->no_kartu;
        $laporan->tanggal = $request->tanggal;
        $laporan->jenis_pemasukan = $request->jenis_pemasukan;
        $laporan->jumlah = $request->jumlah;
        $laporan->payment_id = $request->payment_id; 

        if ($request->payment_id) {
            $payment = Payment::find($request->payment_id);
            if ($payment && $request->jumlah != $payment->harga) {
                $laporan->jumlah = $payment->harga; 
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

        $laporan->load('member', 'payment'); 
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