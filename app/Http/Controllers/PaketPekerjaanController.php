<?php

namespace App\Http\Controllers;

use App\Models\DasarHukum;
use App\Models\PaketPekerjaan;
use App\Models\SatuanKerja;
use App\Models\SubKegiatan;
use Illuminate\Http\Request;

class PaketPekerjaanController extends Controller
{
    public function index()
    {
        $pakets = PaketPekerjaan::with('subKegiatan')->get();
        return view('pages.admin.paket-pekerjaan.paket-pekerjaan', [
            "title" => "paket-pekerjaan",
            "paket" => $pakets,
            "dasarHukum" => DasarHukum::all(),
            "subKegiatan" => SubKegiatan::all(),
            "satuanKerja" => SatuanKerja::all(),
        ]);
    }

}
