<?php

namespace App\Http\Controllers;

use App\Exports\DasarHukumExport;
use Illuminate\Http\Request;
use App\Models\DasarHukum;
use Maatwebsite\Excel\Facades\Excel;

class DasarHukumController extends Controller
{
    public function index()
    {
        return view("pages.admin.dasar-hukum.dasar-hukum");
    }

    public function exportDaskum()
    {
        return Excel::download(new DasarHukumExport, "daskum.xlsx");
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tahun' => 'required|numeric',
            'dasar_hukum' => 'required|string',
        ]);

        DasarHukum::create([
            'tahun' => $validateData['tahun'],
            'dasar_hukum' => $validateData['dasar_hukum'],
        ]);
        return redirect()->back()->with('success', 'Dasar Hukum berhasil disimpan.');
    }

    public function update(Request $request, DasarHukum $dasarHukum)
    {
        $validateData = $request->validate([
            'tahun' => 'required|numeric',
            'dasar_hukum' => 'required|string',
        ]);

        $dasarHukum->update($validateData);
        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(DasarHukum $dasarHukum)
    {
        $dasarHukum->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
