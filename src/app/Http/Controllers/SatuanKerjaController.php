<?php

namespace App\Http\Controllers;

use App\Models\SatuanKerja;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SatuanKerjaController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.satuan-kerja.satuan-kerja', [
            "title" => "satuan-kerja",
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nip' => 'required|unique:satuan_kerja|max:255',
            'nama_pimpinan' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'website' => 'nullable|url|max:255',
            'email' => 'required|email|max:255',
            'telp' => 'required|max:255',
            'klpd' => 'required|max:255',
        ]);

        SatuanKerja::create($validated);
        return redirect()->back()->with('success', 'Data satuan kerja berhasil ditambahkan.');
    }

    public function update(Request $request, SatuanKerja $satuanKerja): RedirectResponse
    {
        $validated = $request->validate([
            'nip' => 'required|unique:satuan_kerja,nip,' . $satuanKerja->satker_id . ',satker_id|max:255',
            'nama_pimpinan' => 'required|max:255',
            'jabatan' => 'required|max:255',
            'website' => 'nullable|url|max:255',
            'email' => 'required|email|max:255',
            'telp' => 'required|max:255',
            'klpd' => 'required|max:255',
        ]);

        $satuanKerja->update($validated);
        return redirect()->back()->with('success', 'Data satuan kerja berhasil diperbarui.');
    }

    public function destroy(SatuanKerja $satuanKerja): RedirectResponse
    {
        $satuanKerja->delete();
        return redirect()->back()->with('success', 'Data satuan kerja berhasil dihapus.');
    }
}
