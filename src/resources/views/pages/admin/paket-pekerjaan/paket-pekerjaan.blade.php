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


        <livewire:paket-pekerjaan-table />

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_matriks" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">TAMBAH PAKET PEKERJAAN</h3>
                    </div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle btn-ghost shadow-none rounded-full hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.paket-pekerjaan.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <h1 class="border-b font-bold border-gray-200 text-sm pb-2 dark:border-gray-700 ">PROGRAM KERJA</h1>

                    <div x-data="subKegiatanManager({{ json_encode($subKegiatan) }})" class="space-y-2">
                        <x-label for="sub_kegiatan[]">Sub Kegiatan</x-label>
                        <template x-for="(input, index) in inputs" :key="index">
                            <div class="relative w-full">
                                <div class="flex items-center gap-2">
                                    <x-input type="text" x-model="input.search" name="sub_kegiatan[]"
                                        @input.debounce.100ms="filterOptions(index)" @focus="showDropdown(index)"
                                        @click.away="input.showDropdown = false" placeholder="Pilih Sub Kegiatan"
                                        class="{{ $errors->has('sub_kegiatan_id.*') ? 'border-red-500' : 'border-gray-200' }}"
                                        />

                                    <x-danger-button @click="removeInput(index)" x-show="inputs.length > 1"
                                        @class(['py-0', 'btn-sm'])>
                                        <i class="fa-solid fa-xmark"></i>
                                    </x-danger-button>
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
                                @error('sub_kegiatan_id.*')
                                    <span class="text-red-500 block text-sm">{{$message}}</span>
                                @enderror
                        <button type="button" @click="addInput" class="btn rounded text-white btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Tambah Sub Kegiatan
                        </button>
                    </div>



                    <div class="flex w-full flex-col pb-4">
                        <x-label for="sumber_dana" class="w-full sm:w-1/4">Sumber dana</x-label>
                        <select name="sumber_dana" id="sumber_dana"
                            class="w-3/4 rounded-lg text-sm bg-white dark:bg-gray-900/20 dark:border-gray-700 h-10 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 @error('sumber_dana') border-red-500 @enderror"
                            required>
                            <option value="">Pilih Sumber Dana</option>
                            <option value="APBN" {{ old('sumber_dana') == 'APBN' ? 'selected' : '' }}>APBN</option>
                            <option value="APBD" {{ old('sumber_dana') == 'APBD' ? 'selected' : '' }}>APBD</option>
                            <option value="Swasta" {{ old('sumber_dana') == 'Swasta' ? 'selected' : '' }}>Swasta</option>
                        </select>
                        @error('sumber_dana')
                            <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>


                    <h1 class="border-y border-gray-200 text-sm font-bold py-3  dark:border-gray-700 ">PAKET PEKERJAAN
                    </h1>

                    <div class="pt-2">
                        <x-label for="paket">Paket</x-label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <div class="sm:w-1/4 w-full">
                                <x-input type="text" name="kode_paket" id="" placeholder="Kode Paket"
                                    value="{{old('kode_paket')}}"
                                    class="{{ $errors->has('kode_paket') ? 'border-red-500' : 'border-gray-200' }}"
                                 />
                                @error('kode_paket')
                                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="sm:w-3/4 w-full">
                                <x-input type="text" name="nama_pekerjaan" id="" placeholder="Nama Paket"
                                    value="{{old('nama_pekerjaan')}}" />
                            </div>
                        </div>
                    </div>


                    <div x-data="sekolahManager({{ json_encode($sekolah) }})" class="flex w-full flex-col">

                        <label for="nama_sekolah" class="w-full sm:w-1/4">Sekolah (Optional)</label>
                        <div class="relative w-full">
                            <x-input type="text" x-model="search" @input.debounce.100ms="filterOptions()"
                                @focus="showDropdown = true" @click.away="showDropdown = false"
                                placeholder="Pilih Sekolah"
                                class="{{ $errors->has('sekolah_id') ? 'border-red-500' : 'border-gray-200' }}"
                                 />
                            <i
                                class="fas fa-chevron-down text-sm absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300"></i>

                            <div x-show="showDropdown && filteredOptions.length" x-transition
                                class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="option in filteredOptions" :key="option . sekolah_id">
                                    <div @click="selectOption(option)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                        x-text="option.nama_sekolah"></div>
                                </template>
                            </div>
                            <input type="hidden" name="sekolah_id" x-model="selectedOptionId">
                            @error('sekolah_id')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="waktu_paket" class="w-full sm:w-1/4">Waktu Paket</x-label>
                        <x-input type="date" name="waktu_paket" id="" value="{{old('waktu_paket')}}" />
                    </div>

                    <div class="flex w-full flex-col  ">
                        <x-label for="jenis_pengadaan" class="w-full sm:w-1/4">Pengadaan</x-label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <select name="jenis_pengadaan" id=""
                                class="sm:w-1/4 w-3/4 text-sm  rounded-lg bg-white h-10 dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                required>
                                <option value="tender" {{ old('jenis_pengadaan') == 'tender' ? 'selected' : '' }}>Tender
                                </option>
                                <option value="non_tender" {{ old('jenis_pengadaan') == 'non_tender' ? 'selected' : '' }}>
                                    Non-Tender</option>
                                <option value="e_catalog" {{ old('jenis_pengadaan') == 'e_catalog' ? 'selected' : '' }}>
                                    E-Catalog</option>
                            </select>

                            <select name="metode_pemilihan" id=""
                                class="w-3/4 text-sm rounded-lg bg-white h-10 dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                required>
                                <option value="" disabled {{ old('metode_pemilihan') ? '' : 'selected' }}>Pilih Jenis
                                    Pengadaan</option>
                                <option value="Jasa Konsultasi Pengawasan" {{ old('metode_pemilihan') == 'Jasa Konsultasi Pengawasan' ? 'selected' : '' }}>Jasa Konsultasi Pengawasan</option>
                                <option value="Jasa Konsultasi Perencanaan" {{ old('metode_pemilihan') == 'Jasa Konsultasi Perencanaan' ? 'selected' : '' }}>Jasa Konsultasi Perencanaan</option>
                                <option value="Jasa Konstruksi" {{ old('metode_pemilihan') == 'Jasa Konstruksi' ? 'selected' : '' }}>Jasa Konstruksi</option>
                                <option value="Pengadaan Barang" {{ old('metode_pemilihan') == 'Pengadaan Barang' ? 'selected' : '' }}>Pengadaan Barang</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="nilai_pagu_paket" class="w-full sm:w-1/4">Nilai Pagu Paket</x-label>
                        <x-input type="number" name="nilai_pagu_paket" id="" value="{{old('nilai_pagu_paket')}}"
                             class="{{ $errors->has('nilai_pagu_paket') ? 'border-red-500' : 'border-gray-200' }}"
                            required />
                        @error('nilai_pagu_paket')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="nilai_pagu_anggaran" class="w-full sm:w-1/4">Nilai Pagu Anggaran</x-label>
                        <x-input type="number" name="nilai_pagu_anggaran" value="{{old('nilai_pagu_anggaran')}}" id=""
                            class="{{ $errors->has('nilai_pagu_anggaran') ? 'border-red-500' : 'border-gray-200' }}"
                            required />
                        @error('nilai_pagu_anggaran')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="nilai_hps" class="w-full sm:w-1/4">Nilai HPS</x-label>
                        <x-input type="number" name="nilai_hps" id="" value="{{old('nilai_hps')}}"
                        class="{{ $errors->has('nilai_pagu_anggaran') ? 'border-red-500' : 'border-gray-200' }}"
                        required />

                        @error('nilai_hps')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex w-full flex-col pb-4 ">
                        <x-label for="tahun_anggaran" class="w-full sm:w-1/4">Tahun Anggaran</x-label>
                        <x-input type="number" name="tahun_anggaran" value="{{old('tahun_anggaran')}}" id=""
                        class="{{ $errors->has('tahun_anggaran') ? 'border-red-500' : 'border-gray-200' }}"

                        required />
                        @error('tahun_anggaran')
                            <span class="text-red-500 text-sm mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3 text-sm  dark:border-gray-700 ">PEJABAT PEMBUAT
                        KOMITMEN
                    </h1>

                    <div class="flex w-full flex-col pt-2 ">
                        <x-label for="ppkom_id" class="w-full sm:w-1/4">Ppkom</x-label>
                        <select name="ppkom_id" id="ppkom_id"
                            class="w-3/4 rounded bg-white h-10 text-sm dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            required>
                            <option value="" disabled selected>Pilih Pegawai</option>
                            @foreach($ppkom as $ppk)
                                <option value="{{ $ppk->ppkom_id }}">{{ $ppk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-data="daskumManager({{ json_encode($dasarHukum) }})" class="flex w-full flex-col pb-4">
                        <x-label for="daskum_id" class="w-full sm:w-1/4">Dasar Hukum</x-label>
                        <div class="relative w-full">
                            <x-input type="text" x-model="search" @input.debounce.100ms="filterOptions()"
                                @focus="showDropdown = true" @click.away="showDropdown = false"
                                placeholder="Pilih Dasar Hukum"
                                class="{{ $errors->has('daskum_id') ? 'border-red-500' : 'border-gray-200' }}"
                                required />

                            <i
                                class="fas fa-chevron-down text-sm absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300"></i>

                            <div x-show="showDropdown && filteredOptions.length" x-transition
                                class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="option in filteredOptions" :key="option . daskum_id">
                                    <div @click="selectOption(option)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                        x-text="option.dasar_hukum"></div>
                                </template>
                            </div>
                            <input type="hidden" name="daskum_id" x-model="selectedOptionId">

                            @error('daskum_id')
                                <span class="text-red-500 text-sm mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3 text-sm  dark:border-gray-700 ">INFORMASI SATUAN
                        KERJA
                    </h1>

                    <input type="text" name="satker_id" id="" value="{{$satuanKerja->satker_id}}" hidden readonly>
                    <div class="flex w-full flex-col py-2 ">
                        <x-label for="nama_pimpinan" class="w-full sm:w-1/4">Nama pimpinan</x-label>
                        <x-input type="text" name="nama_pimpinan" id="" value="{{$satuanKerja->nama_pimpinan}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="jabatan" class="w-full sm:w-1/4">Jabatan</x-label>
                        <x-input type="text" name="jabatan" id="" value="{{$satuanKerja->jabatan}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="website" class="w-full sm:w-1/4">Website</x-label>
                        <x-input type="text" name="website" id="" value="{{$satuanKerja->website}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>


                    <div class="flex w-full flex-col ">
                        <x-label for="email" class="w-full sm:w-1/4">Email</x-label>
                        <x-input type="text" name="email" id="" value="{{$satuanKerja->email}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="telp" class="w-full sm:w-1/4">Telepon</x-label>
                        <x-input type="text" name="telp" id="" value="{{$satuanKerja->telp}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="klpd" class="w-full sm:w-1/4">KLPD</x-label>
                        <x-input type="text" name="klpd" id="" value="{{$satuanKerja->klpd}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>


                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded-md btn-primary text-white bg-blue-600">Simpan</button>
                        <label for="add-modal"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div id="modal_matriks" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">EDIT PAKET PEKERJAAN</h3>
                    </div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle rounded-full shadow-none btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form method="POST" class="space-y-2 " id="edit-form">
                    @csrf
                    @method('PUT')
                    <h1 class="border-b font-bold border-gray-200 text-sm pb-2 dark:border-gray-700 ">PROGRAM KERJA</h1>

                    {{-- sub kegiatan --}}
                    <div x-data="subKegiatanManager({{ json_encode($subKegiatan) }})" class="space-y-2"
                        id="sub-kegiatan-edit-manager">
                        <x-label for="sub_kegiatan[]">Sub Kegiatan</x-label>
                        <template x-for="(input, index) in inputs" :key="index">
                            <div class="relative w-full">

                                {{-- filed sub kegiatan --}}
                                <div class="flex items-center gap-2">
                                    <x-input type="text" x-model="input.search" name="sub_kegiatan[]"
                                        id="sub_kegiatan[]" @input.debounce.100ms="filterOptions(index)"
                                        @focus="showDropdown(index)" @click.away="input.showDropdown = false"
                                        placeholder="Pilih Sub Kegiatan"
                                        class="{{ $errors->has('sub_kegiatan_id.*') ? 'border-red-500' : 'border-gray-200' }}"
                                        required />


                                    <x-danger-button type="button" @click="removeInput(index)"
                                        x-show="inputs.length > 1">
                                        <i class="fa-solid fa-xmark"></i>

                                    </x-danger-button>
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

                        @error('sub_kegiatan_id.*')
                            <span class="text-sm text-red-500"></span>
                        @enderror

                        <button type="button" @click="addInput" class="btn rounded text-white btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i> Tambah Sub Kegiatan
                        </button>
                    </div>

                    {{-- sumber dana || DONE --}}
                    <div class="flex w-full flex-col pb-4 ">
                        <x-label for="sumber_dana" class="w-full sm:w-1/4">Sumber dana</x-label>
                        <select name="sumber_dana" id="sumber_dana"
                            class="w-3/4 rounded-lg text-sm bg-white dark:bg-gray-900/20 dark:border-gray-700 h-10 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            required>
                            <option value="APBN" {{old('sumber_dana') == 'APBN' ? 'selected' : ""}}>APBN</option>
                            <option value="APBD" {{old('sumber_dana') == 'APBD' ? 'selected' : ""}}>APBD</option>
                            <option value="Swasta" {{old('sumber_dana') == 'Swasta' ? 'selected' : ""}}>Swasta</option>
                        </select>
                    </div>

                    {{-- paket pekerjaan || DONE --}}
                    <h1 class="border-y border-gray-200 font-bold py-3 text-sm  dark:border-gray-700 ">PAKET PEKERJAAN
                    </h1>

                    <div class="pt-2">
                        <x-label for="paket">Paket</x-label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <div class="sm:w-1/4 w-full">
                            <x-input type="text" name="kode_paket" id="kode_paket" placeholder="Kode Paket"
                                class="{{ $errors->has('kode_paket') ? 'border-red-500' : 'border-gray-200' }}"
                                required />
                                @error('kode_paket')
                                    <span class="text-red-500 text-sm mt-1">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="sm:w-3/4 w-full">
                            <x-input type="text" name="nama_pekerjaan" id="nama_pekerjaan" placeholder="Nama Paket"
                                required />
                            </div>
                        </div>
                    </div>


                    {{-- Sekolah --}}
                    <div x-data="sekolahManager({{ json_encode($sekolah) }})" class="flex w-full flex-col"
                        id="sekolah-edit-manager">

                        <x-label for="nama_sekolah" class="w-full sm:w-1/4">Sekolah (Optional)</x-label>
                        <div class="relative w-full">
                            <x-input type="text" x-model="search" @input.debounce.100ms="filterOptions()"
                                id="nama_sekolah" value="aaaaaaaaa" @focus="showDropdown = true"
                                @click.away="showDropdown = false" placeholder="Pilih Sekolah"
                                class="{{ $errors->has('sekolah_id') ? 'border-red-500' : 'border-gray-200' }}"
                                required />
                            <i
                                class="fas fa-chevron-down text-sm absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300"></i>

                            <div x-show="showDropdown && filteredOptions.length" x-transition
                                class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="option in filteredOptions" :key="option . sekolah_id">
                                    <div @click="selectOption(option)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                        x-text="option.nama_sekolah"></div>
                                </template>
                            </div>
                            <input type="hidden" name="sekolah_id" x-model="selectedOptionId">

                            @error('sekolah_id')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="waktu_paket" class="w-full sm:w-1/4">Waktu Paket</x-label>
                        <x-input type="date" name="waktu_paket" id="waktu_paket" />
                    </div>

                    <div class="flex w-full flex-col  ">
                        <x-label for="jenis_pengadaan" class="w-full sm:w-1/4">Pengadaan</x-label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <select name="jenis_pengadaan" id="jenis_pengadaan"
                                class="sm:w-1/4 w-3/4 text-sm h-10 rounded-lg bg-white dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                required>
                                <option value="tender">Tender</option>
                                <option value="non_tender">Non-Tender</option>
                                <option value="e_catalog">E-Catalog</option>
                            </select>

                            <select name="metode_pemilihan" id="metode_pemilihan"
                                class="w-3/4 rounded text-sm bg-white dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                required>
                                <option value="" disabled selected>Pilih Jenis Pengadaan</option>
                                <option value="Jasa Konsultasi Pengawasan">Jasa Konsultasi Pengawasan</option>
                                <option value="Jasa Konsultasi Perencanaan">Jasa Konsultasi Perencanaan</option>
                                <option value="Jasa Konstruksi">Jasa Konstruksi</option>
                                <option value="Pengadaan Barang">Pengadaan Barang</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="nilai_pagu_paket" class="w-full sm:w-1/4">Nilai Pagu Paket</x-label>
                        <x-input type="number" name="nilai_pagu_paket" id="nilai_pagu_paket"
                        class="{{ $errors->has('nilai_pagu_paket') ? 'border-red-500' : 'border-gray-200' }}"
                        required />
                        @error('nilai_pagu_paket')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="nilai_pagu_anggaran" class="w-full sm:w-1/4">Nilai Pagu Anggaran</x-label>
                        <x-input type="number" name="nilai_pagu_anggaran" id="nilai_pagu_anggaran"
                        class="{{ $errors->has('nilai_pagu_anggaran') ? 'border-red-500' : 'border-gray-200' }}"
                        required />

                        @error('nilai_pagu_anggaran')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="nilai_hps" class="w-full sm:w-1/4">Nilai HPS</x-label>
                        <x-input type="number" name="nilai_hps" id="nilai_hps"
                        class="{{ $errors->has('nilai_hps') ? 'border-red-500' : 'border-gray-200' }}"
                        required
                        />
                        @error('nilai_hps')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="flex w-full flex-col pb-4 ">
                        <x-label for="tahun_anggaran" class="w-full sm:w-1/4">Tahun Anggaran</x-label>
                        <x-input type="number" name="tahun_anggaran" id="tahun_anggaran" required
                        class="{{ $errors->has('tahun_anggaran') ? 'border-red-500' : 'border-gray-200' }}"
                        />
                        @error('tahun_anggaran')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3  text-sm dark:border-gray-700 ">PEJABAT PEMBUAT
                        KOMITMEN
                    </h1>

                    <div class="flex w-full flex-col pt-2 ">
                        <x-label for="ppkom_id" class="w-full sm:w-1/4">Ppkom</x-label>
                        <select name="ppkom_id" id="ppkom_id"
                            class="w-3/4  h-10 bg-white dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            required>
                            <option value="" disabled selected>Pilih Pegawai</option>
                            @foreach($ppkom as $ppk)
                                <option value="{{ $ppk->ppkom_id }}">{{ $ppk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div x-data="daskumManager({{ json_encode($dasarHukum) }})" class="flex w-full flex-col pb-4"
                        id="daskum-edit-manager">
                        <x-label for="daskum_id" class="w-full sm:w-1/4">Dasar Hukum</x-label>
                        <div class="relative w-full">
                            <x-input type="text" name="daskum" x-model="search" @input.debounce.100ms="filterOptions()"
                                @focus="showDropdown = true" @click.away="showDropdown = false"
                                placeholder="Pilih Dasar Hukum" required
                                class="{{ $errors->has('daskum_id') ? 'border-red-500' : 'border-gray-200' }}"
                                />

                            <i
                                class="fas fa-chevron-down text-sm absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500 dark:text-gray-300"></i>

                            <div x-show="showDropdown && filteredOptions.length" x-transition
                                class="absolute z-10 w-full mt-2 bg-white dark:bg-gray-700 border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                <template x-for="option in filteredOptions" :key="option . daskum_id">
                                    <div @click="selectOption(option)"
                                        class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer"
                                        x-text="option.dasar_hukum"></div>
                                </template>
                            </div>
                            <input type="hidden" name="daskum_id" x-model="selectedOptionId"
                                value="{{old('daskum_id')}}">
                            @error('daskum_id')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3 text-sm  dark:border-gray-700 ">INFORMASI SATUAN
                        KERJA
                    </h1>

                    <input type="text" name="satker_id" id="" value="{{$satuanKerja->satker_id}}" hidden readonly>
                    <div class="flex w-full flex-col py-2 ">
                        <x-label for="nama_pimpinan" class="w-full sm:w-1/4">Nama pimpinan</x-label>
                        <x-input type="text" name="nama_pimpinan" id="" value="{{$satuanKerja->nama_pimpinan}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="jabatan" class="w-full sm:w-1/4">Jabatan</x-label>
                        <x-input type="text" name="jabatan" id="" value="{{$satuanKerja->jabatan}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="website" class="w-full sm:w-1/4">Website</x-label>
                        <x-input type="text" name="website" id="" value="{{$satuanKerja->website}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>


                    <div class="flex w-full flex-col ">
                        <x-label for="email" class="w-full sm:w-1/4">Email</x-label>
                        <x-input type="text" name="email" id="" value="{{$satuanKerja->email}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="telp" class="w-full sm:w-1/4">Telepon</x-label>
                        <x-input type="text" name="telp" id="" value="{{$satuanKerja->telp}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="klpd" class="w-full sm:w-1/4">KLPD</x-label>
                        <x-input type="text" name="klpd" id="" value="{{$satuanKerja->klpd}}"
                            class="rounded bg-gray-200 dark:bg-gray-600 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            readonly />
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded-md text-white bg-blue-600 btn-primary">Simpan</button>
                        <label for="edit-modal"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>


        {{-- delete modal --}}
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
                        <x-danger-button type="submit">
                            <i class="fa-solid fa-trash"></i>
                            <span>Hapus</span>
                        </x-danger-button>
                        <label for="delete-modal"
                            class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        function EditHandler(paket) {
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
