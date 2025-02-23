<?php

namespace App\Http\Controllers;

use App\Models\Kontrak;
use App\Models\Penyedia;
use App\Models\SatuanKerja;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Hash;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
            $rules = [
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
                'logo_perusahaan' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',

                // User validation rules
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
            ];

            $messages = [
                // NIK Validation
                'NIK.required' => 'NIK wajib diisi',
                'NIK.unique' => 'NIK sudah terdaftar',
                'NIK.max' => 'NIK tidak boleh lebih dari 255 karakter',

                // Nama Pemilik Validation
                'nama_pemilik.required' => 'Nama pemilik wajib diisi',
                'nama_pemilik.max' => 'Nama pemilik tidak boleh lebih dari 255 karakter',

                // Alamat Pemilik Validation
                'alamat_pemilik.required' => 'Alamat pemilik wajib diisi',
                'alamat_pemilik.max' => 'Alamat pemilik tidak boleh lebih dari 255 karakter',

                // Nama Perusahaan Validation
                'nama_perusahaan_lengkap.required' => 'Nama perusahaan lengkap wajib diisi',
                'nama_perusahaan_lengkap.max' => 'Nama perusahaan lengkap tidak boleh lebih dari 255 karakter',
                'nama_perusahaan_singkat.max' => 'Nama perusahaan singkat tidak boleh lebih dari 255 karakter',

                // Akta Notaris Validation
                'akta_notaris_no.required' => 'Nomor akta notaris wajib diisi',
                'akta_notaris_no.numeric' => 'Nomor akta notaris harus berupa angka',
                'akta_notaris_nama.required' => 'Nama notaris wajib diisi',
                'akta_notaris_nama.max' => 'Nama notaris tidak boleh lebih dari 255 karakter',
                'akta_notaris_tanggal.required' => 'Tanggal akta notaris wajib diisi',
                'akta_notaris_tanggal.date' => 'Format tanggal akta notaris tidak valid',

                // Alamat Perusahaan Validation
                'alamat_perusahaan.required' => 'Alamat perusahaan wajib diisi',
                'alamat_perusahaan.max' => 'Alamat perusahaan tidak boleh lebih dari 255 karakter',

                // Kontak Validation
                'kontak_hp.required' => 'Nomor telepon wajib diisi',
                'kontak_hp.numeric' => 'Nomor telepon harus berupa angka',
                'kontak_email.required' => 'Email wajib diisi',
                'kontak_email.email' => 'Format email tidak valid',
                'kontak_email.unique' => 'Email sudah terdaftar',
                'kontak_email.max' => 'Email tidak boleh lebih dari 255 karakter',

                // Rekening Validation
                'rekening_norek.required' => 'Nomor rekening wajib diisi',
                'rekening_norek.numeric' => 'Nomor rekening harus berupa angka',
                'rekening_nama.required' => 'Nama pemilik rekening wajib diisi',
                'rekening_nama.max' => 'Nama pemilik rekening tidak boleh lebih dari 255 karakter',
                'rekening_bank.required' => 'Nama bank wajib diisi',
                'rekening_bank.max' => 'Nama bank tidak boleh lebih dari 255 karakter',

                // NPWP Validation
                'npwp_perusahaan.required' => 'NPWP perusahaan wajib diisi',
                'npwp_perusahaan.max' => 'NPWP perusahaan tidak boleh lebih dari 255 karakter',

                // Logo Validation
                'logo_perusahaan.image' => 'File harus berupa gambar',
                'logo_perusahaan.mimes' => 'Format gambar harus PNG, JPG, atau JPEG',
                'logo_perusahaan.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',

                // User Account Validation
                'name.required' => 'Username wajib diisi',
                'name.string' => 'Username harus berupa teks',
                'name.max' => 'Username tidak boleh lebih dari 255 karakter',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password wajib diisi',
                'password.string' => 'Password harus berupa teks',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok'
            ];

            $validated = $request->validate($rules, $messages);


            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $logoPath = null;
            if ($request->hasFile('logo_perusahaan')) {
                $logoPath = $request->file('logo_perusahaan')->store('logos', 'public');
            }

            Penyedia::create([
                'user_id' => $user->id,
                'NIK' => $request->NIK,
                'nama_pemilik' => $request->nama_pemilik,
                'alamat_pemilik' => $request->alamat_pemilik,
                'nama_perusahaan_lengkap' => $request->nama_perusahaan_lengkap,
                'nama_perusahaan_singkat' => $request->nama_perusahaan_singkat,
                'akta_notaris_no' => $request->akta_notaris_no,
                'akta_notaris_nama' => $request->akta_notaris_nama,
                'akta_notaris_tanggal' => $request->akta_notaris_tanggal,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'kontak_hp' => $request->kontak_hp,
                'kontak_email' => $request->kontak_email,
                'rekening_norek' => $request->rekening_norek,
                'rekening_nama' => $request->rekening_nama,
                'rekening_bank' => $request->rekening_bank,
                'npwp_perusahaan' => $request->npwp_perusahaan,
                'logo_perusahaan' => $logoPath,
            ]);

            return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->back()
                ->with('error', $th->getMessage())
                ->withInput()
                ->withErrors($th->getMessage());
        } catch (QueryException $th) {
            return redirect()->back()->with('error', $th->getMessage())->withErrors($th->getMessage());
        }
    }

    public function update(Request $request, Penyedia $penyedia): RedirectResponse
    {
        try {
            $validated = $request->validate([
                'status' => 'in:biasa,konsultan',
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

        return view('pages.penyedia.dashboard.dashboard', ['penyedia' => $user]);
    }
    public function permohonanKontrakIndex()
    {
        return view('pages.penyedia.permohonan-kontrak.permohonan-kontrak', ['penyedia' => auth()->user()->penyedia]);
    }

    public function konsultanMatrikIndex()
    {
        return view('pages.penyedia.konsultan.matrik.matrik');
    }





}
