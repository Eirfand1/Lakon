<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Data Dasar Permohonan Kontrak</h1>
</div>


<form action="data-dasar/{{ $kontrak->kontrak_id }}" method="POST">
    @csrf

<!-- Section Direktur -->
<div class="mb-8">
    <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
        <i class="fas fa-user fa-lg"></i>
        <h3 class=" font-bold">DIREKTUR</h3>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama Direktur</label>
            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->nama_pemilik }}</p>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Alamat Direktur</label>
            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->alamat_pemilik }}</p>
        </div>
    </div>
</div>

<!-- Section Perusahaan -->
<div class="mb-8">
    <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
        <i class="fas fa-building fa-lg"></i>
        <h3 class="font-bold">PERUSAHAAN</h3>
    </div>

    <div class="grid grid-cols-1 gap-4">
        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama Perusahaan</label>
            <p class="mt-1 text-gray-700 dark:text-gray-200">
                {{ $kontrak->penyedia->nama_perusahaan_lengkap }}
            </p>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">NPWP Perusahaan</label>
            <p class="mt-1 text-gray-700 dark:text-gray-200">
                {{ $kontrak->penyedia->npwp_perusahaan }}
            </p>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Alamat Perusahaan</label>
            <p class="mt-1 text-gray-700 dark:text-gray-200">
                {{ $kontrak->penyedia->alamat_perusahaan }}
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor Telp</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->kontak_hp }}</p>
            </div>

            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Email</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->kontak_email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor Akta Notaris</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->akta_notaris_no }}
                </p>
            </div>

            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal Akta Notaris</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->akta_notaris_tanggal }}
                </p>
            </div>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama Akta Notaris</label>
            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->akta_notaris_nama }}
            </p>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Bank</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->rekening_bank }}</p>
            </div>

            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Rekening</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->rekening_norek }}
                    atas nama <strong>{{ $kontrak->penyedia->rekening_nama }}</strong></p>
            </div>
        </div>
    </div>
</div>


<!-- Section Paket Pekerjaan -->
<div class="mb-8">
    <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
        <i class="fas fa-cogs fa-lg"></i>
        <h3 class="font-bold">PAKET PEKERJAAN</h3>
    </div>

    <div class="grid grid-cols-1 gap-4">

        <div class="grid grid-cols-1 gap-4 md:grid-cols-1">
            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Kode Sirup</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                    {{ $kontrak->paketPekerjaan->kode_sirup }}
                </p>
            </div>

            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama Paket</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                    {{ $kontrak->paketPekerjaan->nama_pekerjaan }}
                    {{ $kontrak->paketPekerjaan->sekolah->nama_sekolah ?? "" }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Jenis Pengadaan</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                    {{ $kontrak->paketPekerjaan->jenis_pengadaan }}
                </p>
            </div>

            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Metode Pemilihan</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                    {{ $kontrak->paketPekerjaan->metode_pemilihan }}
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Satuan Kerja</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                    DINAS PENDIDIKAN DAN KEBUDAYAAN KABUPATEN CILACAP
                </p>
            </div>

            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Satuan Kerja</label>
                <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                    {{ $kontrak->PaketPekerjaan->sumber_dana }}
                </p>
            </div>
        </div>

        @if ($kontrak->paketPekerjaan->metode_pemilihan == 'Tender')
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor SPPBJ</label>
                    <x-input type="text" name="nomor_sppbj" value="{{ $kontrak->nomor_sppbj }}" required></x-input>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal SPPBJ</label>
                    <x-input type="date" name="tgl_sppbj" value="{{ $kontrak->tgl_sppbj }}" required></x-input>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor Penetapan Pemenang</label>
                    <x-input type="text" name="nomor_penetapan_pemenang" value="{{ $kontrak->nomor_penetapan_pemenang }}" required></x-input>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal Penetapan Pemenang</label>
                    <x-input type="date" name="tgl_penetapan_pemenang" value="{{ $kontrak->tgl_penetapan_pemenang }}" required></x-input>
                </div>
            </div>
        @elseif ($kontrak->paketPekerjaan->metode_pemilihan == 'Non Tender')
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor DPPL</label>
                    <x-input type="text" name="nomor_dppl" value="{{ $kontrak->nomor_dppl }}" required></x-input>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal DPPL</label>
                    <x-input type="date" name="tgl_dppl" value="{{ $kontrak->tgl_dppl }}" required></x-input>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor BAHPL</label>
                    <x-input type="text" name="nomor_bahpl" value="{{ $kontrak->nomor_bahpl }}" required></x-input>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal BAHPL</label>
                    <x-input type="date" name="tgl_bahpl" value="{{ $kontrak->tgl_bahpl }}" required></x-input>
                </div>
            </div>
        @endif

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Berkas Penawaran</label>
            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium cursor-pointer underline">
                <label for="berkas_penawaran" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 cursor-pointer">
                    @if ($kontrak->berkas_penawaran)
                            {{ basename($kontrak->berkas_penawaran) }}
                    @endif
                </label>
            </p>
        </div>
    </div>

        <div class="h-10 mt-6 rounded-md flex items-center bg-green-500">
            <button type="submit" class="w-full bg-success hover:bg-green-700 text-white  py-2 px-4 rounded-md">
                <i class="fa-solid fa-check"></i>
                Simpan Data Dasar
            </button>
        </div>
    </div>

</form>
{{-- tampilkan berkas penawaran --}}
<input type="checkbox" id="berkas_penawaran" class="modal-toggle" />
<div class="modal modal-middle px-3">
    <div class="flex flex-col modal-box w-screen max-w-none h-screen max-h-none mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
        <h3 class="font-bold text-lg">Berkas Penawaran</h3>
        <div class="w-full h-full">
            <iframe src="{{ asset($kontrak->berkas_penawaran) }}" type="application/pdf" class="w-full h-full"></iframe>
        </div>
        <div class="modal-action">
            <label for="berkas_penawaran" class="btn btn-error">Tutup</label>
        </div>
    </div>
</div>
