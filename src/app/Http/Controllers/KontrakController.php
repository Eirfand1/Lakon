<?php

namespace App\Http\Controllers;

use App\Exports\KontrakExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KontrakController extends Controller
{
    //
    public function index(){
        return view("pages.admin.riwayat-kontrak.riwayat-kontrak", ['title' => 'riwayat kontrak']);
    }

    public function export(){
        return Excel::download(new KontrakExport, 'kontrak.xlsx');
    }
}
