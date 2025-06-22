<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon; 

class MemberController extends Controller
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

        $query = Member::query();

        // Pencarian
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('no_kartu', 'like', '%' . $search . '%')
                  ->orWhere('nama', 'like', '%' . $search . '%')
                  ->orWhere('alamat', 'like', '%' . $search . '%')
                  ->orWhere('no_hp', 'like', '%' . $search . '%');
            });
        }

        // Filter Jenis Kelamin
        if ($request->has('jk_filter') && !empty($request->jk_filter)) {
            $query->where('jk', $request->jk_filter);
        }

        $members = $query->paginate(10); 
        $members->appends($request->all());

        return view('members.index', compact('members'));
    }

    public function create()
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        return view('members.create');
    }

    public function store(Request $request)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $request->validate([
            'no_kartu' => 'required|unique:members',
            'nama' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tgl_lahir' => 'required|date',
            'tgl_mulai' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_mulai',
            'no_hp' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $member = new Member();
        $member->no_kartu = $request->no_kartu;
        $member->nama = $request->nama;
        $member->jk = $request->jk;
        $member->alamat = $request->alamat;
        $member->tgl_lahir = $request->tgl_lahir;
        $member->tgl_mulai = $request->tgl_mulai;
        $member->tgl_akhir = $request->tgl_akhir;
        $member->no_hp = $request->no_hp;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('members', 'public');
            $member->photo = $path;
        }

        $member->save();

        return redirect()->route('members.index')->with('success', 'Member berhasil ditambahkan!');
    }

    public function show(Member $member)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        $request->validate([
            'no_kartu' => 'required|unique:members,no_kartu,' . $member->id,
            'nama' => 'required|string|max:255',
            'jk' => 'required|in:L,P',
            'alamat' => 'required|string',
            'tgl_lahir' => 'required|date',
            'tgl_mulai' => 'required|date',
            'tgl_akhir' => 'required|date|after_or_equal:tgl_mulai',
            'no_hp' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'remove_photo' => 'nullable|boolean', 
        ]);

        $member->no_kartu = $request->no_kartu;
        $member->nama = $request->nama;
        $member->jk = $request->jk;
        $member->alamat = $request->alamat;
        $member->tgl_lahir = $request->tgl_lahir;
        $member->tgl_mulai = $request->tgl_mulai;
        $member->tgl_akhir = $request->tgl_akhir;
        $member->no_hp = $request->no_hp;

        // Handle photo removal
        if ($request->has('remove_photo') && $request->input('remove_photo')) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
                $member->photo = null;
            }
        } elseif ($request->hasFile('photo')) {
            if ($member->photo) {
                Storage::disk('public')->delete($member->photo);
            }
            $path = $request->file('photo')->store('members', 'public');
            $member->photo = $path;
        }

        $member->save();

        return redirect()->route('members.index')->with('success', 'Member berhasil diperbarui!');
    }

    public function destroy(Member $member)
    {
        $sessionCheck = $this->checkSession();
        if ($sessionCheck) return $sessionCheck;

        // Hapus foto terkait jika ada
        if ($member->photo) {
            Storage::disk('public')->delete($member->photo);
        }
        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member berhasil dihapus!');
    }
}