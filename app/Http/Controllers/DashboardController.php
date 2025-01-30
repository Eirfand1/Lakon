<?php

namespace App\Http\Controllers;

use App\Models\PaketPekerjaan;
use Illuminate\Http\Request;
use App\Models\DataFeed;

class DashboardController extends Controller
{
    public function index()
    {
        $paket_pekerjaan = PaketPekerjaan::count();
        $tender = PaketPekerjaan::where('jenis_pengadaan', 'tender')->count();
        $non_tender = PaketPekerjaan::where('jenis_pengadaan', 'non_tender')->count();
        $e_catalog = PaketPekerjaan::where('jenis_pengadaan', 'e_catalog')->count();
        $dataFeed = new DataFeed();

        return view('pages.admin.dashboard.dashboard', [
            "paket_pekerjaan" => $paket_pekerjaan,
            "tender" => $tender,
            "non_tender" => $non_tender,
            "e_catalog" => $e_catalog,
            'dataFeed' => $dataFeed
        ]);
    }

}
