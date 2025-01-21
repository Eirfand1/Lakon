<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaketPekerjaanController extends Controller
{
    public function index()
    {
        return view('pages.paket-pekerjaan.paket-pekerjaan', ["title" => "paket-pekerjaan"]);
    }
}
