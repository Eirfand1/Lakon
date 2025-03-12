<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Data Dasar Permohonan Kontrak</h1>
</div>

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
                    {{ $kontrak->paketPekerjaan->sekolah->nama_sekolah }}
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

        @if ($kontrak->paketPekerjaan->jenis_pengadaan == 'tender')
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor SPPBJ</label>
                    <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                        {{ $kontrak->nomor_sppbj }}
                    </p>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal SPPBJ</label>
                    <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                        {{ $kontrak->tgl_sppbj }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor Penetapan Pemenang</label>
                    <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                        {{ $kontrak->nomor_penetapan_pemenang }}
                    </p>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal Penetapan Pemenang</label>
                    <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                        {{ $kontrak->tgl_penetapan_pemenang }}
                    </p>
                </div>
            </div>
        @elseif ($kontrak->paketPekerjaan->jenis_pengadaan == 'non_tender')
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor DPPL</label>
                    <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                        {{ $kontrak->nomor_dppl }}
                    </p>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal DPPL</label>
                    <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                        {{ $kontrak->tgl_dppl }}
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor BAHPL</label>
                    <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                        {{ $kontrak->nomor_bahpl }}
                    </p>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal BAHPL</label>
                    <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                        {{ $kontrak->tgl_bahpl }}
                    </p>
                </div>
            </div>
        @endif

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Berkas Penawaran</label>
            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                <label for="berkas_penawaran" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                    @if ($kontrak->berkas_penawaran)
                        {{ basename($kontrak->berkas_penawaran) }}
                    @endif
                </label>
            </p>
        </div>
    </div>

    <form action="data-dasar/{{ $kontrak->kontrak_id }}" method="POST">
        @csrf
        <div class="h-10 mt-6 rounded flex items-center bg-blue-500">
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Simpan Data Dasar
            </button>
        </div>
    </form>
</div>

{{-- tampilkan berkas penawaran --}}
<input type="checkbox" id="berkas_penawaran" class="modal-toggle" />
<div class="modal modal-middle px-3">
    <div class="flex flex-col modal-box w-full h-full mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
        <h3 class="font-bold text-lg">Berkas Penawaran</h3>
        <div class="w-full h-full">
            <iframe src="{{ asset($kontrak->berkas_penawaran) }}" type="application/pdf" class="w-full h-full"></iframe>
        </div>
        <div class="modal-action">
            <label for="berkas_penawaran" class="btn">Tutup</label>
        </div>
    </div>
</div>
