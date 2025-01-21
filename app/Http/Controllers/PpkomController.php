<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class PpkomController extends Controller
{
    public function index(): View
    {
        return view('pages.admin.ppkom', ["title" => "ppkom"]);
    }
}
