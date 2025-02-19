<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DasarHukum;
use Illuminate\Database\QueryException;

class DasarHukumController extends Controller
{
    //

    public function index(){
        return view("pages.admin.dasar-hukum.dasar-hukum");
    }

    public function store(Request $request){
        $dasarHukum = DasarHukum::create([
            'dasar_hukum' => $request->dasar_hukum
        ]);
    }

    public function update(Request $request, DasarHukum $dasarHukum){
        try{
            $validateData = $request->validate([
                'dasar_hukum' => 'required|string|max:255',
            ]);

            $dasarHukum->update($validateData);
            return redirect()->back()->with('success', 'Data berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', $e->getMessage());
        }

    }

    public function destroy(DasarHukum $dasarHukum)
    {
        try {
            $dasarHukum->delete();
            return redirect()->back()->with('success', 'Data berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', $e->getMessage());
        }
    }
}
