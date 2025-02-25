<x-app-layout>
    @if (session('error'))
            <script>
                Toastify({
                    escapeMarkup: false,
                    text: '<i class="fas fa-exclamation-circle mr-3" style="font-size:20px;"></i>' + "{{ session('error') }}",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        fontWeight: "600",
                        padding: "12px 20px",
                    },
                }).showToast();
            </script>
        @endif
    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl m-4 transition-colors duration-200">
        <div class="flex justify-between items-center  p-5 border-b border-gray-400/20">
            <a href="{{route('admin.riwayat-kontrak.index')}}" class="btn rounded-full btn-circle btn-sm btn-ghost bg-gray-100 dark:bg-gray-600" wire:navigate>
                <i class="fas fa-arrow-left text-gray-600 dark:text-gray-300"></i>
            </a>
            <h1 class="text-lg font-semibold text-center text-gray-800 dark:text-white tracking-wide">DETAIL KONTRAK</h1>
        </div>
        <div class="space-y-8 text-sm dark:text-gray-200 p-6">
            <!-- Informasi Paket Pekerjaan -->
            <div>
                <h2
                    class="text-lg font-semibold mb-4 flex items-center text-gray-800 dark:text-white  border-gray-200 dark:border-gray-700">
                    <i class="fas fa-briefcase text-blue-500 dark:text-blue-400 mr-2"></i> INFORMASI PAKET PEKERJAAN
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Kode Paket</strong>
                        <p class="font-medium">{{ $kontrak->paketPekerjaan->kode_paket }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nama Paket</strong>
                        <p class="font-medium">{{ $kontrak->paketPekerjaan->nama_pekerjaan }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Tanggal Pembuatan</strong>
                        <p class="font-medium">{{ $kontrak->tgl_pembuatan }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">K/L/PD</strong>
                        <p class="font-medium">Pemerintah Daerah Kabupaten Cilacap</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Satuan Kerja</strong>
                        <p class="font-medium">DINAS PENDIDIKAN DAN KEBUDAYAAN KABUPATEN CILACAP</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Jenis Pengadaan</strong>
                        <p class="font-medium">{{ $kontrak->paketPekerjaan->jenis_pengadaan }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Metode Pengadaan</strong>
                        <p class="font-medium">{{ $kontrak->paketPekerjaan->metode_pemilihan }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Tahun Anggaran</strong>
                        <p class="font-medium">{{ $kontrak->paketPekerjaan->tahun_anggaran }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nilai Pagu Paket</strong>
                        <p class="font-medium">Rp.
                            {{ number_format($kontrak->paketPekerjaan->nilai_pagu_paket, 0, ',', '.') }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nilai Pagu Anggaran</strong>
                        <p class="font-medium">Rp.
                            {{ number_format($kontrak->paketPekerjaan->nilai_pagu_anggaran, 0, ',', '.') }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nilai HPS</strong>
                        <p class="font-medium">Rp. {{ number_format($kontrak->paketPekerjaan->nilai_hps, 0, ',', '.') }}
                        </p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Jenis Kontrak</strong>
                        <p class="font-medium">{{ $kontrak->jenis_kontrak }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Sub Kegiatan</strong>
                        @if (isset($kontrak->paketPekerjaan->subKegiatan) && is_array($kontrak->paketPekerjaan->subKegiatan) || $kontrak->paketPekerjaan->subKegiatan instanceof \Illuminate\Support\Collection)
                            <ul class="list-disc list-inside">
                                @forelse ($kontrak->paketPekerjaan->subKegiatan as $sk)
                                    <li class="font-medium">{{ $sk->nama_sub_kegiatan }}</li>
                                @empty
                                    <p class="font-medium text-gray-500 dark:text-gray-400">Tidak ada sub kegiatan yang
                                        tersedia.</p>
                                @endforelse
                            </ul>
                        @else
                            <p class="font-medium text-gray-500 dark:text-gray-400">Tidak ada sub kegiatan yang tersedia.
                            </p>
                        @endif
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nomor Kontrak</strong>
                        <p class="font-medium">{{ $kontrak->no_kontrak }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nilai Kontrak</strong>
                        <p class="font-medium">Rp. {{ number_format($kontrak->nilai_kontrak, 0, ',', '.') }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Tanggal Kontrak</strong>
                        <p class="font-medium">{{ $kontrak->tgl_kontrak }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Waktu Pelaksanaan Kontrak</strong>
                        <p class="font-medium">{{ $kontrak->waktu_kontrak }} hari</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Penyedia -->
            <div>
                <h2
                    class="text-lg font-semibold mb-4 flex items-center text-gray-800 dark:text-white  border-gray-200 dark:border-gray-700">
                    <i class="fas fa-building text-blue-500 dark:text-blue-400 mr-2"></i> INFORMASI PENYEDIA
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nama Penyedia</strong>
                        <p class="font-medium">{{ $kontrak->penyedia->nama_perusahaan_lengkap }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Direktur</strong>
                        <p class="font-medium">{{ $kontrak->penyedia->nama_pemilik }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Alamat Penyedia</strong>
                        <p class="font-medium">{{ $kontrak->penyedia->alamat_perusahaan }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">No. Telp</strong>
                        <p class="font-medium">{{ $kontrak->penyedia->kontak_hp }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Email</strong>
                        <p class="font-medium">{{ $kontrak->penyedia->kontak_email }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Bank</strong>
                        <p class="font-medium">{{ $kontrak->penyedia->rekening_bank }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Notaris</strong>
                        <p class="font-medium">{{ $kontrak->penyedia->akta_notaris_no }},
                            {{ $kontrak->penyedia->akta_notaris_tanggal }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nama Notaris</strong>
                        <p class="font-medium">{{ $kontrak->penyedia->akta_notaris_nama }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nomor DPPL</strong>
                        <p class="font-medium">{{ $kontrak->nomor_dppl }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Tanggal DPPL</strong>
                        <p class="font-medium">{{ $kontrak->tgl_dppl }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nomor BAHPL</strong>
                        <p class="font-medium">{{ $kontrak->nomor_bahpl }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Tanggal BAHPL</strong>
                        <p class="font-medium">{{ $kontrak->tgl_bahpl }}</p>
                    </div>
                </div>
            </div>

            <!-- Informasi Verifikator -->
            <div>
                <h2
                    class="text-lg font-semibold mb-4 flex items-center text-gray-800 dark:text-white border-gray-200 dark:border-gray-700">
                    <i class="fas fa-user-check text-blue-500 dark:text-blue-400 mr-2"></i> INFORMASI VERIFIKATOR
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">NIP</strong>
                        <p class="font-medium">{{ $kontrak->verifikator->nip ?? '-' }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Nama</strong>
                        <p class="font-medium">{{ $kontrak->verifikator->nama_verifikator ?? '-' }}</p>
                    </div>
                    <div
                        class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm ">
                        <strong class="text-gray-700 dark:text-gray-300 block mb-1">Tanggal Verifikasi</strong>
                        <p class="font-medium">{{ $kontrak->tgl_verifikasi ?? '-' }}</p>
                    </div>
                </div>
            </div>

            

            <!-- Tombol Tindakan -->
            <div class="flex justify-end space-x-2 mt-6">
                <button
                    class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition-colors">
                    <i class="fas fa-print mr-2"></i> Cetak
                </button>
                <label for="add-modal"
                    class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 transition-colors">
                    <i class="fas fa-file-download mr-2"></i> Unduh Word 
                </label>
            </div>
        </div>
    </div>
    <input type="checkbox" id="add-modal" class="modal-toggle" />
    <div id="modal_template" class="modal modal-top px-3">
        <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
            <div class="flex justify-between items-center dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <h3 class="font-bold text-lg dark:text-gray-200">PRINT WORD</h3>
                </div>
                 
                <label for="add-modal"
                    class="btn btn-sm btn-circle btn-ghost rounded-full shadow-none hover:bg-gray-200 dark:hover:bg-gray-700">
                    ✕
                </label>
            </div>
            <form action="{{ route('admin.riwayat-kontrak.export-pdf', $kontrak->kontrak_id) }}" method="GET">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Template Dokumen
                        </label>
                        <select name="template" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                            @foreach($templates as $template)
                                <option value="{{ $template }}">{{ pathinfo($template, PATHINFO_FILENAME) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-action flex justify-end space-x-2">
                        <label for="add-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Tutup</label>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                            Unduh Word 
                        </button>
                    </div>
                </form>
        </div>
    </div>
</x-app-layout>