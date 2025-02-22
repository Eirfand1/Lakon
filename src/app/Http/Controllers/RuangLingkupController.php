<?php

namespace App\Http\Controllers;

use App\Models\RuangLingkup;
use Illuminate\Http\Request;

class RuangLingkupController extends Controller
{
    public function store(Request $request){
        try{
            $validateData = $request->validate([
                'kontrak_id' => 'required|exists:kontrak,kontrak_id',
                'ruang_lingkup' => 'required|string|max:255',
            ]);

            $dasarHukum = RuangLingkup::create([
                'kontrak_id' => $validateData['kontrak_id'],
                'ruang_lingkup' => $validateData['ruang_lingkup'],
            ]);

            return redirect()->back()->with('success', 'Ruang Lingkup berhasil disimpan.');

        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
