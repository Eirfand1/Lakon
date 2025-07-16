<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Lampiran</h1>
</div>

@php
$view = "pages.lampiran.";
$jenis = $kontrak->paketPekerjaan->jenis_pengadaan;
$metode = $kontrak->paketPekerjaan->metode_pemilihan;
@endphp

<div class="mb-8">
    @include($view . "tim")
</div>
{{-- @include($view . "jadwal-kegiatan") --}}
@if($jenis == 'Pengadaan Barang')
<div class="mb-8">
    @include($view . "rincian-barang")
</div>

@endif
@if($jenis == 'Jasa Konsultasi Perencanaan' || $jenis == 'Pekerjaan Konstruksi')
<div class="mb-8">
    @include($view . "peralatan")
</div>
@endif

@if($metode == 'Tender' && $jenis == 'Jasa Konsultasi Perencanaan')
<div class="mb-8">
    @include($view . "daftar-pekerjaan-sub-kontrak")
</div>
<div class="mb-8">
    @include($view . "daftar-keluaran-dan-harga")
</div>

@endif

<form action="lampiran/{{ $kontrak->kontrak_id }}" method="POST">
    @csrf
    <div class="h-10 mt-6 rounded-md flex items-center bg-green-500">
        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">
            <i class="fa-solid fa-check"></i>
            Simpan Lampiran
        </button>
    </div>
</form>
