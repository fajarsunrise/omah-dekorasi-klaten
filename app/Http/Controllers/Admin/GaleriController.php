<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();

        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $namaFoto = time().'.'.$request->foto->extension();

        $request->foto->move(public_path('uploads/galeri'), $namaFoto);

        Galeri::create([
            'judul' => $request->judul,
            'foto' => $namaFoto,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success','Foto berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul' => $request->judul ?: null,
        ];

        if ($request->hasFile('foto')) {

            // hapus foto lama
            $fotoLama = public_path('uploads/galeri' . $galeri->foto);

            if (file_exists($fotoLama)) {
                unlink($fotoLama);
            }

            // upload foto baru
            $namaFoto = time().'.'.$request->foto->extension();

            $request->foto->move(public_path('uploads/galeri'), $namaFoto);

            $data['foto'] = $namaFoto;
        }

        $galeri->update($data);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri)
    {
        if(file_exists(public_path('uploads/galeri'.$galeri->foto))){
            unlink(public_path('uploads/galeri'.$galeri->foto));
        }

        $galeri->delete();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success','Galeri berhasil dihapus.');
    }
}
