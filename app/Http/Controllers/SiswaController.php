<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(): View
    {
        $siswa = Siswa::latest()->paginate(10);
        return view('siswa.index', compact('siswa'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    public function create(): View
    {
        return view('siswa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required',
            'gender' => 'required|in:M,F',
            'kelas' => 'required|in:X,XI,XII,XIII',
            'rombel' => 'required|in:A,B',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Upload foto
        $foto = $request->file('foto');
        $foto->storeAs('public/foto_siswa', $foto->hashName());

        Siswa::create([
            'nama' => $request->nama,
            'nis' => $request->nis,
            'gender' => $request->gender,
            'kelas' => $request->kelas,
            'rombel' => $request->rombel,
            'foto' => $foto->hashName()
        ]);

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function show(Siswa $siswa): View
    {
        return view('siswa.show', compact('siswa'));
    }

    public function edit(Siswa $siswa): View
    {
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa): RedirectResponse
    {
        $request->validate([
            'nama' => 'required',
            'nis' => 'required',
            'gender' => 'required|in:M,F',
            'kelas' => 'required|in:X,XI,XII,XIII',
            'rombel' => 'required|in:A,B',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('foto')) {
            // Upload foto baru
            $fotoBaru = $request->file('foto');
            $fotoBaru->storeAs('public/foto_siswa', $fotoBaru->hashName());

            // Hapus foto lama
            Storage::delete('public/foto_siswa/' . $siswa->foto);

            // Update data siswa dengan foto baru
            $siswa->update([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'gender' => $request->gender,
                'kelas' => $request->kelas,
                'rombel' => $request->rombel,
                'foto' => $fotoBaru->hashName()
            ]);
        } else {
            // Update data siswa tanpa mengubah foto
            $siswa->update([
                'nama' => $request->nama,
                'nis' => $request->nis,
                'gender' => $request->gender,
                'kelas' => $request->kelas,
                'rombel' => $request->rombel,
            ]);
        }

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa): RedirectResponse
    {
        // Hapus foto siswa
        Storage::delete('public/foto_siswa/' . $siswa->foto);

        // Hapus data siswa
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
