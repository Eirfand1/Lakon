<form wire:submit.prevent="save" method="POST" class="space-y-2 ">
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

                <input type="hidden"
                    :name="`sub_kegiatan_id[${index}]`"
                    x-model="input.selectedOptionId"
                    x-on:input="$wire.set('sub_kegiatan.' + index, input.selectedOptionId)">
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
            <input type="hidden" name="sekolah_id"
                x-model="selectedOptionId"
                x-on:input="$wire.set('sekolah_id', selectedOptionId)">
        </div>
    </div>

    <div class="flex w-full flex-col ">
        <label for="waktu_paket" class="w-full sm:w-1/4">Waktu Paket*</label>
        <input type="date" name="waktu_paket" id="" wire:model="date"
            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
    </div>

    <div class="flex w-full flex-col  ">
        <label for="jenis_pengadaan" class="w-full sm:w-1/4">Pengadaan*</label>
        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
            <select name="jenis_pengadaan" id="" wire:model="jenis_pengadaan"
                class="sm:w-1/4 w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
                <option value="tender">Tender</option>
                <option value="non_tender">Non-Tender</option>
                <option value="e_catalog">E-Catalog</option>
            </select>

            <select name="metode_pemilihan" id="" wire:model=metode_pemilihan
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
        <input type="number" name="nilai_pagu_paket" id="" wire:model="nilai_pagu_paket"
            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
    </div>

    <div class="flex w-full flex-col ">
        <label for="nilai_pagu_anggaran" class="w-full sm:w-1/4">Nilai Pagu Anggaran*</label>
        <input type="number" name="nilai_pagu_anggaran" id="" wire:model="nilai_pagu_anggaran"
            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
    </div>

    <div class="flex w-full flex-col ">
        <label for="nilai_hps" class="w-full sm:w-1/4">Nilai HPS*</label>
        <input type="number" name="nilai_hps" id="" wire:model="nilai_hps"
            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
    </div>

    <div class="flex w-full flex-col pb-4 ">
        <label for="tahun_anggaran" class="w-full sm:w-1/4">Tahun Anggaran*</label>
        <input type="number" name="tahun_anggaran" id="" wire:model="tahun_anggaran"
            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" required>
    </div>

    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Pejabat Pembuat Komitmen
    </h1>

    <div class="flex w-full flex-col pt-2 ">
        <label for="ppkom_id" class="w-full sm:w-1/4">Ppkom*</label>
        <select name="ppkom_id" id="ppkom_id" wire:model="ppkom_id"
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
            <input type="hidden" name="daskum_id"
                x-model="selectedOptionId"
                x-on:input="$wire.set('daskum_id', selectedOptionId)">
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
