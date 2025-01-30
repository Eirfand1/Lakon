<?php

namespace App\Http\Controllers;

use App\Imports\SekolahImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SekolahController extends Controller
{
    //
    public function index(){
        return view("pages.admin.sekolah.sekolah", ["title" => "sekolah"]);
    }

    public function showImport() {
        return view("pages.admin.sekolah.import-excel");
    }
    public function import(Request $request)
    {
        try{
            $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv'
            ]);
            
            Excel::import(new SekolahImport, $request->file('file'));

            return redirect()->back()->with('success', 'Data berhasil diimpor!');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
        


    }
}
