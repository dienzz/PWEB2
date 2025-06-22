<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Member;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with('member');

        // Filter berdasarkan search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where('no_kartu', 'like', "%{$search}%")
                  ->orWhereHas('member', function ($q) use ($search) {
                      $q->where('nama', 'like', "%{$search}%");
                  });
        }

        // Filter berdasarkan jenis_langganan
        if ($request->has('jenis_langganan_filter') && $request->jenis_langganan_filter != '') {
            $query->where('jenis_langganan', $request->jenis_langganan_filter);
        }

        // Filter berdasarkan status
        if ($request->has('status_filter') && $request->status_filter != '') {
            $query->where('status', $request->status_filter);
        }

        // Filter berdasarkan bulan dan tahun
        if ($request->has('month_filter') && $request->month_filter != '') {
            $query->whereMonth('tanggal_pembayaran', $request->month_filter);
        }
        if ($request->has('year_filter') && $request->year_filter != '') {
            $query->whereYear('tanggal_pembayaran', $request->year_filter);
        }

        $months = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
        ];

        $payments = $query->paginate(10);

        return view('payments.index', compact('payments', 'months'));
    }

    public function create()
    {
        $members = Member::all();
        return view('payments.create', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kartu' => 'required|string|exists:members,no_kartu',
            'jenis_langganan' => 'required|in:harian,mingguan,bulanan',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,failed',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $payment = Payment::create($request->all());

        // Opsional: Buat laporan otomatis jika status completed
        if ($request->status == 'completed') {
            $laporan = $payment->laporan()->create([
                'no_kartu' => $payment->no_kartu,
                'tanggal' => now(),
                'jenis_pemasukan' => 'langganan',
                'jumlah' => $payment->harga,
            ]);
        }

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil ditambahkan.');
    }

    public function show($id)
    {
        $payment = Payment::with('member')->findOrFail($id);
        return view('payments.show', compact('payment'));
    }

    public function edit($id)
    {
        $payment = Payment::with('member')->findOrFail($id);
        $members = Member::all();
        return view('payments.edit', compact('payment', 'members'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'no_kartu' => 'required|string|exists:members,no_kartu',
            'jenis_langganan' => 'required|in:harian,mingguan,bulanan',
            'harga' => 'required|numeric|min:0',
            'status' => 'required|in:pending,completed,failed',
            'tanggal_pembayaran' => 'required|date',
        ]);

        $payment->update($request->all());

        // Opsional: Perbarui laporan jika ada
        if ($payment->laporan && $request->status == 'completed' && $payment->laporan->jumlah != $request->harga) {
            $payment->laporan()->update(['jumlah' => $request->harga]);
        }

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}