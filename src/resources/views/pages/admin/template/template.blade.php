<x-app-layout>
    <div class="p-5">
        <div class="sm:flex sm:justify-between sm:items-center p-2 pb-5">
            <div class="">
                <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">TEMPLATE</h1>
            </div>
            <!-- Add Button -->
            <div>
                <label for="petunjuk-modal" class="btn bg-yellow-800 hover:bg-yellow-700 rounded btn-sm px-3 text-white dark:bg-yellow-100 dark:text-yellow-800 ">
                    <i class="fa-solid fa-question"></i>
                    <span>Petunjuk</span>
                </label>
                <label for="add-modal" class="btn bg-gray-800 hover:bg-gray-700 rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                    <i class="fa-solid fa-square-plus"></i>
                    <span>Tambah Data</span>
                </label>
            </div>
        </div>

        <livewire:template-table />

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_template" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">TAMBAH TEMPLATE</h3>
                    </div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 rounded-full shadow-none dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.template.store') }}" method="POST" class="space-y-2 " enctype="multipart/form-data">
                    @csrf
                    <div class="flex w-full flex-col ">
                        <x-label for="name">Nama Template</x-label>
                        <x-input type="text" name="name" required />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="name">File Template</x-label>
                        <x-input name="file_path" type="file" required />
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded-md text-white btn-primary bg-blue-500">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                        <label for="add-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>


        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal modal-top px-3">
        <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
        <div class="flex justify-between items-center dark:border-gray-700">
            <div class="flex items-center gap-3">
                <h3 class="font-bold text-lg dark:text-gray-200">EDIT TEMPLATE</h3>
            </div>
            <label for="edit-modal"
                class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 rounded-full shadow-none dark:hover:bg-gray-700">
                ✕
            </label>
        </div>

        <form id="editForm" method="POST" class="space-y-2" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex w-full flex-col">
                <x-label for="edit_name">Nama Template</x-label>
                <x-input type="text" id="edit_name" name="name" required />
            </div>

            <div class="flex w-full flex-col">
                <x-label for="edit_file">File Template (Kosongkan jika tidak ingin mengubah file)</x-label>
                <x-input name="file_path" type="file" />
                <small class="text-gray-500 dark:text-gray-400 mt-1">File saat ini: <span id="current_file"></span></small>
            </div>

            <div class="modal-action pt-4">
                <button type="submit" class="btn rounded-md text-white btn-primary bg-blue-500">
                    <i class="fas fa-save"></i>
                    Update
                </button>
                <label for="edit-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
            </div>
        </form>
        </div>
        </div>

        <!-- Delete Modal -->
        <input type="checkbox" id="delete-template" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div
                class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
                <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                <p>Apakah Anda yakin ingin menghapus data ini?</p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-action">
                        <x-danger-button type="submit">
                            <i class="fa-solid fa-trash"></i>
                            <span>Hapus</span>
                        </x-danger-button>
                        <label for="delete-template" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Petunjuk -->
