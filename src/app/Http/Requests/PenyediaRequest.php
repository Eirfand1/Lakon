<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenyediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'NIK' => 'required|unique:penyedia,NIK|max:255',
            'nama_pemilik' => 'required|max:255',
            'alamat_pemilik' => 'required|max:255',
            'nama_perusahaan_lengkap' => 'required|max:255',
            'nama_perusahaan_singkat' => 'nullable|max:255',
            'akta_notaris_no' => 'required|numeric',
            'akta_notaris_nama' => 'required|max:255',
            'akta_notaris_tanggal' => 'required|date|max:255',
            'alamat_perusahaan' => 'required|max:255',
            'kontak_hp' => 'required|numeric',
            'kontak_email' => 'required|unique:penyedia,kontak_email|email|max:255',
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
    }

    public function messages(){
        return [
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
    }
}
