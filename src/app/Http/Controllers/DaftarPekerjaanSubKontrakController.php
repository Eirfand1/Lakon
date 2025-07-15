<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DaftarPekerjaanSubKontrak;

class DaftarPekerjaanSubKontrakController extends Controller
{
    public function store(Request $request){
        try{
            $validateData = $request->validate([
                'kontrak_id' => 'required|exists:kontrak,kontrak_id',
                'bagian_pekerjaan' => 'required|string|max:255',
                'nama_sub_penyedia' => 'required|string|max:255',
                'alamat_sub_penyedia' => 'required|string|max:255',
                'kualifikasi_sub_penyedia' => 'required|string|max:255',
                'keterangan' => 'nullable|string',
            ]);

            if ($request->daftar_pekerjaan_sub_kontrak_id) {
                DaftarPekerjaanSubKontrak::where('daftar_pekerjaan_sub_kontrak_id', $request->daftar_pekerjaan_sub_kontrak_id)->update([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'bagian_pekerjaan' => $validateData['bagian_pekerjaan'],
                    'nama_sub_penyedia' => $validateData['nama_sub_penyedia'],
                    'alamat_sub_penyedia' => $validateData['alamat_sub_penyedia'],
                    'kualifikasi_sub_penyedia' => $validateData['kualifikasi_sub_penyedia'],
                    'keterangan' => $validateData['keterangan'],
                ]);
                return redirect()->back()->with('success', 'Data Pekerjaan Sub Kontrak berhasil diperbarui.')->withFragment('daftarPekerjaanSubKontrak');
            }else {
                DaftarPekerjaanSubKontrak::create([
                    'kontrak_id' => $validateData['kontrak_id'],
                    'bagian_pekerjaan' => $validateData['bagian_pekerjaan'],
                    'nama_sub_penyedia' => $validateData['nama_sub_penyedia'],
                    'alamat_sub_penyedia' => $validateData['alamat_sub_penyedia'],
                    'kualifikasi_sub_penyedia' => $validateData['kualifikasi_sub_penyedia'],
                    'keterangan' => $validateData['keterangan'],
                ]);
                return redirect()->back()->with('success', 'Data Pekerjaan Sub Kontrak berhasil disimpan.')->withFragment('daftarPekerjaanSubKontrak');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withFragment('daftarPekerjaanSubKontrak');
        }
    }

    public function destroy($id){
        try{
            DaftarPekerjaanSubKontrak::where('daftar_pekerjaan_sub_kontrak_id', $id)->delete();
            return redirect()->back()->with('success', 'Data Pekerjaan Sub Kontrak berhasil dihapus.')->withFragment('daftarPekerjaanSubKontrak');
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withFragment('daftarPekerjaanSubKontrak');
        }
    }
}
