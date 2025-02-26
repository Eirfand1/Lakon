<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DasarHukum;
use Illuminate\Database\QueryException;

class DasarHukumController extends Controller
{
    //

    public function index()
    {
        return view("pages.admin.dasar-hukum.dasar-hukum");
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'dasar_hukum' => 'required|string|max:255',
        ]);

        DasarHukum::create([
            'dasar_hukum' => $validateData['dasar_hukum'],
        ]);
        return redirect()->back()->with('success', 'Dasar Hukum berhasil disimpan.');

    }

    public function update(Request $request, DasarHukum $dasarHukum)
    {
        $validateData = $request->validate([
            'dasar_hukum' => 'required|string|max:255',
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
