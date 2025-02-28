<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RealisasiController extends Controller
{
    //
    public function index() {
        return view('pages.admin.realisasi.realisasi');
    }
}
