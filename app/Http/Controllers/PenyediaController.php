<?php

namespace App\Http\Controllers;

use App\Models\Penyedia;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Google\Client;
use Google\Service\Drive;

class PenyediaController extends Controller
{

    public function index(): View
    {
        try {
            $penyedia = Penyedia::all();
            return view('pages.admin.penyedia.penyedia', [
                "title" => "penyedia",
                'penyedia' => $penyedia,
            ]);
        } catch (\Exception $e) {
            return view('pages.admin.penyedia.penyedia', [
                "title" => "penyedia",
                'penyedia' => [],
            ])->with('error', 'Terjadi kesalahan saat mengambil data.');
        }
    }

    public function create(): View
    {
        return view('pages.penyedia.registrasi', [
            'title' => 'registrasi',
        ]);
    }

    private function uploadLocal($file)
    {
        $logoName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/logo'), $logoName);
        return 'uploads/logo/' . $logoName;
    }

    // private function uploadToGoogleDrive($file, $filename)
    // {
    //     $client = new Client();
    //     $client->setAuthConfig(storage_path('credentials/credentials.json'));
    //     $client->addScope(Drive::DRIVE_FILE);

    //     $service = new Drive($client);

    //     $fileMetadata = new Drive\DriveFile([
    //         'name' => $filename,
    //         'parents' => ['1zfl-nW4rxIHf0K4LRma8SrBvsgaAQArc']
    //     ]);

    //     $content = file_get_contents($file->getRealPath());

    //     $file = $service->files->create($fileMetadata, [
    //         'data' => $content,
    //         'mimeType' => $file->getMimeType(),
    //         'uploadType' => 'multipart',
    //     ]);

    //     return $file->getWebViewLink();
    // }

    public function store(Request $request)
    {
        $penyedia = new Penyedia;
        try {
            $validated = $request->validate([
                'NIK' => 'required|unique:penyedia,NIK,' . $penyedia->penyedia_id . ',penyedia_id|max:255',
                'nama_pemilik' => 'required|max:255',
                'alamat_pemilik' => 'required|max:255',
                'nama_perusahaan_lengkap' => 'required|max:255',
                'nama_perusahaan_singkat' => 'nullable|max:255',
                'akta_notaris_no' => 'required|numeric',
                'akta_notaris_nama' => 'required|max:255',
                'akta_notaris_tanggal' => 'required|date|max:255',
                'alamat_perusahaan' => 'required|max:255',
                'kontak_hp' => 'required|numeric',
                'kontak_email' => 'required|unique:penyedia,kontak_email,' . $penyedia->penyedia_id . ',penyedia_id|email|max:255',
                'rekening_norek' => 'required|numeric',
                'rekening_nama' => 'required|max:255',
                'rekening_bank' => 'required|max:255',
                'npwp_perusahaan' => 'required|max:255',
                'logo_perusahaan' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
            ]);

            if ($request->hasFile('logo_perusahaan')) {
                $logo = $request->file('logo_perusahaan');
                $validated['logo_perusahaan'] = $this->uploadLocal($logo);
            } 

            $penyedia->create($validated);
            return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        } catch (QueryException $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function update(Request $request, Penyedia $penyedia): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'NIK' => 'required|unique:penyedia,NIK,' . $penyedia->penyedia_id . ',penyedia_id|max:255',
                'nama_pemilik' => 'required|max:255',
                'alamat_pemilik' => 'required|max:255',
                'nama_perusahaan_lengkap' => 'required|max:255',
                'nama_perusahaan_singkat' => 'nullable|max:255',
                'akta_notaris_no' => 'required|numeric',
                'akta_notaris_nama' => 'required|max:255',
                'akta_notaris_tanggal' => 'required|date|max:255',
                'alamat_perusahaan' => 'required|max:255',
                'kontak_hp' => 'required|numeric',
                'kontak_email' => 'required|unique:penyedia,kontak_email,' . $penyedia->penyedia_id . ',penyedia_id|email|max:255',
                'rekening_norek' => 'required|numeric',
                'rekening_nama' => 'required|max:255',
                'rekening_bank' => 'required|max:255',
                'npwp_perusahaan' => 'required|max:255',
                'logo_perusahaan' => 'nullable|max:2048',
            ]);

            if ($request->hasFile('logo_perusahaan')) {
                $logo = $request->file('logo_perusahaan');
                $validated['logo_perusahaan'] = $this->uploadLocal($logo);
            }

            $penyedia->update($validated);
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


    public function destroy(Penyedia $penyedia): RedirectResponse
    {
        try {
            $penyedia->delete();
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
