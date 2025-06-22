<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon; // Pastikan Carbon diimport

class VisitorController extends Controller
{
    // Global helper function for session check (Moved from web.php for better encapsulation)
    private function checkSession()
    {
        // Adjust 'user_email' or 'user_id' based on your actual session key
        if (!session()->has('user_email') && !session()->has('user_id')) {
            return redirect()->route('login')->send();
        }
        return null; // Return null if session is active
    }

    public function index(Request $request)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $query = Visitor::query();

        // Pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('no_kartu', 'like', '%' . $search . '%');
            });
        }

        // Filter Status
        if ($request->has('status_filter') && !empty($request->status_filter)) {
            $query->where('status', $request->status_filter);
        }

        // Order by latest entry
        $query->orderBy('waktu_masuk', 'desc');

        $visitors = $query->paginate(10);
        $visitors->appends($request->all());

        return view('visitors.index', compact('visitors'));
    }

    public function create()
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $members = Member::all();
        return view('visitors.create', compact('members'));
    }

    public function store(Request $request)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $request->validate([
            'no_kartu' => 'nullable|string|exists:members,no_kartu',
            'nama' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:in,out',
            'waktu_masuk' => 'required|date',
            'waktu_keluar' => 'nullable|date|after_or_equal:waktu_masuk',
        ]);

        $visitor = new Visitor();
        $visitor->no_kartu = $request->no_kartu;
        $visitor->nama = $request->nama;
        $visitor->status = $request->status;
        $visitor->waktu_masuk = $request->waktu_masuk;
        $visitor->waktu_keluar = $request->waktu_keluar;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('visitors', 'public');
            $visitor->photo = $path;
        }

        $visitor->save();

        return redirect()->route('visitors.index')->with('success', 'Pengunjung berhasil ditambahkan!');
    }

    public function show(Visitor $visitor)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        return view('visitors.show', compact('visitor'));
    }

    public function edit(Visitor $visitor)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $members = Member::all();
        return view('visitors.edit', compact('visitor', 'members'));
    }

    public function update(Request $request, Visitor $visitor)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $request->validate([
            'no_kartu' => 'nullable|string|exists:members,no_kartu',
            'nama' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_photo' => 'nullable|boolean', // Untuk checkbox hapus foto
            'status' => 'required|in:in,out',
            'waktu_masuk' => 'required|date',
            'waktu_keluar' => 'nullable|date|after_or_equal:waktu_masuk',
        ]);

        $visitor->no_kartu = $request->no_kartu;
        $visitor->nama = $request->nama;
        $visitor->status = $request->status;
        $visitor->waktu_masuk = $request->waktu_masuk;
        $visitor->waktu_keluar = $request->waktu_keluar;

        // Handle photo removal
        if ($request->has('remove_photo') && $request->input('remove_photo')) {
            if ($visitor->photo) {
                Storage::disk('public')->delete($visitor->photo);
                $visitor->photo = null;
            }
        } elseif ($request->hasFile('photo')) {
            // Hapus foto lama jika ada dan ada foto baru diunggah
            if ($visitor->photo) {
                Storage::disk('public')->delete($visitor->photo);
            }
            $path = $request->file('photo')->store('visitors', 'public');
            $visitor->photo = $path;
        }

        $visitor->save();

        return redirect()->route('visitors.index')->with('success', 'Pengunjung berhasil diperbarui!');
    }

    public function destroy(Visitor $visitor)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        if ($visitor->photo) {
            Storage::disk('public')->delete($visitor->photo);
        }
        $visitor->delete();
        return redirect()->route('visitors.index')->with('success', 'Pengunjung berhasil dihapus!');
    }
}