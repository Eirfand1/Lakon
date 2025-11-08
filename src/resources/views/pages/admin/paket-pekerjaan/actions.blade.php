@php
    // Build paket data with all necessary fields including foreign keys
    // Access directly from model attributes instead of toArray() which might not include hidden fields
    $paketData = [
        'paket_id' => $paket->paket_id,
        'nomor_matrik' => $paket->nomor_matrik,
        'kode_sirup' => $paket->kode_sirup,
        'nama_pekerjaan' => $paket->nama_pekerjaan,
        'waktu_paket' => $paket->waktu_paket,
        'sumber_dana' => $paket->sumber_dana,
        'tahun_anggaran' => $paket->tahun_anggaran,
        'metode_pemilihan' => $paket->metode_pemilihan,
        'jenis_pengadaan' => $paket->jenis_pengadaan,
        'nilai_pagu_paket' => $paket->nilai_pagu_paket,
        'nilai_pagu_anggaran' => $paket->nilai_pagu_anggaran,
        'nilai_hps' => $paket->nilai_hps,
        // Foreign Keys - the critical data we need
        'satker_id' => $paket->satker_id,
        'daskum_id' => $paket->daskum_id,
        'ppkom_id' => $paket->ppkom_id,
        'sekolah_id' => $paket->sekolah_id,
        // Relationships
        'sub_kegiatan' => $paket->subKegiatan,
    ];
@endphp
<div>
    <label for="edit-modal" class="btn rounded-md text-gray-200 btn-sm btn-warning"
    onclick="EditHandler({{json_encode($paketData)}})">
        <i class="fa-solid fa-pen-to-square"></i>
    </label>

    <label for="delete-modal" class="btn rounded-md text-white btn-sm btn-error"
    onclick="setDeleteId({{ $paket->paket_id }})">
        <i class="fa-solid fa-trash"></i>
    </label>

</div>
