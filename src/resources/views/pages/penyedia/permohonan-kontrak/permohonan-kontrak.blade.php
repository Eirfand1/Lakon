<x-app-layout>
    <div class="container mx-auto p-4">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <!-- Header -->
            <div class="mb-6">
                <h2 class="text-xl font-bold dark:text-gray-200">
                    <i class="fa fa-pencil-square-o"></i> PERMOHONAN KONTRAK
                </h2>
            </div>

            <form method="POST" action="/ph/permohonan-kontrak-data-dasar" class="max-w-5xl mx-auto p-2">
                <input type="hidden" name="slug" value="fbc70cbb7c0353a4fab7bade1708dd98">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div class="space-y-4">
                        <!-- NIK Direktur -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">NIK Direktur</label>
                            <input type="text" name="NIK" value="{{$penyedia->NIK}}"
                                class="w-full rounded-md bg-gray-100 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                readonly>
                        </div>

                        <!-- Nama Direktur -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">Nama Direktur</label>
                            <input type="text" name="nama_pemilik" value="{{$penyedia->nama_pemilik}}"
                                class="w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                readonly>
                        </div>

                        <!-- Alamat Direktur -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">Alamat Direktur</label>
                            <textarea name="alm_direktur" rows="3" readonly
                                class="w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2">
{{$penyedia->alamat_pemilik}}
                            </textarea>
                        </div>

                        <!-- Nama Perusahaan -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">Nama Perusahaan</label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                                <input type="text" name="nama_perusahaan_lengkap" value="{{$penyedia->nama_perusahaan_lengkap}}"
                                    class="sm:col-span-2 w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                                <input type="text" name="nama_perusahaan_singkat" value="{{$penyedia->nama_perusahaan_singkat}}"
                                    class="w-full rounded-md bg-gray-100 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                            </div>
                        </div>

                        <!-- Akta Notaris -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">Akta Notaris</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                                <input type="text" name="akta_notaris_no" value="{{$penyedia->akta_notaris_no}}" placeholder="Nomor Akta"
                                    class="w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                                <input type="text" name="akta_notaris_nama" value="{{$penyedia->akta_notaris_nama}}" placeholder="Nama Notaris"
                                    class="w-full rounded-md bg-gray-100 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                                <input type="date" name="akta_notaris_tanggal" value="{{$penyedia->akta_notaris_tanggal}}"
                                    class="sm:col-span-2 w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                            </div>
                        </div>

                        <!-- Alamat Perusahaan -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">Alamat Perusahaan</label>
                            <textarea name="alamat_perusahaan" rows="3" readonly
                                class="w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2">
{{$penyedia->alamat_perusahaan}}
                        </textarea>
                        </div>

                        <!-- Kontak -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">Kontak</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                <input type="text" name="kontak_hp" value="{{$penyedia->kontak_hp}}"
                                    class="w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                                <input type="text" name="kontak_email" value="{{$penyedia->kontak_email}}"
                                    class="w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                            </div>
                        </div>

                        <!-- Rekening -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">No Rekening Perusahaan</label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-2">
                                <input type="text" name="rekening_norek" value="{{$penyedia->rekening_norek}}" placeholder="Nomor rekening"
                                    class="sm:col-span-2 w-full bg-gray-100 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                                <input type="text" name="rekening_nama" value="{{$penyedia->rekening_nama}}" placeholder="Nama Pemilik"
                                    class="w-full rounded-md bg-gray-100 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                                <input type="text" name="rekening_bank" value="{{$penyedia->rekening_bank}}" placeholder="Nama Bank"
                                    class="w-full rounded-md bg-gray-100 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                    readonly>
                            </div>
                        </div>

                        <!-- NPWP -->
                        <div class="space-y-1">
                            <label class="text-gray-700 dark:text-gray-300 block">NPWP Perusahaan</label>
                            <input type="text" name="npwp_perusahaan" value="{{$penyedia->npwp_perusahaan}}"
                                class="w-full rounded-md bg-gray-100 border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2"
                                readonly>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-4">
                        <!-- Catatan & Form -->
                        <div class="p-4 bg-blue-50 dark:bg-gray-800 rounded-lg">
                            <p class="text-sm text-gray-700 dark:text-gray-300">
                                <strong class="block mb-2">📌 Catatan:</strong>
                                Pastikan untuk mengecek kembali kebenaran data perusahaan Anda.
                                Jika ingin merubah data perusahaan maka
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">
                                    klik disini <i class="fa fa-external-link-alt text-xs"></i>
                                </a>
                            </p>
                        </div>

                        <div class="space-y-4">
                            <h2 class="text-lg font-bold dark:text-gray-200 border-b pb-2">
                                <i class="fa fa-file-contract"></i> DASAR PERMOHONAN
                            </h2>

                            <!-- Kode Paket -->
                            <div class="space-y-1">
                                <label class="text-gray-700 dark:text-gray-300 block">Kode Paket <span
                                        class="text-red-500">*</span></label>
                                <div class="flex gap-2">
                                    <input type="text" name="kdpaket" placeholder="Kode paket LPSE"
                                        class="flex-1 rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2">
                                    <button type="button"
                                        class="bg-blue-500 hover:bg-blue-600 text-white rounded-md px-4 py-2">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Nama Paket -->
                            <div class="space-y-1">
                                <label class="text-gray-700 dark:text-gray-300 block">Nama Paket</label>
                                <input type="text" name="nama_paket" readonly
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2 bg-gray-100 dark:bg-gray-800">
                            </div>
                            <!-- Metode Pengadaan -->
                            <div class="space-y-1">
                                <label class="text-gray-700 dark:text-gray-300 block">Metode Pengadaan</label>
                                <input type="text" name="metode_pengadaan" readonly
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2 bg-gray-100 dark:bg-gray-800">
                            </div>

                            <!-- Jenis Pengadaan -->
                            <div class="space-y-1">
                                <label class="text-gray-700 dark:text-gray-300 block">Jenis Pengadaan</label>
                                <input type="text" name="jenis_pengadaan" readonly
                                    class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 p-2 bg-gray-100 dark:bg-gray-800">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-6 rounded-lg mt-6 transition-all">
                                <i class="fa fa-paper-plane mr-2"></i>LANJUT PERMOHONAN
                            </button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>