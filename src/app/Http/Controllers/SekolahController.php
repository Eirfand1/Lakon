<?php

namespace App\Http\Controllers;

use App\Imports\SekolahImport;
use App\Models\Sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;

class SekolahController extends Controller
{
    //
    public function index()
    {
        return view("pages.admin.sekolah.sekolah", ["title" => "sekolah"]);
    }

    public function showImport()
    {
        return view("pages.admin.sekolah.import-excel");
    }
    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls,csv'
            ]);

            Excel::import(new SekolahImport, $request->file('file'));

            return redirect()->back()->with('success', 'Data berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validateData = $request->validate([
                'npsn' => 'required|numeric|unique:sekolah,npsn',
                'nama_sekolah' => 'required|string|max:150',
                'jenjang' => 'required|in:SD,SMP,SMA,SMK',
                'status' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'desa' => 'required|string|max:100',
                'kecamatan' => 'required|string|max:100',
                'koordinat' => 'nullable',
            ]);

            // Parse input koordinat (format: "latitude,longitude")
            if ($validateData['koordinat']) {
                $koordinat = explode(',', $validateData['koordinat']);
                $latitude = trim($koordinat[0]);
                $longitude = trim($koordinat[1]);
                $koordinat = DB::raw("POINT($latitude, $longitude)");
            }else {
                $koordinat = null;
            }

            $sekolah = Sekolah::create([
                'npsn' => $validateData['npsn'],
                'nama_sekolah' => $validateData['nama_sekolah'],
                'jenjang' => $validateData['jenjang'],
                'status' => $validateData['status'],
                'alamat' => $validateData['alamat'],
                'desa' => $validateData['desa'],
                'kecamatan' => $validateData['kecamatan'],
                'koordinat' => $koordinat,
            ]);
            return redirect()->back()->with('success', 'Sekolah berhasil disimpan.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function update(Request $request, Sekolah $sekolah)
    {
        try {
            $validateData = $request->validate([
                'npsn' => 'required|numeric|unique:sekolah,npsn,' . $sekolah->sekolah_id . ',sekolah_id',
                'nama_sekolah' => 'required|string|max:150',
                'jenjang' => 'required|in:SD,SMP,SMA,SMK',
                'status' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'desa' => 'required|string|max:100',
                'kecamatan' => 'required|string|max:100',
                'koordinat' => 'nullable',
            ]);

            // Parse input koordinat (format: "latitude,longitude")
            if ($validateData['koordinat']) {
                $koordinat = explode(',', $validateData['koordinat']);
                $latitude = trim($koordinat[0]);
                $longitude = trim($koordinat[1]);
                $koordinat = DB::raw("POINT($latitude, $longitude)");
            }else {
                $koordinat = null;
            }

            $sekolah->update([
                'npsn' => $validateData['npsn'],
                'nama_sekolah' => $validateData['nama_sekolah'],
                'jenjang' => $validateData['jenjang'],
                'status' => $validateData['status'],
                'alamat' => $validateData['alamat'],
                'desa' => $validateData['desa'],
                'kecamatan' => $validateData['kecamatan'],
                'koordinat' => $koordinat,
            ]);

            return redirect()->back()->with('success', 'Data sekolah berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function destroy(Sekolah $sekolah)
    {
        try {
            $sekolah->delete();
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
