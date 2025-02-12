<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex justify-between flex-wrap">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">PAKET PEKERJAAN</h1>
            <!-- Add Button -->
            <label for="add-modal" class="btn rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                <i class="fa-solid fa-square-plus"></i>
                <span>Tambah Data</span>
            </label>
        </div>
        <!-- Success Message -->

        @if (session('success'))
            <script>
                Toastify({
                    escapeMarkup: false,
                    text: '<i class="fas fa-check-circle mr-2"></i>' + "{{ session('success') }}",
                    duration: 3000,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    style: {
                        background: "linear-gradient(135deg, #2ecc71, #27ae60)",
                        fontWeight: "600",
                        padding: "12px 20px",
                    },
                }).showToast();
            </script>
        @endif
        <!-- error message -->

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
                        textTransform: "uppercase",
                        padding: "12px 20px",
                    },
                }).showToast();
            </script>
        @endif


        <livewire:paket-pekerjaan-table />

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_matriks" class="modal">
            <div class="modal-box max-w-[52rem] mx-auto rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Tambah Data Paket Pekerjaan</h3>
                    </div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.paket-pekerjaan.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <h1 class="border-b font-bold border-gray-200 pb-2 dark:border-gray-700 ">Program kerja</h1>

                    <div x-data="subKegiatanManager({{ json_encode($subKegiatan) }})" class="space-y-2">
                        <label for="sub_kegiatan[]">Sub Kegiatan</label>
                        <template x-for="(input, index) in inputs" :key="index">
                            <div class="relative w-full">
                                <div class="flex items-center gap-2">
                                    <input type="text" x-model="input.search" name="sub_kegiatan[]"
                                        @input.debounce.100ms="filterOptions(index)" @focus="showDropdown(index)"
                                        @click.away="input.showDropdown = false" placeholder="Pilih Sub Kegiatan"
                                        class="w-full rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>


                                    <button type="button" @click="removeInput(index)"
                                        class="text-white bg-error p-2 rounded-lg px-3 hover:text-red-700"
                                        x-show="inputs.length > 1">
                                        <i class="fa-solid fa-xmark"></i>

                                    </button>
                                </div>

                                <div x-show="input.showDropdown && input.filteredOptions.length" x-transition
                                    class="absolute z-10 w-content mt-2  bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                    <template x-for="option in input.filteredOptions" :key="option . sub_kegiatan_id">
                                        <div @click="selectOption(index, option)"
                                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                            x-text="option.nama_sub_kegiatan"></div>
                                    </template>
                                </div>

                                <input type="hidden" :name="`sub_kegiatan_id[${index}]`"
                                    x-model="input.selectedOptionId">

                            </div>
                        </template>

                        <button type="button" @click="addInput" class="btn rounded text-white btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Tambah Sub Kegiatan
                        </button>
                    </div>


                    <div class="flex w-full flex-col pb-4 ">
                        <label for="sumber_dana" class="w-full sm:w-1/4">Sumber dana*</label>
                        <select name="sumber_dana" id=""
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                            <option value="APBN">APBN</option>
                            <option value="APBD">APBD</option>
                            <option value="Swasta">Swasta</option>
                        </select>
                    </div>


                    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Paket Pekerjaan</h1>

                    <div class="pt-2">
                        <label for="paket">Paket*</label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <input type="text" name="kode_paket" id="" placeholder="Kode Paket"
                                class="w-1/2 sm:w-1/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                            <input type="text" name="nama_pekerjaan" id="" placeholder="Nama Paket"
                                class="w-full sm:w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                        </div>
                    </div>



                    <div x-data="sekolahManager({{ json_encode($sekolah) }})" class="flex w-full flex-col">

                        <label for="nama_sekolah" class="w-full sm:w-1/4">Sekolah (Optional)</label>
                        <div class="relative w-full">
                            <input type="text" x-model="search" @input.debounce.100ms="filterOptions()"
                                @focus="showDropdown = true" @click.away="showDropdown = false"
                                placeholder="Pilih Sekolah"
                                class="w-full rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>


                            <i class="fas fa-chevron-down text-sm absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300"></i>

                            <div x-show="showDropdown && filteredOptions.length" x-transition
                                class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="option in filteredOptions" :key="option.sekolah_id">
                                    <div @click="selectOption(option)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                        x-text="option.nama_sekolah"></div>
                                </template>
                            </div>
                            <input type="hidden" name="sekolah_id" x-model="selectedOptionId">
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="waktu_paket" class="w-full sm:w-1/4">Waktu Paket*</label>
                        <input type="date" name="waktu_paket" id=""
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="flex w-full flex-col  ">
                        <label for="jenis_pengadaan" class="w-full sm:w-1/4">Pengadaan*</label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <select name="jenis_pengadaan" id=""
                                class="sm:w-1/4 w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                                <option value="tender">Tender</option>
                                <option value="non_tender">Non-Tender</option>
                                <option value="e_catalog">E-Catalog</option>
                            </select>

                            <select name="metode_pemilihan" id=""
                                class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                                <option value="" disabled selected>Pilih Jenis Pengadaan</option>
                                <option value="Jasa Konsultasi Pengawasan">Jasa Konsultasi Pengawasan</option>
                                <option value="Jasa Konsultasi Perencanaan">Jasa Konsultasi Perencanaan</option>
                                <option value="Jasa Konstruksi">Jasa Konstruksi</option>
                                <option value="Pengadaan Barang">Pengadaan Barang</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_pagu_paket" class="w-full sm:w-1/4">Nilai Pagu Paket*</label>
                        <input type="number" name="nilai_pagu_paket" id=""
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_pagu_anggaran" class="w-full sm:w-1/4">Nilai Pagu Anggaran*</label>
                        <input type="number" name="nilai_pagu_anggaran" id=""
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_hps" class="w-full sm:w-1/4">Nilai HPS*</label>
                        <input type="number" name="nilai_hps" id=""
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="flex w-full flex-col pb-4 ">
                        <label for="tahun_anggaran" class="w-full sm:w-1/4">Tahun Anggaran*</label>
                        <input type="number" name="tahun_anggaran" id=""
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Pejabat Pembuat Komitmen
                    </h1>

                    <div class="flex w-full flex-col pt-2 ">
                        <label for="ppkom_id" class="w-full sm:w-1/4">Ppkom*</label>
                        <select name="ppkom_id" id="ppkom_id"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                            <option value="" disabled selected>Pilih Pegawai</option>
                            @foreach($ppkom as $ppk)
                                <option value="{{ $ppk->ppkom_id }}">{{ $ppk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-data="daskumManager({{ json_encode($dasarHukum) }})" class="flex w-full flex-col pb-4">
                        <label for="daskum_id" class="w-full sm:w-1/4">Dasar Hukum*</label>
                        <div class="relative w-full">
                            <input type="text" x-model="search" @input.debounce.100ms="filterOptions()"
                                @focus="showDropdown = true" @click.away="showDropdown = false"
                                placeholder="Pilih Dasar Hukum"
                                class="w-full rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>

                            <i class="fas fa-chevron-down text-sm absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300"></i>

                            <div x-show="showDropdown && filteredOptions.length" x-transition
                                class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="option in filteredOptions" :key="option . daskum_id">
                                    <div @click="selectOption(option)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                        x-text="option.dasar_hukum"></div>
                                </template>
                            </div>
                            <input type="hidden" name="daskum_id" x-model="selectedOptionId">
                        </div>
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Informasi Satuan Kerja
                    </h1>

                    <input type="text" name="satker_id" id="" value="{{$satuanKerja->satker_id}}" hidden readonly>
                    <div class="flex w-full flex-col py-2 ">
                        <label for="nama_pimpinan" class="w-full sm:w-1/4">Nama pimpinan</label>
                        <input type="text" name="nama_pimpinan" id="" value="{{$satuanKerja->nama_pimpinan}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="jabatan" class="w-full sm:w-1/4">Jabatan</label>
                        <input type="text" name="jabatan" id="" value="{{$satuanKerja->jabatan}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="website" class="w-full sm:w-1/4">Website</label>
                        <input type="text" name="website" id="" value="{{$satuanKerja->website}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>


                    <div class="flex w-full flex-col ">
                        <label for="email" class="w-full sm:w-1/4">Email</label>
                        <input type="text" name="email" id="" value="{{$satuanKerja->email}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="telp" class="w-full sm:w-1/4">Telepon</label>
                        <input type="text" name="telp" id="" value="{{$satuanKerja->telp}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="klpd" class="w-full sm:w-1/4">KLPD</label>
                        <input type="text" name="klpd" id="" value="{{$satuanKerja->klpd}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>



                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded text-white btn-primary">Simpan</button>
                        <label for="add-modal" class="btn btn-ghost">Batal</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div id="modal_matriks" class="modal">
            <div class="modal-box max-w-[52rem] mx-auto rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Edit Data Paket Pekerjaan</h3>
                    </div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form method="POST" class="space-y-2 " id="edit-form">
                    @csrf
                    @method('PUT')
                    <h1 class="border-b font-bold border-gray-200 pb-2 dark:border-gray-700 ">Program kerja</h1>

                    {{-- sub kegiatan --}}
                    <div x-data="subKegiatanManager({{ json_encode($subKegiatan) }})" class="space-y-2" id="sub-kegiatan-edit-manager">
                        <label for="sub_kegiatan[]">Sub Kegiatan</label>
                        <template x-for="(input, index) in inputs" :key="index">
                            <div class="relative w-full">

                                {{-- filed sub kegiatan --}}
                                <div class="flex items-center gap-2">
                                    <input type="text" x-model="input.search" name="sub_kegiatan[]" id="sub_kegiatan[]"
                                        @input.debounce.100ms="filterOptions(index)" @focus="showDropdown(index)"
                                        @click.away="input.showDropdown = false" placeholder="Pilih Sub Kegiatan"
                                        class="w-full rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>


                                    <button type="button" @click="removeInput(index)"
                                        class="text-white bg-error p-2 rounded-lg px-3 hover:text-red-700"
                                        x-show="inputs.length > 1">
                                        <i class="fa-solid fa-xmark"></i>

                                    </button>
                                </div>

                                <div x-show="input.showDropdown && input.filteredOptions.length" x-transition
                                    class="absolute z-10 w-content mt-2  bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                    <template x-for="option in input.filteredOptions" :key="option . sub_kegiatan_id">
                                        <div @click="selectOption(index, option)"
                                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                            x-text="option.nama_sub_kegiatan"></div>
                                    </template>
                                </div>
                                {{-- field sub kegiatan end --}}

                                <input type="hidden" :name="`sub_kegiatan_id[${index}]`"
                                    x-model="input.selectedOptionId">

                            </div>
                        </template>

                        <button type="button" @click="addInput" class="btn rounded text-white btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Tambah Sub Kegiatan
                        </button>
                    </div>

                    {{-- sumber dana || DONE --}}
                    <div class="flex w-full flex-col pb-4 ">
                        <label for="sumber_dana" class="w-full sm:w-1/4">Sumber dana*</label>
                        <select name="sumber_dana" id="sumber_dana"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                            <option value="APBN">APBN</option>
                            <option value="APBD">APBD</option>
                            <option value="Swasta">Swasta</option>
                        </select>
                    </div>

                    {{-- paket pekerjaan || DONE --}}
                    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Paket Pekerjaan</h1>

                    <div class="pt-2">
                        <label for="paket">Paket*</label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <input type="text" name="kode_paket" id="kode_paket" placeholder="Kode Paket"
                                class="w-1/2 sm:w-1/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                            <input type="text" name="nama_pekerjaan" id="nama_pekerjaan" placeholder="Nama Paket"
                                class="w-full sm:w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                        </div>
                    </div>


                    {{-- Sekolah --}}
                    <div x-data="sekolahManager({{ json_encode($sekolah) }})" class="flex w-full flex-col" id="sekolah-edit-manager">

                        <label for="nama_sekolah" class="w-full sm:w-1/4">Sekolah (Optional)</label>
                        <div class="relative w-full">
                            <input type="text" x-model="search" @input.debounce.100ms="filterOptions()" id="nama_sekolah" value="aaaaaaaaa"
                                @focus="showDropdown = true" @click.away="showDropdown = false"
                                placeholder="Pilih Sekolah"
                                class="w-full rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>


                            <i class="fas fa-chevron-down text-sm absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300"></i>

                            <div x-show="showDropdown && filteredOptions.length" x-transition
                                class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="option in filteredOptions" :key="option.sekolah_id">
                                    <div @click="selectOption(option)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                        x-text="option.nama_sekolah"></div>
                                </template>
                            </div>
                            <input type="hidden" name="sekolah_id" x-model="selectedOptionId">
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="waktu_paket" class="w-full sm:w-1/4">Waktu Paket*</label>
                        <input type="date" name="waktu_paket" id="waktu_paket"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="flex w-full flex-col  ">
                        <label for="jenis_pengadaan" class="w-full sm:w-1/4">Pengadaan*</label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <select name="jenis_pengadaan" id="jenis_pengadaan"
                                class="sm:w-1/4 w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                                <option value="tender">Tender</option>
                                <option value="non_tender">Non-Tender</option>
                                <option value="e_catalog">E-Catalog</option>
                            </select>

                            <select name="metode_pemilihan" id="metode_pemilihan"
                                class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                                <option value="" disabled selected>Pilih Jenis Pengadaan</option>
                                <option value="Jasa Konsultasi Pengawasan">Jasa Konsultasi Pengawasan</option>
                                <option value="Jasa Konsultasi Perencanaan">Jasa Konsultasi Perencanaan</option>
                                <option value="Jasa Konstruksi">Jasa Konstruksi</option>
                                <option value="Pengadaan Barang">Pengadaan Barang</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_pagu_paket" class="w-full sm:w-1/4">Nilai Pagu Paket*</label>
                        <input type="number" name="nilai_pagu_paket" id="nilai_pagu_paket"
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_pagu_anggaran" class="w-full sm:w-1/4">Nilai Pagu Anggaran*</label>
                        <input type="number" name="nilai_pagu_anggaran" id="nilai_pagu_anggaran"
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_hps" class="w-full sm:w-1/4">Nilai HPS*</label>
                        <input type="number" name="nilai_hps" id="nilai_hps"
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                    </div>

                    <div class="flex w-full flex-col pb-4 ">
                        <label for="tahun_anggaran" class="w-full sm:w-1/4">Tahun Anggaran*</label>
                        <input type="number" name="tahun_anggaran" id="tahun_anggaran"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Pejabat Pembuat Komitmen
                    </h1>

                    <div class="flex w-full flex-col pt-2 ">
                        <label for="ppkom_id" class="w-full sm:w-1/4">Ppkom*</label>
                        <select name="ppkom_id" id="ppkom_id"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                            <option value="" disabled selected>Pilih Pegawai</option>
                            @foreach($ppkom as $ppk)
                                <option value="{{ $ppk->ppkom_id }}">{{ $ppk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-data="daskumManager({{ json_encode($dasarHukum) }})" class="flex w-full flex-col pb-4" id="daskum-edit-manager">
                        <label for="daskum_id" class="w-full sm:w-1/4">Dasar Hukum*</label>
                        <div class="relative w-full">
                            <input type="text" x-model="search" @input.debounce.100ms="filterOptions()"
                                @focus="showDropdown = true" @click.away="showDropdown = false"
                                placeholder="Pilih Dasar Hukum"
                                class="w-full rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>

                            <i class="fas fa-chevron-down text-sm absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300"></i>

                            <div x-show="showDropdown && filteredOptions.length" x-transition
                                class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="option in filteredOptions" :key="option . daskum_id">
                                    <div @click="selectOption(option)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                        x-text="option.dasar_hukum"></div>
                                </template>
                            </div>
                            <input type="hidden" name="daskum_id" x-model="selectedOptionId">
                        </div>
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Informasi Satuan Kerja
                    </h1>

                    <input type="text" name="satker_id" id="" value="{{$satuanKerja->satker_id}}" hidden readonly>
                    <div class="flex w-full flex-col py-2 ">
                        <label for="nama_pimpinan" class="w-full sm:w-1/4">Nama pimpinan</label>
                        <input type="text" name="nama_pimpinan" id="" value="{{$satuanKerja->nama_pimpinan}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="jabatan" class="w-full sm:w-1/4">Jabatan</label>
                        <input type="text" name="jabatan" id="" value="{{$satuanKerja->jabatan}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="website" class="w-full sm:w-1/4">Website</label>
                        <input type="text" name="website" id="" value="{{$satuanKerja->website}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>


                    <div class="flex w-full flex-col ">
                        <label for="email" class="w-full sm:w-1/4">Email</label>
                        <input type="text" name="email" id="" value="{{$satuanKerja->email}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="telp" class="w-full sm:w-1/4">Telepon</label>
                        <input type="text" name="telp" id="" value="{{$satuanKerja->telp}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="klpd" class="w-full sm:w-1/4">KLPD</label>
                        <input type="text" name="klpd" id="" value="{{$satuanKerja->klpd}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly>
                    </div>



                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded text-white btn-primary">Simpan</button>
                        <label for="edit-modal" class="btn btn-ghost">Batal</label>
                    </div>
                </form>
            </div>
        </div>


        {{-- delete modal --}}
        <input type="checkbox" id="delete-modal" class="modal-toggle" />
        <div class="modal modal-top">
            <div
                class="modal-box w-auto mt-5 mx-auto rounded-lg dark:text-white text-gray-800 bg-gray-100 dark:bg-gray-800">
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
    </div>

    <script>

        function EditHandler(paket){
            const form = document.getElementById('edit-form');
            form.action = `/admin/paket-pekerjaan/${paket.paket_id}`

            // document.getElementById('edit-modal').action = `/admin/paket-pekerjaan/${paket.paket_id}`
            console.log('Form action:', document.getElementById('edit-form').action);
            console.log('Paket ID:', paket.paket_id);

            // INPUT BIASA
            document.getElementById('kode_paket').value = paket.kode_paket
            document.getElementById('nama_pekerjaan').value = paket.nama_pekerjaan
            document.getElementById('waktu_paket').value = paket.waktu_paket
            document.getElementById('nilai_pagu_paket').value = paket.nilai_pagu_paket
            document.getElementById('nilai_pagu_anggaran').value = paket.nilai_pagu_anggaran
            document.getElementById('nilai_hps').value = paket.nilai_hps
            document.getElementById('tahun_anggaran').value = paket.tahun_anggaran

            // INPUT YANG ADA ALPINE
            // sekolah
            const sekolahEditManagerInstance = Alpine.$data(document.getElementById('sekolah-edit-manager'));
            sekolahEditManagerInstance.search = paket['sekolah.nama_sekolah'];
            sekolahEditManagerInstance.selectedOptionId = paket['sekolah.sekolah_id'];

            // dasar hukum
            const daskumEditManagerInstance = Alpine.$data(document.getElementById('daskum-edit-manager'));
            daskumEditManagerInstance.search = paket['dasarHukum.dasar_hukum'];
            daskumEditManagerInstance.selectedOptionId = paket['dasarHukum.daskum_id'];

            // subKegiatan
            const subKegiatanEditManagerInstance = Alpine.$data(document.getElementById('sub-kegiatan-edit-manager'));
            const jumlahInput = paket.sub_kegiatan.length;
            subKegiatanEditManagerInstance.inputs = [];
            for (let i = 0; i < jumlahInput; i++) {
                subKegiatanEditManagerInstance.addInput();
                subKegiatanEditManagerInstance.inputs[i].search = paket.sub_kegiatan[i].nama_sub_kegiatan;
                subKegiatanEditManagerInstance.inputs[i].selectedOptionId = paket.sub_kegiatan[i].sub_kegiatan_id;
            }
            if (jumlahInput == 0) {
                subKegiatanEditManagerInstance.addInput();
            }

            // INPUT TIPE SELECT
            // sumber dana
            const sumberDana = document.getElementById('sumber_dana');
                Array.from(sumberDana.options).forEach(option => {
                    if (option.value == paket.sumber_dana) {
                        option.setAttribute("selected", true);
                    }
                });

            // jenis pengadaan
            const jenis_pengadaan = document.getElementById('jenis_pengadaan');
                Array.from(jenis_pengadaan.options).forEach(option => {
                    if (option.value == paket.jenis_pengadaan) {
                        option.setAttribute("selected", true)
                    }
                })

            // metode pemilihan
            const metode_pemilihan = document.getElementById('metode_pemilihan');
                Array.from(metode_pemilihan.options).forEach(option => {
                    if (option.value == paket.metode_pemilihan) {
                        option.setAttribute("selected", true)
                    }
                })
        }

        function setDeleteId(paket_id) {
            document.getElementById('deleteForm').action = `paket-pekerjaan/${paket_id}`;
        }

        function subKegiatanManager(options) {
            return {
                options: options,
                inputs: [{
                    search: '',
                    filteredOptions: options,
                    showDropdown: false,
                    selectedOptionId: null
                }],

                addInput() {
                    this.inputs.push({
                        search: '',
                        filteredOptions: this.options,
                        showDropdown: false,
                        selectedOptionId: null
                    });
                },

                removeInput(index) {
                    if (this.inputs.length > 1) {
                        this.inputs.splice(index, 1);
                    }
                },

                filterOptions(index) {
                    const searchTerm = this.inputs[index].search.toLowerCase();
                    this.inputs[index].filteredOptions = this.options.filter(option =>
                        option.nama_sub_kegiatan.toLowerCase().includes(searchTerm)
                    );
                    this.inputs[index].showDropdown = this.inputs[index].filteredOptions.length > 0;
                },

                showDropdown(index) {
                    this.inputs[index].showDropdown = true;
                },

                selectOption(index, option) {
                    this.inputs[index].search = option.nama_sub_kegiatan;
                    this.inputs[index].selectedOptionId = option.sub_kegiatan_id;
                    this.inputs[index].showDropdown = false;
                }
            }
        }

        function daskumManager(options) {

            // console.log("daskum options:", options);
            return {
                options: options,
                search: '',
                filteredOptions: options,
                showDropdown: false,
                selectedOptionId: null,

                filterOptions() {
                    const searchTerm = this.search.toLowerCase();
                    this.filteredOptions = this.options.filter(option =>
                        option.dasar_hukum.toLowerCase().includes(searchTerm)
                    );
                    this.showDropdown = this.filteredOptions.length > 0;
                },

                selectOption(option) {
                    this.search = option.dasar_hukum;
                    this.selectedOptionId = option.daskum_id;
                    this.showDropdown = false;
                }
            }
        }


        function sekolahManager(options) {
            // console.log("SekolahManager options:", options);
            return {
                options: options,
                search: '',
                filteredOptions: options,
                showDropdown: false,
                selectedOptionId: null,


                filterOptions() {
                    const searchTerm = this.search.toLowerCase();
                    this.filteredOptions = this.options.filter(option =>
                        option.nama_sekolah.toLowerCase().includes(searchTerm)
                    );
                    this.showDropdown = this.filteredOptions.length > 0;
                },

                selectOption(option) {
                    this.search = option.nama_sekolah;
                    this.selectedOptionId = option.sekolah_id;
                    this.showDropdown = false;
                }
            }
        }

    </script>
</x-app-layout>
