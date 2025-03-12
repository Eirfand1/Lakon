<?php

namespace App\Http\Controllers;

use App\Exports\SubKegiatanExport;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;

class SubKegiatanController extends Controller
{
    public function index()
    {
        return view("pages.admin.sub-kegiatan.sub-kegiatan");
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_rekening' => 'required|numeric',
            'nama_sub_kegiatan' => 'required|string|max:255',
            'gabungan' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
        ]);

        $dasarHukum = SubKegiatan::create([
            'no_rekening' => $validateData['no_rekening'],
            'nama_sub_kegiatan' => $validateData['nama_sub_kegiatan'],
            'gabungan' => $validateData['gabungan'],
            'pendidikan' => $validateData['pendidikan'],
        ]);
        return redirect()->back()->with('success', 'Sub Kegiatan berhasil disimpan.');
    }
    public function update(Request $request, SubKegiatan $subKegiatan)
    {
        $validateData = $request->validate([
            'no_rekening' => 'required|numeric',
            'nama_sub_kegiatan' => 'required|string|max:255',
            'gabungan' => 'required|string|max:255',
            'pendidikan' => 'required|string|max:255',
        ]);
        $subKegiatan->update($validateData);
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }
    public function destroy(SubKegiatan $subKegiatan)
    {
        $subKegiatan->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function exportSubKegiatan() {
        return Excel::download(new SubKegiatanExport, 'sub-kegaitan.xlsx');
    }
}
