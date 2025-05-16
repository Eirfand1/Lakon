<?php

namespace App\Http\Controllers;

use App\Exports\PenyediaExport;
use App\Http\Requests\PenyediaRequest;
use App\Models\Kontrak;
use App\Models\Penyedia;
use App\Models\SatuanKerja;
use App\Models\User;
use App\Models\Realisasi;
use Dotenv\Exception\ValidationException;
use Hash;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class PenyediaController extends Controller
{

    public function index(): View
    {
        return view('pages.admin.penyedia.penyedia', [
            "title" => "penyedia",
        ]);
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

    public function store(PenyediaRequest $request)
    {
        try {
            $validated = $request->validate([
                'status' => 'in:biasa,konsultan',
                'NIK' => ['required', 'max:255'],
                'nama_pemilik' => 'required|max:255',
                'alamat_pemilik' => 'required|max:255',
                'nama_perusahaan_lengkap' => 'required|max:255',
                'nama_perusahaan_singkat' => 'nullable|max:255',
                'akta_notaris_no' => 'required|numeric',
                'akta_notaris_nama' => 'required|max:255',
                'akta_notaris_tanggal' => 'required|date|max:255',
                'alamat_perusahaan' => 'required|max:255',
                'kontak_hp' => 'required|numeric',
                'kontak_email' => ['required', 'email', 'max:255'],
                'rekening_norek' => 'required|numeric',
                'rekening_nama' => 'required|max:255',
                'rekening_bank' => 'required|max:255',
                'npwp_perusahaan' => 'required|max:255',
                'logo_perusahaan' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            ]);

            // Upload file kalau ada
            if ($request->hasFile('logo_perusahaan')) {
                $logo = $request->file('logo_perusahaan');
                $validated['logo_perusahaan'] = $this->uploadLocal($logo);
            }

            // Buat user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Tambahkan user_id ke array validated
            $validated['user_id'] = $user->id;

            // Simpan ke DB
            Penyedia::create($validated); 


            return redirect()->back()->with('success', 'Registrasi berhasil ditambahkan!');
        } catch (QueryException $th) {
            return redirect()->back()->with('error', $th->getMessage())->withErrors($th->getMessage());
        }
    }

    


    public function update(Request $request, Penyedia $penyedia): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'status' => 'in:penyedia,konsultan',
                'NIK' => [
                    'required',
                    'max:255',
                ],
                'nama_pemilik' => 'required|max:255',
                'alamat_pemilik' => 'required|max:255',
                'nama_perusahaan_lengkap' => 'required|max:255',
                'nama_perusahaan_singkat' => 'nullable|max:255',
                'akta_notaris_no' => 'required|numeric',
                'akta_notaris_nama' => 'required|max:255',
                'akta_notaris_tanggal' => 'required|date|max:255',
                'alamat_perusahaan' => 'required|max:255',
                'kontak_hp' => 'required|numeric',
                'kontak_email' => [
                    'required',
                    'email',
                    'max:255',
                ],
                'rekening_norek' => 'required|numeric',
                'rekening_nama' => 'required|max:255',
                'rekening_bank' => 'required|max:255',
                'npwp_perusahaan' => 'required|max:255',
                'logo_perusahaan' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
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
                ->with('error', 'Terjadi kesalahan pada database: ' . $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
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

    public function kontrakSaya()
    {
        $user = auth()->user();

        if ($user->role != 'penyedia') {
            abort(403, 'Anda bukan penyedia');
        }

        $kontrak = Kontrak::where('penyedia_id', $user->id)->get();

        return view('pages.penyedia.riwayat.riwayat', compact('kontrak'));
    }

    public function dashboard()
    {
        $user = auth()->user()->penyedia;
        $kontrak = $user->kontrak->where('is_verificated', 0);

        return view('pages.penyedia.dashboard.dashboard', ['penyedia' => $user, 'kontrak' => $kontrak]);
    }
    public function permohonanKontrakIndex()
    {
        return view('pages.penyedia.permohonan-kontrak.permohonan-kontrak', ['penyedia' => auth()->user()->penyedia]);
    }

    public function konsultanMatrikIndex()
    {
        return view('pages.penyedia.konsultan.matrik.matrik');
    }


    public function dataPerusahaanView()
    {
        $user = auth()->user()->penyedia;

        return view('pages.penyedia.data-perusahaan.index', ['penyedia' => $user]);
    }

    public function exportPenyedia()
    {
        return Excel::download(new PenyediaExport, 'penyedia.xlsx');
    }

    public function verifikasi(Penyedia $penyedia){
        $penyedia->update(['is_verificated' => 1]);
        return redirect()->back()->with('success', 'Data berhasil diverifikasi!');
    }

    public function batal_verifikasi(Penyedia $penyedia){
        $penyedia->update(['is_verificated' => 0]);
        return redirect()->back()->with('success', 'Data berhasil dibatalkan!');
    }
}
