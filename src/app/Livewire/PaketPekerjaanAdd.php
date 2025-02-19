<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\PaketPekerjaanController;

class PaketPekerjaanAdd extends Component
{

    public $sekolah;
    public $dasarHukum;
    public $subKegiatan;
    public $satuanKerja;
    public $ppkom;

    public function mount($sekolah, $dasarHukum, $subKegiatan, $satuanKerja, $ppkom)
    {
        $this->sekolah = $sekolah;
        $this->dasarHukum = $dasarHukum;
        $this->subKegiatan = $subKegiatan;
        $this->satuanKerja = $satuanKerja;
        $this->ppkom = $ppkom;
    }

    public $nama_pekerjaan;
    public $waktu_paket;
    public $sub_kegiatan_id = [];
    public $sumber_dana;
    public $kode_paket;
    public $jenis_pengadaan;
    public $metode_pemilihan;
    public $nilai_pagu_paket;
    public $nilai_pagu_anggaran;
    public $nilai_hps;
    public $daskum_id;
    public $ppkom_id;
    public $satker_id;
    public $tahun_anggaran;
    public $sekolah_id;



    public function save()
    {
        $this->validation();
        try {
            $request = new Request([
                'nama_pekerjaan' => $this->nama_pekerjaan,
                'waktu_paket' => $this->waktu_paket,
                'sub_kegiatan_id' => $this->sub_kegiatan_id,
                'sumber_dana' => $this->sumber_dana,
                'kode_paket' => $this->kode_paket,
                'jenis_pengadaan' => $this->jenis_pengadaan,
                'metode_pemilihan' => $this->metode_pemilihan,
                'nilai_pagu_paket' => $this->nilai_pagu_paket,
                'nilai_pagu_anggaran' => $this->nilai_pagu_anggaran,
                'nilai_hps' => $this->nilai_hps,
                'daskum_id' => $this->daskum_id,
                'ppkom_id' => $this->ppkom_id,
                'satker_id' => $this->satker_id,
                'tahun_anggaran' => $this->tahun_anggaran,
                'sekolah_id' => $this->sekolah_id

            ]);

            // Panggil controller untuk menyimpan data
            $response = app(PaketPekerjaanController::class)->store($request);

            // Reset form setelah submit
            $this->reset(
                'nama_pekerjaan',
                'waktu_paket',
                'sub_kegiatan_id',
                'sumber_dana',
                'kode_paket',
                'jenis_pengadaan',
                'metode_pemilihan',
                'nilai_pagu_paket',
                'nilai_pagu_anggaran',
                'nilai_hps',
                'daskum_id',
                'ppkom_id',
                'satker_id',
                'tahun_anggaran',
                'sekolah_id'
            );

            $this->dispatch('Saved');
            $this->dispatch('success', 'Sub Kegiatan berhasil disimpan.');
        } catch (\Exception $e) {
            $this->dispatch('error', 'Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function validation(){
        $this->validate([
            'nama_pekerjaan' => 'required|string|max:255',
            'waktu_paket' => 'required|date',
            'sub_kegiatan_id' => 'required|array',
            'sub_kegiatan_id.*' => 'exists:sub_kegiatan,sub_kegiatan_id',
            'sumber_dana' => 'required|in:APBN,APBD,Swasta',
            'kode_paket' => 'required|numeric',
            'jenis_pengadaan' => 'required|in:tender,non_tender,e_catalog',
            'metode_pemilihan' => 'required|string',
            'nilai_pagu_paket' => 'required|numeric',
            'nilai_pagu_anggaran' => 'required|numeric',
            'nilai_hps' => 'required|numeric',
            'daskum_id' => 'exists:dasar_hukum,daskum_id',
            'ppkom_id' => 'exists:ppkom,ppkom_id',
            'satker_id' => 'exists:satuan_kerja,satker_id',
            'tahun_anggaran' => 'required|numeric|min:1000|max:2999',
            'sekolah_id' => 'nullable|numeric'
        ], [
            // nama_pekerjaan
            'nama_pekerjaan.required' => 'Nama pekerjaan harus diisi.',
            'nama_pekerjaan.string' => 'Nama pekerjaan harus berupa string.',
            'nama_pekerjaan.max' => 'Nama pekerjaan tidak boleh lebih dari 255 karakter.',
            // waktu_paket
            'waktu_paket.required' => 'Waktu paket harus diisi.',
            'waktu_paket.date' => 'Waktu paket harus berupa tanggal yang valid.',
            // sub_kegiatan_id
            'sub_kegiatan_id.required' => 'Sub kegiatan harus dipilih.',
            'sub_kegiatan_id.array' => 'Sub kegiatan harus berupa array.',
            'sub_kegiatan_id.*.exists' => 'Sub kegiatan yang dipilih tidak valid.',
            // sumber_dana
            'sumber_dana.required' => 'Sumber dana harus dipilih.',
            'sumber_dana.in' => 'Sumber dana yang dipilih tidak valid.',
            // kode_paket
            'kode_paket.required' => 'Kode paket harus diisi.',
            'kode_paket.numeric' => 'Kode paket harus berupa angka.',
            // jenis_pengadaan
            'jenis_pengadaan.required' => 'Jenis pengadaan harus dipilih.',
            'jenis_pengadaan.in' => 'Jenis pengadaan yang dipilih tidak valid.',
            // metode_pemilihan
            'metode_pemilihan.required' => 'Metode pemilihan harus diisi.',
            'metode_pemilihan.string' => 'Metode pemilihan harus berupa string.',
            // nilai_pagu_paket
            'nilai_pagu_paket.required' => 'Nilai pagu paket harus diisi.',
            'nilai_pagu_paket.numeric' => 'Nilai pagu paket harus berupa angka.',
            // nilai_pagu_anggaran
            'nilai_pagu_anggaran.required' => 'Nilai pagu anggaran harus diisi.',
            'nilai_pagu_anggaran.numeric' => 'Nilai pagu anggaran harus berupa angka.',
            // nilai_hps
            'nilai_hps.required' => 'Nilai HPS harus diisi.',
            'nilai_hps.numeric' => 'Nilai HPS harus berupa angka.',
            // daskum_id
            'daskum_id.exists' => 'Dasar hukum tidak valid.',
            // ppkom_id
            'ppkom_id.exists' => 'PPKom tidak valid.',
            // satker_id
            'satker_id.exists' => 'Satuan kerja tidak valid.',
            // tahun_anggaran
            'tahun_anggaran.required' => 'Tahun anggaran harus diisi.',
            'tahun_anggaran.numeric' => 'Tahun anggaran harus berupa angka.',
            'tahun_anggaran.min' => 'Tahun anggaran tidak boleh kurang dari 1000.',
            'tahun_anggaran.max' => 'Tahun anggaran tidak boleh lebih dari 2999.',
            // sekolah_id
            'sekolah_id.numeric' => 'Nilai Sekolah tidak valid.',
        ]);
    }


    public function render()
    {
        return view('livewire.paket-pekerjaan-add');
    }
}
