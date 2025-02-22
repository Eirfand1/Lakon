<?php

namespace App\Http\Controllers;

use App\Models\Tim;
use Illuminate\Http\Request;

class TimController extends Controller
{
    public function store(Request $request){
        try{
            $request->merge([
                'bulan_1' => $request->has('bulan_1'),
                'bulan_2' => $request->has('bulan_2'),
                'bulan_3' => $request->has('bulan_3'),
                'bulan_4' => $request->has('bulan_4'),
                'bulan_5' => $request->has('bulan_5'),
                'bulan_6' => $request->has('bulan_6'),
                'bulan_7' => $request->has('bulan_7'),
                'bulan_8' => $request->has('bulan_8'),
                'bulan_9' => $request->has('bulan_9'),
                'bulan_10' => $request->has('bulan_10'),
                'bulan_11' => $request->has('bulan_11'),
                'bulan_12' => $request->has('bulan_12'),
            ]);

            $validateData = $request->validate([
                'kontrak_id' => 'required|exists:kontrak,kontrak_id',
                'nama' => 'required|string|max:255',
                'posisi' => 'required|string|max:255',
                'status_tenaga' => 'required|in:Tenaga Ahli,Tenaga Penunjang',
                'bulan_1' => 'boolean',
                'bulan_2' => 'boolean',
                'bulan_3' => 'boolean',
                'bulan_4' => 'boolean',
                'bulan_5' => 'boolean',
                'bulan_6' => 'boolean',
                'bulan_7' => 'boolean',
                'bulan_8' => 'boolean',
                'bulan_9' => 'boolean',
                'bulan_10' => 'boolean',
                'bulan_11' => 'boolean',
                'bulan_12' => 'boolean',
            ]);

            if ($request->tim_id) {
                Tim::where('tim_id', $request->tim_id)->update([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'nama' => $validateData['nama'],
                    'posisi' => $validateData['posisi'],
                    'status_tenaga' => $validateData['status_tenaga'],
                    'bulan_1' => $validateData['bulan_1'],
                    'bulan_2' => $validateData['bulan_2'],
                    'bulan_3' => $validateData['bulan_3'],
                    'bulan_4' => $validateData['bulan_4'],
                    'bulan_5' => $validateData['bulan_5'],
                    'bulan_6' => $validateData['bulan_6'],
                    'bulan_7' => $validateData['bulan_7'],
                    'bulan_8' => $validateData['bulan_8'],
                    'bulan_9' => $validateData['bulan_9'],
                    'bulan_10' => $validateData['bulan_10'],
                    'bulan_11' => $validateData['bulan_11'],
                    'bulan_12' => $validateData['bulan_12'],
                ]);
                return redirect()->back()->with('success', 'data berhasil diperbarui.');
            }else {
                Tim::create([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'nama' => $validateData['nama'],
                    'posisi' => $validateData['posisi'],
                    'status_tenaga' => $validateData['status_tenaga'],
                    'bulan_1' => $validateData['bulan_1'],
                    'bulan_2' => $validateData['bulan_2'],
                    'bulan_3' => $validateData['bulan_3'],
                    'bulan_4' => $validateData['bulan_4'],
                    'bulan_5' => $validateData['bulan_5'],
                    'bulan_6' => $validateData['bulan_6'],
                    'bulan_7' => $validateData['bulan_7'],
                    'bulan_8' => $validateData['bulan_8'],
                    'bulan_9' => $validateData['bulan_9'],
                    'bulan_10' => $validateData['bulan_10'],
                    'bulan_11' => $validateData['bulan_11'],
                    'bulan_12' => $validateData['bulan_12'],
                ]);

                return redirect()->back()->with('success', 'Data Tim berhasil disimpan.');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($tim_id){
        try{
            Tim::where('tim_id', $tim_id)->delete();
            return redirect()->back()->with('success', 'Data Tim berhasil dihapus.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
