<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-4 lg:px-5 py-6">
        <div
            class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden transition-all duration-200 border border-gray-100 dark:border-gray-700">
            <div class="flex justify-between items-center p-5 border-b border-gray-200 dark:border-gray-700">
                <a href="{{route('admin.riwayat-kontrak.index')}}"
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 transition-colors"
                    wire:navigate>
                    <i class="fas fa-arrow-left text-gray-600 dark:text-gray-300"></i>
                </a>
                <h1 class="text-xl font-bold text-gray-800 dark:text-white">DETAIL KONTRAK</h1>
            </div>



            <div class="space-y-4 text-sm dark:text-gray-200 p-4 sm:p-6">
                <!-- Template Selection Form -->
                <div
                    class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600">
                    <form action="{{ route('admin.riwayat-kontrak.update-template', $kontrak->kontrak_id) }}"
                        method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
                        @csrf
                        @method('PUT')

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Template Dokumen
                            </label>
                            <select name="template_id"
                                class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                <option value="">Pilih Template</option>
                                @foreach($templates as $template)
                                    <option value="{{ $template->template_id }}" {{ $kontrak->template_id == $template->template_id ? 'selected' : '' }}>
                                        {{ $template->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-blue-400 flex items-center justify-center">
                                <i class="fas fa-save mr-2"></i> Simpan Template
                            </button>
                        </div>
                    </form>

                </div>

                <div
                    class="bg-gray-50 dark:bg-gray-700 p-4 rounded-md border border-gray-200 dark:border-gray-600 flex flex-col sm:flex-row items-center justify-between">
                    <div class="text-lg font-bold text-gray-800 dark:text-white mb-3 sm:mb-0 flex items-center">
                        <i class="fas fa-file-export text-blue-500 dark:text-blue-400 mr-2"></i> UNDUH DOKUMEN KONTRAK
                        LENGKAP
                    </div>
                    @if($kontrak->template_id)
                        <!-- Template exists, show enabled buttons -->
                        <div class="flex space-x-3 w-full sm:w-auto">
                            <a target="_blank" href="{{ route('admin.riwayat-kontrak.export-pdf', ['kontrak' => $kontrak->kontrak_id, 'format' => 'pdf']) }}"
                                class="flex-1 sm:flex-none px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-700 transition-all transform hover:scale-[1.02] flex items-center justify-center">
                                <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
                            </a>
                            <a href="{{ route('admin.riwayat-kontrak.export-pdf', ['kontrak' => $kontrak->kontrak_id, 'format' => 'docx']) }}"
                                class="flex-1 sm:flex-none px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-700 transition-all transform hover:scale-[1.02] flex items-center justify-center">
                                <i class="fas fa-file-word mr-2"></i> Unduh DOCX
                            </a>
                        </div>
                    @else
                        <!-- No template, show disabled buttons with a note -->
                        <div class="flex flex-col space-y-2 w-full sm:w-auto">
                            <div class="text-amber-600 dark:text-amber-400 text-sm font-medium mb-1">
                                <i class="fas fa-exclamation-triangle mr-1"></i> Pilih template dokumen terlebih dahulu
                            </div>
                            <div class="flex space-x-3 w-full">
                                <button disabled
                                    class="flex-1 sm:flex-none px-4 py-2 bg-gray-400 text-white rounded-md cursor-not-allowed opacity-60 flex items-center justify-center">
                                    <i class="fas fa-file-pdf mr-2"></i> Unduh PDF
                                </button>
                                <button disabled
                                    class="flex-1 sm:flex-none px-4 py-2 bg-gray-400 text-white rounded-md cursor-not-allowed opacity-60 flex items-center justify-center">
                                    <i class="fas fa-file-word mr-2"></i> Unduh DOCX
                                </button>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Informasi Paket Pekerjaan -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                        <h2 class="text-lg font-bold flex items-center text-gray-800 dark:text-white">
                            <i class="fas fa-briefcase text-blue-500 dark:text-blue-400 mr-2"></i> INFORMASI PAKET
                            PEKERJAAN
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Kode
                                SiRUP</strong>
                            <p class="font-medium">{{ $kontrak->paketPekerjaan->kode_sirup }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nama
                                Paket</strong>
                            <p class="font-medium">{{ $kontrak->paketPekerjaan->nama_pekerjaan }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Tanggal
                                Pembuatan</strong>
                            <p class="font-medium">{{ date('d F Y', strtotime($kontrak->tgl_pembuatan))  }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">K/L/PD</strong>
                            <p class="font-medium">Pemerintah Daerah Kabupaten Cilacap</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Satuan
                                Kerja</strong>
                            <p class="font-medium">DINAS PENDIDIKAN DAN KEBUDAYAAN KABUPATEN CILACAP</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Jenis
                                Pengadaan</strong>
                            <p class="font-medium">{{ $kontrak->paketPekerjaan->jenis_pengadaan }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Metode
                                Pengadaan</strong>
                            <p class="font-medium">{{ $kontrak->paketPekerjaan->metode_pemilihan }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Tahun
                                Anggaran</strong>
                            <p class="font-medium">{{ $kontrak->paketPekerjaan->tahun_anggaran }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nilai
                                Pagu Paket</strong>
                            <p class="font-medium">Rp.
                                {{ number_format($kontrak->paketPekerjaan->nilai_pagu_paket, 0, ',', '.') }}
                            </p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nilai
                                Pagu Anggaran</strong>
                            <p class="font-medium">Rp.
                                {{ number_format($kontrak->paketPekerjaan->nilai_pagu_anggaran, 0, ',', '.') }}
                            </p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nilai
                                HPS</strong>
                            <p class="font-medium">Rp.
                                {{ number_format($kontrak->paketPekerjaan->nilai_hps, 0, ',', '.') }}
                            </p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Jenis
                                Kontrak</strong>
                            <p class="font-medium">{{ $kontrak->jenis_kontrak }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Sub
                                Kegiatan</strong>
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
                                <p class="font-medium text-gray-500 dark:text-gray-400">Tidak ada sub kegiatan yang
                                    tersedia.</p>
                            @endif
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nomor
                                Kontrak</strong>
                            <p class="font-medium">{{ $kontrak->no_kontrak }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nilai
                                Kontrak</strong>
                            <p class="font-medium">Rp. {{ number_format($kontrak->nilai_kontrak, 0, ',', '.') }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Tanggal
                                Kontrak</strong>
                            <p class="font-medium">{{ date('d F Y', strtotime($kontrak->tgl_kontrak)) }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Waktu
                                Pelaksanaan Kontrak</strong>
                            <p class="font-medium">{{ $kontrak->waktu_kontrak }} hari</p>
                        </div>
                    </div>
                </div>

                <!-- Informasi Penyedia -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                        <h2 class="text-lg font-bold flex items-center text-gray-800 dark:text-white">
                            <i class="fas fa-building text-blue-500 dark:text-blue-400 mr-2"></i> INFORMASI PENYEDIA
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nama
                                Penyedia</strong>
                            <p class="font-medium">{{ $kontrak->penyedia->nama_perusahaan_lengkap }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Direktur</strong>
                            <p class="font-medium">{{ $kontrak->penyedia->nama_pemilik }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Alamat
                                Penyedia</strong>
                            <p class="font-medium">{{ $kontrak->penyedia->alamat_perusahaan }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">No.
                                Telp</strong>
                            <p class="font-medium">{{ $kontrak->penyedia->kontak_hp }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Email</strong>
                            <p class="font-medium">{{ $kontrak->penyedia->kontak_email }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Bank</strong>
                            <p class="font-medium">{{ $kontrak->penyedia->rekening_bank }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Notaris</strong>
                            <p class="font-medium">{{ $kontrak->penyedia->akta_notaris_no }},
                                {{ $kontrak->penyedia->akta_notaris_tanggal }}
                            </p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nama
                                Notaris</strong>
                            <p class="font-medium">{{ $kontrak->penyedia->akta_notaris_nama }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nomor
                                DPPL</strong>
                            <p class="font-medium">{{ $kontrak->nomor_dppl ?? '-' }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Tanggal
                                DPPL</strong>
                            <p class="font-medium">{{ date('d F Y', strtotime($kontrak->tgl_dppl))  ?? '-' }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nomor
                                BAHPL</strong>
                            <p class="font-medium">{{ $kontrak->nomor_bahpl ?? '-' }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Tanggal
                                BAHPL</strong>
                            <p class="font-medium">{{ date('d F Y', strtotime($kontrak->tgl_bahpl))  ?? '-' }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nomor
                                SPPBJ</strong>
                            <p class="font-medium">{{ $kontrak->nomor_sppbj ?? '-' }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Tanggal
                                SPPBJ</strong>
                            <p class="font-medium">{{ date('d F Y', strtotime( $kontrak->tgl_sppbj) ) ?? '-'}}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nomor
                                Penetapan Pemenang</strong>
                            <p class="font-medium">{{ $kontrak->nomor_penetapan_pemenang ?? '-'}}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Tanggal
                                Penetapan Pemenang</strong>
                            <p class="font-medium">{{  date('d F Y', strtotime($kontrak->tgl_penetapan_pemenang))  ?? '-'}}</p>
                        </div>
                    </div>
                </div>

                <!-- Informasi Verifikator -->
                <div
                    class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                        <h2 class="text-lg font-bold flex items-center text-gray-800 dark:text-white">
                            <i class="fas fa-user-check text-blue-500 dark:text-blue-400 mr-2"></i> INFORMASI
                            VERIFIKATOR
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-4">
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">NIP</strong>
                            <p class="font-medium">{{ $kontrak->verifikator->nip ?? '-' }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Nama</strong>
                            <p class="font-medium">{{ $kontrak->verifikator->nama_verifikator ?? '-' }}</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg shadow-sm border border-gray-200 dark:border-gray-600 hover:shadow-md transition-all">
                            <strong
                                class="text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider block mb-1">Tanggal
                                Verifikasi</strong>
                            <p class="font-medium">{{ $kontrak->tgl_verifikasi ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
