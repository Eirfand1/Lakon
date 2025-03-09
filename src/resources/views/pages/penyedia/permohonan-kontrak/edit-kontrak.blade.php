<x-app-layout>
    <div class="m-4 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-xl">
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            DETAIL PERMOHONAN
        </p>

        <form action="{{ route('penyedia.permohonan-kontrak.update', $kontrak->kontrak_id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <input type="hidden" name="penyedia_id" value="{{ $kontrak->penyedia->penyedia_id }}">
            <input type="hidden" name="paket_id" value="{{ $kontrak->paketPekerjaan->paket_id }}">
            <input type="hidden" name="tgl_pembuatan" value="{{ $kontrak->tgl_pembuatan }}">

            <!-- Section Direktur -->
            <div class="mb-8">
                <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
                    <i class="fas fa-user fa-lg"></i>
                    <h3 class=" font-bold">DIREKTUR</h3>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama
                            Direktur</label>
                        <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->nama_pemilik }}</p>
                    </div>

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Alamat
                            Direktur</label>
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
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama
                            Perusahaan</label>
                        <p class="mt-1 text-gray-700 dark:text-gray-200">
                            {{ $kontrak->penyedia->nama_perusahaan_lengkap }}
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor
                                Telp</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->kontak_hp }}</p>
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Email</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->kontak_email }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor
                                Akta Notaris</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->akta_notaris_no }}
                            </p>
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama Akta
                                Notaris</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->akta_notaris_nama }}
                            </p>
                        </div>
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

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Kode
                                Sirup</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->kode_sirup }}
                            </p>
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama
                                Paket</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->nama_pekerjaan }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Jenis
                                Pengadaan</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->jenis_pengadaan }}
                            </p>
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Metode
                                Pemilihan</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->metode_pemilihan }}
                            </p>
                        </div>
                    </div>

                    {{-- tender --}}
                    @if ($kontrak->paketPekerjaan->jenis_pengadaan == 'Tender')
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor SPPBJ</label>
                                @if ($kontrak->nomor_sppbj)
                                    <i class="fa-regular fa-circle-check text-green-500"></i>
                                @else
                                    <i class="fa-regular fa-circle-xmark text-red-500"></i>
                                @endif
                            </div>
                            <input type="text" name="nomor_sppbj" value="{{ $kontrak->nomor_sppbj }}" required
                            class="w-full dark:bg-gray-800 rounded mt-2">
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal SPPBJ</label>
                                @if ($kontrak->tgl_sppbj)
                                    <i class="fa-regular fa-circle-check text-green-500"></i>
                                @else
                                    <i class="fa-regular fa-circle-xmark text-red-500"></i>
                                @endif
                            </div>
                            <input type="date" name="tgl_sppbj" value="{{ $kontrak->tgl_sppbj }}" required
                            class="w-full dark:bg-gray-800 rounded mt-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor Penetapan Pemenang</label>
                                @if ($kontrak->nomor_penetapan_pemenang)
                                    <i class="fa-regular fa-circle-check text-green-500"></i>
                                @else
                                    <i class="fa-regular fa-circle-xmark text-red-500"></i>
                                @endif
                            </div>
                            <input type="text" name="nomor_penetapan_pemenang" value="{{ $kontrak->nomor_penetapan_pemenang }}" required
                            class="w-full dark:bg-gray-800 rounded mt-2">
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal Penetapan Pemenang</label>
                                @if ($kontrak->tgl_penetapan_pemenang)
                                    <i class="fa-regular fa-circle-check text-green-500"></i>
                                @else
                                    <i class="fa-regular fa-circle-xmark text-red-500"></i>
                                @endif
                            </div>
                            <input type="date" name="tgl_penetapan_pemenang" value="{{ $kontrak->tgl_penetapan_pemenang }}" required
                            class="w-full dark:bg-gray-800 rounded mt-2">
                        </div>
                    </div>
                    @endif

                    {{-- non tender --}}
                    @if ($kontrak->paketPekerjaan->jenis_pengadaan == 'Non Tender')
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor DPPL</label>
                                @if ($kontrak->nomor_dppl)
                                    <i class="fa-regular fa-circle-check text-green-500"></i>
                                @else
                                    <i class="fa-regular fa-circle-xmark text-red-500"></i>
                                @endif
                            </div>
                            <input type="text" name="nomor_dppl" value="{{ $kontrak->nomor_dppl }}" required
                            class="w-full dark:bg-gray-800 rounded mt-2">
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal DPPL</label>
                                @if ($kontrak->tgl_dppl)
                                    <i class="fa-regular fa-circle-check text-green-500"></i>
                                @else
                                    <i class="fa-regular fa-circle-xmark text-red-500"></i>
                                @endif
                            </div>
                            <input type="date" name="tgl_dppl" value="{{ $kontrak->tgl_dppl }}" required
                            class="w-full dark:bg-gray-800 rounded mt-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor BAHPL</label>
                                @if ($kontrak->nomor_bahpl)
                                    <i class="fa-regular fa-circle-check text-green-500"></i>
                                @else
                                    <i class="fa-regular fa-circle-xmark text-red-500"></i>
                                @endif
                            </div>
                            <input type="text" name="nomor_bahpl" value="{{ $kontrak->nomor_bahpl }}" required
                            class="w-full dark:bg-gray-800 rounded mt-2">
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <div class="flex items-center gap-2">
                                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal BAHPL</label>
                                @if ($kontrak->tgl_bahpl)
                                    <i class="fa-regular fa-circle-check text-green-500"></i>
                                @else
                                    <i class="fa-regular fa-circle-xmark text-red-500"></i>
                                @endif
                            </div>
                            <input type="date" name="tgl_bahpl" value="{{ $kontrak->tgl_bahpl }}" required
                            class="w-full dark:bg-gray-800 rounded mt-2">
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Form Input Section -->
            <div class="space-y-6">
                <!-- File Upload -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Upload Berkas Penawaran <span class="text-red-500">(.pdf)</span>
                        @if ($kontrak->berkas_penawaran)
                            <i class="fa-regular fa-circle-check text-green-500"></i>
                        @else
                            <i class="fa-regular fa-circle-xmark text-red-500"></i>
                        @endif
                    </label>
                    <input type="file" name="berkas_penawaran"
                        class="block w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-blue-300 dark:hover:file:bg-gray-600"
                        accept=".pdf">
                        <label for="berkas_penawaran" class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                            @if ($kontrak->berkas_penawaran)
                                {{ basename($kontrak->berkas_penawaran) }}
                            @endif
                        </label>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Pastikan maksimal ukuran berkas 5MB dan bertipe .pdf
                    </p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="w-full px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all dark:bg-blue-700 dark:hover:bg-blue-800">
                    <i class="mr-2 fas fa-save"></i> SIMPAN DATA DASAR PERMOHONAN
                </button>
            </div>
        </form>
    </div>
    @if ($kontrak->tgl_pembuatan)
    <div class="m-4 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-xl">
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300" id="lampiran">
            LAMPIRAN
        </p>

        @php
            $view = "pages.lampiran.";
            $jenis = $kontrak->paketPekerjaan->jenis_pengadaan;
            $metode = $kontrak->paketPekerjaan->metode_pemilihan;
        @endphp

        @include($view . "tim")
        @include($view . "jadwal-kegiatan")
        @include($view . "rincian-belanja")
        @include($view . "peralatan")
    </div>

    <div class="m-4 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-xl">
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            PERNYATAAN
        </p>
        <ul class="list-disc list-inside space-y-1 text-sm text-gray-600 dark:text-gray-300">
            <li>Dengan ini saya menyatakan bahawa data yang saya sampaikan adalah benar sesuai dengan fakta yang ada, dan apabila dikemudian hari data perusahaan yang saya sampaikan tidak benar, maka saya bersedia untuk diproses secara hukum sesuai dengan ketentuan Undang-Undang yang berlaku</li>
        </ul>
        <form action="layangkan/{{$kontrak->kontrak_id}}" method="POST">
            @csrf
            <div class="flex items-center mt-5">
                <input type="checkbox" required name="konfirmasi_pernyataan" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label class="ml-2 block text-gray-600 dark:text-gray-300">
                    Saya setuju dengan pernyataan di atas
                </label>

            </div>
            <button type="submit"
                class="w-full px-6 py-3 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all dark:bg-blue-700 dark:hover:bg-blue-800">
                <i class="mr-2 fas fa-save"></i> KIRIMKAN PERMOHONAN KONTRAK
            </button>
        </form>
    </div>
    @endif

    <!-- Delete -->
    <input type="checkbox" id="delete-modal" class="modal-toggle" />
    <div class="modal modal-top px-3">
        <div
            class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
            <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-action">
                    <button type="submit" class="btn btn-error">
                        <i class="fa-solid fa-trash"></i>
                        <span>Hapus</span>
                    </button>
                    <label for="delete-modal" class="btn">Batal</label>
                </div>
            </form>
        </div>
    </div>

{{-- tampilkan berkas penawaran --}}
<input type="checkbox" id="berkas_penawaran" class="modal-toggle" />
<div class="modal modal-middle px-3">
    <div class="flex flex-col modal-box w-screen max-w-none h-screen max-h-none mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
        <h3 class="font-bold text-lg">Berkas Penawaran</h3>
        <div class="w-full h-full">
            <iframe src="{{ asset($kontrak->berkas_penawaran) }}" type="application/pdf" class="w-full h-full"></iframe>
        </div>
        <div class="modal-action">
            <label for="berkas_penawaran" class="btn">Tutup</label>
        </div>
    </div>
</div>

</x-app-layout>
