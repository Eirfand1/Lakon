<?php

namespace App\Http\Controllers;

use App\Models\SatuanKerja;
use App\Models\PaketPekerjaan;
use Illuminate\Http\Request;
use App\Models\DataFeed;
use Illuminate\Database\QueryException;

class DashboardController extends Controller
{
    public function index()
    {
        $profile_pimpinan = SatuanKerja::where('satker_id', '=', '1')->firstOrFail();
        $paket_pekerjaan = PaketPekerjaan::count();
        $tender = PaketPekerjaan::where('jenis_pengadaan', 'tender')->count();
        $non_tender = PaketPekerjaan::where('jenis_pengadaan', 'non_tender')->count();
        $e_catalog = PaketPekerjaan::where('jenis_pengadaan', 'e_catalog')->count();
        $dataFeed = new DataFeed();

        return view('pages.admin.dashboard.dashboard', [
            "profile_pimpinan" => $profile_pimpinan,
            "paket_pekerjaan" => $paket_pekerjaan,
            "tender" => $tender,
            "non_tender" => $non_tender,
            "e_catalog" => $e_catalog,
            'dataFeed' => $dataFeed
        ]);
    }

    public function update(Request $request, SatuanKerja $pimpinan)
    {
        try{
            $validateData = $request->validate([
                'nama_pimpinan' => 'required|string|max:255',
                'nip' => 'required|string|max:255',
                'jabatan' => 'required|string|max:255',
                'website' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'telp' => 'required|string|max:255',
                'klpd' => 'required|string|max:255'
            ]);
            $pimpinan->update($validateData);
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

}
