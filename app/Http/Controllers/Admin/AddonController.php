<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Addon;

class AddonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addons = Addon::orderBy('nama_barang')->get();

        return view('admin.addon.index', compact('addons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'harga' => 'required|numeric',
            'status' => 'required'
        ]);

        Addon::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'status' => $request->status
        ]);

        return redirect()
                ->route('admin.addon.index')
                ->with('success','Barang tambahan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $addon = Addon::findOrFail($id);

        return view('admin.addon.edit', compact('addon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_barang' => 'required|max:255',
            'harga' => 'required|numeric',
            'status' => 'required'
        ]);

        $addon = Addon::findOrFail($id);

        $addon->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'status' => $request->status
        ]);

        return redirect()
                ->route('admin.addon.index')
                ->with('success', 'Barang tambahan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $addon = Addon::findOrFail($id);

        $addon->delete();

        return redirect()
                ->route('admin.addon.index')
                ->with('success', 'Barang tambahan berhasil dihapus');
    }
}
