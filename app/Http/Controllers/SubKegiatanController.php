<?php

namespace App\Http\Controllers;

use App\Models\SubKegiatan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SubKegiatanController extends Controller
{
    public function index()
    {
        return view("pages.admin.sub-kegiatan.sub-kegiatan");
    }

    public function store(Request $request)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(Request $request, SubKegiatan $subKegiatan)
    {
        try {
            $validateData = $request->validate([
                'no_rekening' => 'required|numeric',
                'nama_sub_kegiatan' => 'required|string|max:255',
                'gabungan' => 'required|string|max:255',
                'pendidikan' => 'required|string|max:255',
            ]);
            $subKegiatan->update($validateData);
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }
    public function destroy(SubKegiatan $subKegiatan)
    {
        try {
            $subKegiatan->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
