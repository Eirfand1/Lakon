<?php

namespace App\Http\Controllers;

use App\Models\PaketPekerjaan;
use Illuminate\Http\Request;

class PaketPekerjaanController extends Controller
{
    public function index()
    {
        $pakets = PaketPekerjaan::with('subKegiatan')->get();
        return view('pages.admin.paket-pekerjaan.paket-pekerjaan', ["title" => "paket-pekerjaan", "paket" => $pakets]);
    }

}
