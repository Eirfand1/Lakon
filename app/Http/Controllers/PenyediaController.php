<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PenyediaController extends Controller
{
    //
    public function index(): View
    {
        return view('pages.penyedia.penyedia', ["title" => "penyedia"]);
    }
}