<input type="checkbox" id="petunjuk-modal" class="modal-toggle" />
<div class="modal modal-top px-3">
    <div class="modal-box max-w-6xl mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
        <div class="flex justify-between items-center dark:border-gray-700 mb-4">
            <div class="flex items-center gap-3">
                <h3 class="font-bold text-lg dark:text-gray-200">PETUNJUK PENGGUNAAN TEMPLATE</h3>
            </div>
            <label for="petunjuk-modal"
                class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 rounded-full shadow-none dark:hover:bg-gray-700">
                ✕
            </label>
        </div>

        <div class="space-y-6">
            <!-- Informasi Umum -->
            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 rounded-lg border border-blue-200 dark:border-blue-800">
                <h4 class="font-semibold text-blue-800 dark:text-blue-200 mb-2">
                    <i class="fa-solid fa-info-circle mr-2"></i>Informasi Umum
                </h4>
                <p class="text-sm text-blue-700 dark:text-blue-300">
                    Template menggunakan format <code class="bg-blue-100 dark:bg-blue-800 px-2 py-1 rounded">${VARIABLE_NAME}</code> untuk mengganti data secara otomatis.
                    Pastikan format variable sesuai dengan yang tercantum di bawah ini.
                </p>
            </div>

            <!-- Tabs untuk kategori -->
            <div class="tabs tabs-boxed bg-gray-100 dark:bg-gray-700">
                <a class="tab tab-active" onclick="showTab('paket')">Paket Pekerjaan</a>
                <a class="tab" onclick="showTab('kontrak')">Kontrak</a>
                <a class="tab" onclick="showTab('penyedia')">Penyedia</a>
                <a class="tab" onclick="showTab('ppk')">PPK & Kepala Dinas</a>
                <a class="tab" onclick="showTab('tabel')">Tabel</a>
                <a class="tab" onclick="showTab('lainnya')">Lainnya</a>
            </div>

            <!-- Tab Content -->
            <div id="paket" class="tab-content block">
                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">
                    <i class="fa-solid fa-briefcase mr-2"></i>Variables Paket Pekerjaan
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${KODE_PAKET}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kode paket pekerjaan</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${PEKERJAAN_JUDUL}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama pekerjaan + nama sekolah</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${SUMBER_DANA}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Sumber dana pekerjaan</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${JENIS_PENGADAAN}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Jenis pengadaan</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${METODE_PEMILIHAN}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Metode pemilihan</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NILAI_PAGU_PAKET}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nilai pagu paket (format angka)</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${PAGU_ANGGARAN}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Pagu anggaran (format angka)</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NILAI_HPS}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nilai HPS (format angka)</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TAHUN_ANGGARAN}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tahun anggaran</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${SUB_KEGIATAN}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Daftar sub kegiatan (dengan enter)</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${DASAR_HUKUM}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Dasar Hukum</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="kontrak" class="tab-content hidden">
                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">
                    <i class="fa-solid fa-file-contract mr-2"></i>Variables Kontrak
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NO_KONTRAK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor kontrak</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NO_SPMK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor SPMK (auto generated)</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${JENIS_KONTRAK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Jenis kontrak</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TGL_PEMBUATAN}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal pembuatan (format: d F Y)</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TERBILANG_TGL_PEMBUATAN}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal pembuatan dalam terbilang</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${WAKTU_KONTRAK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Waktu kontrak (hari)</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TERBILANG_JANGKA_WAKTU}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Jangka waktu dalam terbilang</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NILAI_KONTRAK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nilai kontrak (format angka)</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TERBILANG_NILAI_KONTRAK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nilai kontrak dalam terbilang</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TGL_KONTRAK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal kontrak</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NOMOR_DPPL}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor DPPL</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TGL_DPPL}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal DPPL</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NOMOR_BAHPL}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor BAHPL</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TGL_BAHPL}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal BAHPL</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NOMOR_SPPBJ}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor SPPBJ</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TGL_SPPBJ}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal SPPBJ</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="penyedia" class="tab-content hidden">
                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">
                    <i class="fa-solid fa-building mr-2"></i>Variables Penyedia
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NAMA_DIREKTUR}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama pemilik/direktur</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${ALAMAT_PEMILIK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Alamat pemilik</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NAMA_CV}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama perusahaan lengkap</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${ALAMAT_PERUSAHAAN}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Alamat perusahaan</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${KONTAK_HP}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor HP kontak</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${EMAIL_CV}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Email perusahaan</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NAMA_BANK_CV}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama bank rekening</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${REKENING_NO}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor rekening</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${REKENING_NAMA}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama pemilik rekening</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NAMA_CV_REKENING}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama CV pada rekening</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NO_AKTA}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor akta notaris</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TGL_AKTA}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal akta</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NAMA_NOTARIS}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama notaris</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="ppk" class="tab-content hidden">
                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">
                    <i class="fa-solid fa-user-tie mr-2"></i>Variables PPK & Kepala Dinas
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <h6 class="font-medium text-gray-700 dark:text-gray-300">PPK (Pejabat Pembuat Komitmen)</h6>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NAMA_PPK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama PPK</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${JABATAN_PPK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Jabatan PPK</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NIP_PPK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">NIP PPK</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${ALAMAT_PPK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Alamat PPK</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h6 class="font-medium text-gray-700 dark:text-gray-300">Kepala Dinas</h6>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NAMA_KEPALA_DINAS}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama kepala dinas</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${JABATAN_KEPALA_DINAS}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Jabatan kepala dinas</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NIP_KEPALA_DINAS}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">NIP kepala dinas</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${EMAIL_KEPALA_DINAS}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Email kepala dinas</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TELP_KEPALA_DINAS}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Telepon kepala dinas</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${KLPD_KEPALA_DINAS}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">KLPD kepala dinas</p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="tabel" class="tab-content hidden">
                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">
                    <i class="fa-solid fa-table mr-2"></i>Variables Tabel
                </h5>
                <div class="space-y-4">
                    <div class="bg-yellow-50 dark:bg-yellow-900/20 p-4 rounded-lg border border-yellow-200 dark:border-yellow-800">
                        <p class="text-sm text-yellow-800 dark:text-yellow-200">
                            <i class="fa-solid fa-exclamation-triangle mr-2"></i>
                            <strong>Penting:</strong> Variables tabel akan otomatis membuat baris baru sesuai data yang tersedia.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Detail Kontrak</h6>
                            <div class="space-y-2">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_DETAIL</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Detail pekerjaan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_NILAI</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nilai detail (format angka)</p>
                                </div>
                            </div>

                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2 mt-4">Tim</h6>
                            <div class="space-y-2">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">NO_TIM</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor urut tim</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_NAMA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama anggota tim</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_POSISI</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Posisi dalam tim</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_STATUS_TENAGA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Status tenaga</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_PENDIDIKAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Pendidikan</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Peralatan</h6>
                            <div class="space-y-2">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">NO_PERALATAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor urut peralatan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_NAMA_PERALATAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama peralatan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_MERK</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Merk peralatan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_TYPE</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Type peralatan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_KAPASITAS</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kapasitas peralatan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Rincian Belanja</h6>
                            <div class="space-y-2">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">NO_RINCIAN_BELANJA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor urut rincian</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_JENIS</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Jenis barang/jasa</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_QTY</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Quantity/jumlah</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_SATUAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Satuan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_HARGA_SATUAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Harga satuan</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Penerima</h6>
                            <div class="space-y-2">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">NO_PENERIMA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor urut penerima</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_NAMA_SEKOLAH</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama sekolah penerima</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_ALAMAT</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Alamat penerima</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_QTY</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Quantity/jumlah</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_SATUAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Satuan</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 'NO_DAFTAR_PEKERJAAN' => $index + 1,
                        'TABLE_BAGIAN_PEKERJAAN' => $daftar->bagian_pekerjaan,
                        'TABLE_NAMA_SUB_PENYEDIA' => $daftar->nama_sub_penyedia,
                        'TABLE_ALAMAT_SUB_PENYEDIA' => $daftar->alamat_sub_penyedia,
                        'TABLE_KUALIFIKASI_SUB_PENYEDIA' => $daftar->kualifikasi_sub_penyedia,
                        'TABLE_KETERANGAN' => $daftar->keterangan --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Daftar Pekerjaan Sub Kontrak</h6>
                            <div class="space-y-2">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">NO_DAFTAR_PEKERJAAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor urut daftar pekerjaan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_BAGIAN_PEKERJAAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama bagian pekerjaan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_NAMA_SUB_PENYEDIA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama sub penyedia</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_ALAMAT_SUB_PENYEDIA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Alamat sub penyedia</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_KUALIFIKASI_SUB_PENYEDIA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Kualifikasi sub penyedia</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_KETERANGAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Keterangan</p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Daftar Keluaran Dan Harga</h6>
                            <div class="space-y-2">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">NO_DAFTAR_KELUARAN_DAN_HARGA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor urut daftar keluaran dan harga</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_KELUARAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Keluaran</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_SATUAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Satuan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_TOTAL_HARGA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Total harga</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 'TABLE_JENIS_BIAYA_PERSONEL' => $biaya->jenis_biaya,
                        'TABLE_URAIAN_BIAYA' => $biaya->uraian_biaya,
                        'TABLE_SATUAN' => $biaya->satuan,
                        'TABLE_QTY' => $biaya->qty,
                        'TABLE_HARGA' => number_format($biaya->harga, 2, ',', '.'),
                        'TABLE_JUMLAH' => number_format($biaya->jumlah, 2, ',', '.'),
                        'TABLE_KETERANGAN' => $biaya->keterangan --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <h6 class="font-medium text-gray-700 dark:text-gray-300 mb-2">Biaya Non Personel</h6>
                            <div class="space-y-2">
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_JENIS_BIAYA_PERSONEL</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Jenis biaya</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_URAIAN_BIAYA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Uraian biaya</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_SATUAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Satuan</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_QTY</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Qty</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_HARGA</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Harga</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_JUMLAH</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Jumlah</p>
                                </div>
                                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                                    <code class="text-sm font-mono text-green-600 dark:text-green-400">TABLE_KETERANGAN</code>
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Keterangan</p>
                                </div>  
                            </div>
                        </div>
                    </div>




                </div>
            </div>

            <div id="lainnya" class="tab-content hidden">
                <h5 class="font-semibold text-gray-800 dark:text-gray-200 mb-3">
                    <i class="fa-solid fa-ellipsis-h mr-2"></i>Variables Lainnya
                </h5>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <h6 class="font-medium text-gray-700 dark:text-gray-300">Verifikator</h6>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NAMA_VERIFIKATOR}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nama verifikator</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NIP_VERIFIKATOR}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">NIP verifikator</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TGL_VERIFIKASI}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal verifikasi</p>
                        </div>

                        <h6 class="font-medium text-gray-700 dark:text-gray-300 mt-4">ID Paket & SP</h6>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${ID_PAKET}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Daftar ID paket e-purchasing</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NO_SP}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor SP</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TANGGAL_SP}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal SP</p>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <h6 class="font-medium text-gray-700 dark:text-gray-300">Lain-lain</h6>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NO_SPK}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor SPK</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${NOMOR_PENETAPAN_PEMENANG}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Nomor penetapan pemenang</p>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm font-mono text-purple-600 dark:text-purple-400">${TGL_PENETAPAN_PEMENANG}</code>
                            <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Tanggal penetapan pemenang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-action pt-6 border-t border-gray-200 dark:border-gray-600">
            <label for="petunjuk-modal" class="btn bg-gray-800 hover:bg-gray-700 text-white dark:bg-gray-100 dark:text-gray-800 dark:hover:bg-gray-200 px-6 py-2 rounded-md">
                <i class="fa-solid fa-times mr-2"></i>Tutup
            </label>
        </div>
    </div>
</div>


    </div>

    <script>
        function setDeleteId(template_id) {
            document.getElementById('deleteForm').action = `template/${template_id}`;
        }

        function showTab(tabName) {
            // Hide all tab contents
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('block');
            });

            // Remove active class from all tabs
            const tabs = document.querySelectorAll('.tab');
            tabs.forEach(tab => {
                tab.classList.remove('tab-active');
            });

            // Show selected tab content
            document.getElementById(tabName).classList.remove('hidden');
            document.getElementById(tabName).classList.add('block');


            // Add active class to clicked tab
            event.target.classList.add('tab-active');
        }

        function setEditData(id, name, fileName) {
            document.getElementById('editForm').action = `{{ url('admin/template') }}/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('current_file').textContent = fileName;
        }

        function downloadTemplate(id) {
            window.location.href = `{{ url('admin/template/download') }}/${id}`;
        }
    </script>

</x-app-layout>
