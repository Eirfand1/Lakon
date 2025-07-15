<x-app-layout>
    <div class="m-4 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-xl">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Detail Permohonan Kontrak</h2>

        <form action="{{ route('penyedia.permohonan-kontrak.update', $kontrak->kontrak_id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @method('PUT')
            @csrf
            <input type="hidden" name="penyedia_id" value="{{ $kontrak->penyedia->penyedia_id }}">
            <input type="hidden" name="paket_id" value="{{ $kontrak->paketPekerjaan->paket_id }}">
            <input type="hidden" name="tgl_pembuatan" value="{{ $kontrak->tgl_pembuatan }}">

            <!-- Section: Informasi Direktur -->
            <section>
                <div class="flex items-center mb-4">
                    <i class="fas fa-user-tie fa-lg text-blue-600 dark:text-blue-400"></i>
                    <h3 class="ml-3 text-lg font-semibold text-gray-800 dark:text-white">Informasi Direktur</h3>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Direktur</label>
                        <p class="mt-1 text-gray-800 dark:text-white font-medium">{{ $kontrak->penyedia->nama_pemilik }}</p>
                    </div>

                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Direktur</label>
                        <p class="mt-1 text-gray-800 dark:text-white font-medium">{{ $kontrak->penyedia->alamat_pemilik }}</p>
                    </div>
                </div>
            </section>

            <!-- Section: Informasi Perusahaan -->
            <section>
                <div class="flex items-center mb-4">
                    <i class="fas fa-building fa-lg text-blue-600 dark:text-blue-400"></i>
                    <h3 class="ml-3 text-lg font-semibold text-gray-800 dark:text-white">Informasi Perusahaan</h3>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan</label>
                        <p class="mt-1 text-gray-800 dark:text-white font-medium">
                            {{ $kontrak->penyedia->nama_perusahaan_lengkap }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Telepon</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">{{ $kontrak->penyedia->kontak_hp }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">{{ $kontrak->penyedia->kontak_email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Akta Notaris</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">{{ $kontrak->penyedia->akta_notaris_no }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Akta Notaris</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">{{ $kontrak->penyedia->akta_notaris_nama }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bank</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">{{ $kontrak->penyedia->rekening_bank }}</p>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Informasi Rekening</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">{{ $kontrak->penyedia->rekening_norek }}
                                <span class="text-gray-600 dark:text-gray-400">a.n.</span> <span class="font-semibold">{{ $kontrak->penyedia->rekening_nama }}</span></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Section: Paket Pekerjaan -->
            <section>
                <div class="flex items-center mb-4">
                    <i class="fas fa-briefcase fa-lg text-blue-600 dark:text-blue-400"></i>
                    <h3 class="ml-3 text-lg font-semibold text-gray-800 dark:text-white">Detail Paket Pekerjaan</h3>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Kode Sirup</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">
                                {{ $kontrak->paketPekerjaan->kode_sirup }}
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Paket</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">
                                {{ $kontrak->paketPekerjaan->nama_pekerjaan }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Pengadaan</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">
                                {{ $kontrak->paketPekerjaan->jenis_pengadaan }}
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Metode Pemilihan</label>
                            <p class="mt-1 text-gray-800 dark:text-white font-medium">
                                {{ $kontrak->paketPekerjaan->metode_pemilihan }}
                            </p>
                        </div>
                    </div>

                    {{-- Tender specific fields --}}
                    @if ($kontrak->paketPekerjaan->metode_pemilihan == 'Tender')
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor SPPBJ <span class="text-red-500">*</span></label>
                            </div>
                            <x-input type="text" name="nomor_sppbj" value="{{ $kontrak->nomor_sppbj }}" required></x-input>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal SPPBJ <span class="text-red-500">*</span></label>
                            </div>
                            <x-input type="date" name="tgl_sppbj" value="{{ $kontrak->tgl_sppbj }}" required></x-input>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor Penetapan Pemenang <span class="text-red-500">*</span></label>
                            </div>
                            <x-input type="text" name="nomor_penetapan_pemenang" value="{{ $kontrak->nomor_penetapan_pemenang }}" required></x-input>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Penetapan Pemenang <span class="text-red-500">*</span></label>
                            </div>
                            <x-input type="date" name="tgl_penetapan_pemenang" value="{{ $kontrak->tgl_penetapan_pemenang }}" required></x-input>
                        </div>
                    </div>
                    @endif

                    {{-- Non-Tender specific fields --}}
                    @if ($kontrak->paketPekerjaan->metode_pemilihan == 'Non Tender')
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor DPPL <span class="text-red-500">*</span></label>
                            </div>
                            <x-input type="text" name="nomor_dppl" value="{{ $kontrak->nomor_dppl }}" required></x-input>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal DPPL <span class="text-red-500">*</span></label>
                            </div>
                            <x-input type="date" name="tgl_dppl" value="{{ $kontrak->tgl_dppl }}" required></x-input>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomor BAHPL <span class="text-red-500">*</span></label>
                            </div>
                            <x-input type="text" name="nomor_bahpl" value="{{ $kontrak->nomor_bahpl }}" required></x-input>
                        </div>

                        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal BAHPL <span class="text-red-500">*</span></label>
                            </div>
                            <x-input type="date" name="tgl_bahpl" value="{{ $kontrak->tgl_bahpl }}" required></x-input>
                        </div>
                    </div>
                    @endif
                </div>
            </section>

            <!-- Upload Section -->
            <section>
                <div class="flex items-center mb-4">
                    <i class="fas fa-file-upload fa-lg text-blue-600 dark:text-blue-400"></i>
                    <h3 class="ml-3 text-lg font-semibold text-gray-800 dark:text-white">Dokumen Penawaran</h3>
                </div>

                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                        Upload Berkas Penawaran <span class="text-red-500 font-medium">(.pdf)</span>
                    </label>

                    <div class="mt-3">
                        <x-input type="file" name="berkas_penawaran" accept=".pdf"></x-input>
                    </div>

                    @if ($kontrak->berkas_penawaran)
                    <div class="mt-2 flex items-center text-sm text-blue-600 dark:text-blue-400">
                        <i class="fas fa-paperclip mr-2"></i>
                        <label for="berkas_penawaran" class="cursor-pointer hover:underline">
                            {{ basename($kontrak->berkas_penawaran) }}
                        </label>
                    </div>
                    @endif

                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-info-circle mr-1"></i> Maksimum ukuran file 10MB dalam format PDF
                    </p>
                </div>
            </section>

            <!-- Submit Button -->
            <div class="pt-4">
                <button type="submit"
                    class="w-full px-6 py-3 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all dark:bg-blue-700 dark:hover:bg-blue-600 flex items-center justify-center">
                    <i class="fas fa-save mr-2"></i> Simpan Data Permohonan
                </button>
            </div>
        </form>
    </div>

    @if ($kontrak->tgl_pembuatan)
    <div class="m-4 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-xl" id="lampiran">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Lampiran Dokumen</h2>

        @php
            $view = "pages.lampiran.";
            $jenis = $kontrak->paketPekerjaan->jenis_pengadaan;
            $metode = $kontrak->paketPekerjaan->metode_pemilihan;
        @endphp

        @include($view . "tim")
        @include($view . "jadwal-kegiatan")
        @include($view . "rincian-barang")
        @include($view . "peralatan")

        @include($view . "daftar-pekerjaan-sub-kontrak")
        @include($view . "daftar-keluaran-dan-harga")
    </div>

    <div class="m-4 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-xl">
        <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Pernyataan Kesanggupan</h2>

        <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg mb-6">
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                Dengan ini saya menyatakan bahwa data yang saya sampaikan adalah benar sesuai dengan fakta yang ada, dan apabila dikemudian hari data perusahaan yang saya sampaikan tidak benar, maka saya bersedia untuk diproses secara hukum sesuai dengan ketentuan Undang-Undang yang berlaku.
            </p>
        </div>

        <form action="layangkan/{{$kontrak->kontrak_id}}" method="POST" class="mt-4">
            @csrf
            <div class="flex items-center mb-6">
                <input type="checkbox" required name="konfirmasi_pernyataan" id="konfirmasi"
                    class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="konfirmasi" class="ml-3 text-gray-700 dark:text-gray-300 font-medium">
                    Saya setuju dengan pernyataan di atas
                </label>
            </div>

            <button type="submit"
                class="w-full px-6 py-3 text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all dark:bg-green-700 dark:hover:bg-green-600 flex items-center justify-center">
                <i class="fas fa-paper-plane mr-2"></i> Kirimkan Permohonan Kontrak
            </button>
        </form>
    </div>
    @endif

    <!-- Delete Modal -->
    <input type="checkbox" id="delete-modal" class="modal-toggle" />
    <div class="modal modal-top px-3">
        <div class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
            <h3 class="font-bold text-lg mb-4">Konfirmasi Hapus</h3>
            <p class="mb-6">Apakah Anda yakin ingin menghapus data ini?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-action">
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                        <i class="fa-solid fa-trash mr-2"></i>
                        <span>Hapus</span>
                    </button>
                    <label for="delete-modal" class="px-4 py-2 bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-white rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors cursor-pointer">Batal</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Document Viewer Modal -->
    <input type="checkbox" id="berkas_penawaran" class="modal-toggle" />
    <div class="modal modal-middle px-3">
        <div class="flex flex-col modal-box w-screen max-w-none h-screen max-h-none mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-lg">Dokumen Penawaran</h3>
                <label for="berkas_penawaran" class="cursor-pointer hover:text-red-500 dark:hover:text-red-400 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </label>
            </div>
            <div class="w-full h-full border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                <iframe src="{{ asset($kontrak->berkas_penawaran) }}" type="application/pdf" class="w-full h-full"></iframe>
            </div>
            <div class="mt-4 text-right">
                <label for="berkas_penawaran" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors cursor-pointer">
                    <i class="fas fa-times mr-2"></i> Tutup
                </label>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const hash = window.location.hash;
            if (hash === "#lampiran") {
                const target = document.getElementById("lampiran");
                if (target) {
                    target.scrollIntoView({ behavior: "smooth" });
                }
            }
        });
    </script>

</x-app-layout>
