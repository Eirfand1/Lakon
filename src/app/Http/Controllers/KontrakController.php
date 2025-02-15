<?php

namespace App\Http\Controllers;

use App\Exports\KontrakExport;
use App\Models\Kontrak;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KontrakController extends Controller
{
    //
    public function index()
    {
        return view("pages.admin.riwayat-kontrak.riwayat-kontrak", ['title' => 'riwayat kontrak']);
    }

    public function export()
    {
        return Excel::download(new KontrakExport, 'kontrak.xlsx');
    }


    public function store(Request $request)
    {
        try {
            $tahun = now()->year;
            $penyediaId = auth()->user()->penyedia->penyedia_id;
            $nomorKontrak = "KONTRAK/{$penyediaId}/P4/{$tahun}";

            $kontrak = Kontrak::create([
                'no_kontrak' => $nomorKontrak,
                'paket_id' => $request->paket_id,
                'penyedia_id' => $penyediaId,
                'satker_id' => 1,
                'tgl_pembuatan' => now()->toDateString(),
                'is_verificated' => false
            ]);

            return redirect()->route('penyedia.permohonan-kontrak.edit', ['kontrak' => $kontrak->id])->with('success', 'Kontrak berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Kontrak $kontrak)
    {
        return view('pages.penyedia.permohonan-kontrak.edit-kontrak', compact('kontrak'));
    }

    public function nonTenderKonsultasiPerencanaanEdit(Kontrak $kontrak){
        return view('pages.penyedia.permohonan-kontrak.non-tender_konsultasi-perencanaan', compact('kontrak'));
    }

    public function tenderJasaKonstruksiEdit(Kontrak $kontrak){
        return view('pages.penyedia.permohonan-kontrak.tender_jasa-konstruksi', compact('kontrak'));
    }

    public function nonTenderJasaKonstruksiEdit(Kontrak $kontrak){
        return view('pages.penyedia.permohonan-kontrak.non-tender_jasa-konstruksi', compact('kontrak'));
    }

    public function tenderJasaKonsultasiEdit(Kontrak $kontrak){
        return view('pages.penyedia.permohonan-kontrak.tender_jasa-konsultasi', compact('kontrak'));
    }

    public function update(Request $request, Kontrak $kontrak)
    {
        try {
            if ($kontrak->penyedia_id !== auth()->user()->penyedia->penyedia_id) {
                abort(403, 'Unauthorized action.');
            }

            $validatedData = $request->validate([
                'tgl_pembuatan' => now()->toDateString(),
            ]);

            $kontrak->update($validatedData);

            return redirect()->route('penyedia.dashboard', ['kontrak' => $kontrak->id])
                ->with('success', 'Permohonan Kontrak berhasil');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal melakukan Permohonan kontrak: ' . $e->getMessage());
        }
    }
}
