<x-app-layout>

    <div class="p-5">
        <div class="mb-4 flex justify-between flex-wrap">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">PAKET PEKERJAAN</h1>
            <div class="flex gap-2">
                <div>
                    <a href="{{ route('admin.paket-pekerjaan.export') }}"
                    class="btn btn-success btn-sm rounded text-white">
                    <i class="fa-solid fa-file-export"></i>
                    <span>
                        Export to Excel
                    </span>
                </a>
            </div>
            <!-- Add Button -->
            <label for="add-modal" class="btn rounded btn-sm px-3 bg-gray-800 hover:bg-gray-700 text-white dark:bg-gray-100 dark:text-gray-800 ">
                <i class="fa-solid fa-square-plus"></i>
                <span>Tambah Data</span>
            </label>
        </div>

    </div>


    <livewire:paket-pekerjaan-table />

    <!-- Add Modal -->
    <input type="checkbox" id="add-modal" class="modal-toggle" {{ $errors->any() ? 'checked' : '' }} />
    <div id="modal_matriks" class="modal modal-top px-3">
        <div class="modal-box max-w-[55rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
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

            <div class="flex w-full flex-col ">
                <x-label for="nomor_matrik" class="w-full sm:w-1/4">Nomor Matrik</x-label>
                <x-input type="text" name="nomor_matrik" id="" value="{{old('nomor_matrik', $next_nomor_matrik)}}" required />
            </div>

            <h1 class="border-b font-bold border-gray-200 text-sm pb-2 dark:border-gray-700 ">PROGRAM KERJA</h1>

            <div x-data="subKegiatanMultipleManager({{ json_encode($subKegiatan) }})" class="space-y-2">
                <x-label for="sub_kegiatan">Sub Kegiatan</x-label>
                <select name="sub_kegiatan_id[]"
                id="sub_kegiatan_multiple"
                class="choices-multiple rounded-md dark:bg-gray-800  w-full {{ $errors->has('sub_kegiatan_id.*') ? 'border-red-500' : 'border-gray-200' }}"
                multiple
                x-ref="multipleSelect">
                <template x-for="option in options" :key="option.sub_kegiatan_id">

                    <option :value="option.sub_kegiatan_id"
                    x-text="option.pendidikan ? '(' + option.pendidikan + ') ' + option.nama_sub_kegiatan : option.nama_sub_kegiatan"
                    :selected="({{ json_encode(old('sub_kegiatan_id', [])) }}).includes(String(option.sub_kegiatan_id))">
                </option>
            </template>
        </select>
        @error('sub_kegiatan_id.*')
        <span class="text-red-500 block text-sm">{{$message}}</span>
        @enderror
    </div>


    <div class="flex w-full flex-col pb-4">
        <x-label for="sumber_dana" class="w-full sm:w-1/4">Sumber dana</x-label>
        <select name="sumber_dana" id="sumber_dana"
        class="w-3/4 rounded-lg text-sm bg-white dark:bg-gray-800 dark:border-gray-700 h-10 block w-full rounded-md border-gray-200 shadow-sm  focus:ring-gray-600 @error('sumber_dana') border-red-500 @enderror"
        required>
        <option value="">Pilih Sumber Dana</option>
        <option value="APBD" {{ old('sumber_dana') == 'APBD' ? 'selected' : '' }}>APBD</option>
        <option value="DAK" {{ old('sumber_dana') == 'DAK' ? 'selected' : '' }}>DAK</option>
        <option value="BANKEU" {{ old('sumber_dana') == 'BANKEU' ? 'selected' : '' }}>BANKEU</option>
        <option value="APBD Perubahan" {{ old('sumber_dana') == 'APBD Perubahan' ? 'selected' : '' }}>
            APBD Perubahan</option>
            <option value="APBD Perubahan Biasa" {{ old('sumber_dana') == 'APBD Perubahan Biasa' ? 'selected' : '' }}>APBD Perubahan Biasa</option>
            <option value="BANKEU Perubahan" {{ old('sumber_dana') == 'BANKEU Perubahan' ? 'selected' : '' }}>BANKEU Perubahan</option>
            <option value="SG" {{ old('sumber_dana') == 'SG' ? 'selected' : '' }}>SG</option>
            <option value="Bantuan Pemerintah" {{ old('sumber_dana') == 'Bantuan Pemerintah' ? 'selected' : '' }}>Bantuan Pemerintah</option>
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
                <x-input type="text" name="kode_sirup" id="" placeholder="Kode Sirup"
                value="{{old('kode_sirup')}}"
                class="{{ $errors->has('kode_sirup') ? 'border-red-500' : 'border-gray-200' }}" />
                @error('kode_sirup')
                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>


            <div class="sm:w-3/4 w-full">
                <x-input type="text" name="nama_pekerjaan" id="" placeholder="Nama Paket"
                value="{{old('nama_pekerjaan')}}" />
            </div>
        </div>
    </div>



    <div x-data="sekolahSingleManager( {{ json_encode($sekolah) }})" x-init="init" class="w-full">
        <label for="sekolah_id" class="block mb-1">Sekolah (Optional)</label>
        <select x-ref="sekolahSelect" name="sekolah_id" id="sekolah_id"
        class="choices w-full {{ $errors->has('sekolah_id') ? 'border-red-500' : 'border-gray-200' }}">

        <option selected disabled>Pilih Sekolah</option>
        <template x-for="option in options" :key="option.sekolah_id">
            <option :value="option.sekolah_id" x-text="option.nama_sekolah" x-bind:selected="option.sekolah_id == {{old('sekolah_id')}} ? 'selected' : ''"></option>
        </template>

    </select>
    @error('sekolah_id')
    <span class="text-sm text-red-500 mt-1">{{ $message }}</span>
    @enderror
</div>

<div class="flex w-full flex-col ">
    <x-label for="waktu_paket" class="w-full sm:w-1/4">Waktu Paket</x-label>
    <x-input type="date" name="waktu_paket" id="" value="{{old('waktu_paket')}}" required />
</div>

<div class="flex w-full flex-col  ">
    <x-label for="metode_pemilihan" class="w-full sm:w-1/4">Pengadaan</x-label>
    <div class="flex gap-2 flex-wrap sm:flex-nowrap">
        <select name="metode_pemilihan" id=""
        class="sm:w-1/4 w-3/4 text-sm  rounded-lg bg-white h-10 dark:bg-gray-800 dark:border-gray-700 block w-full rounded-md  border-gray-200 shadow-sm focus:ring-0"
        required>
        <option value="" disabled {{ old('metode_pemilihan') ? '' : 'selected' }}>Pilih Metode Pemilihan</option>
        <option value=" Tender" {{ old('metode_pemilihan') == 'Tender' ? 'selected' : '' }}>Tender</option>
        <option value="Non Tender" {{ old('metode_pemilihan') == 'Non Tender' ? 'selected' : '' }}>Non Tender</option>
        <option value="E-Katalog" {{ old('metode_pemilihan') == 'E-Katalog' ? 'selected' : '' }}>E-Katalog</option>
        <option value="Swakelola" {{ old('metode_pemilihan') == 'Swakelola' ? 'selected' : '' }}>Swakelola</option>
    </select>

    <select name="jenis_pengadaan" id=""
    class="w-3/4 text-sm rounded-lg bg-white h-10 dark:bg-gray-800 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
    required>
    <option value="" disabled {{ old('jenis_pengadaan') ? '' : 'selected' }}>Pilih Jenis Pengadaan</option>
    <option value="Jasa Konsultasi Pengawasan" {{ old('jenis_pengadaan') == 'Jasa Konsultasi Pengawasan' ? 'selected' : '' }}>Jasa Konsultasi Pengawasan</option>
    <option value="Jasa Konsultasi Perencanaan" {{ old('jenis_pengadaan') == 'Jasa Konsultasi Perencanaan' ? 'selected' : '' }}>Jasa Konsultasi Perencanaan</option>
    <option value="Pekerjaan Konstruksi" {{ old('jenis_pengadaan') == 'Pekerjaan Konstruksi' ? 'selected' : '' }}>Pekerjaan Konstruksi</option>
    <option value="Pengadaan Barang" {{ old('jenis_pengadaan') == 'Pengadaan Barang' ? 'selected' : '' }}>Pengadaan Barang</option>
</select>
</div>
</div>

<div class="flex w-full flex-col">
    <x-label for="nilai_pagu_paket_display" class="w-full sm:w-1/4">Nilai Pagu Paket</x-label>
    <x-input type="text" name="nilai_pagu_paket_display" id="nilai_pagu_paket_display"
    value="{{old('nilai_pagu_paket') ? 'Rp ' . number_format(old('nilai_pagu_paket'), 0, ',', '.') : ''}}"
    class="{{ $errors->has('nilai_pagu_paket') ? 'border-red-500' : 'border-gray-200' }}"
    oninput="formatRupiah(this, 'nilai_pagu_paket')" placeholder="Nilai Pagu Paket" required />
    <input type="hidden" name="nilai_pagu_paket" id="nilai_pagu_paket"
    value="{{old('nilai_pagu_paket')}}" />
    @error('nilai_pagu_paket')
    <span class="text-sm text-red-500 mt-1">{{$message}}</span>
    @enderror
</div>

<div class="flex w-full flex-col">
    <x-label for="nilai_pagu_anggaran_display" class="w-full sm:w-1/4">Nilai Pagu Anggaran</x-label>
    <x-input type="text" name="nilai_pagu_anggaran_display" id="nilai_pagu_anggaran_display"
    value="{{old('nilai_pagu_anggaran') ? 'Rp ' . number_format(old('nilai_pagu_anggaran'), 0, ',', '.') : ''}}"
    class="{{ $errors->has('nilai_pagu_anggaran') ? 'border-red-500' : 'border-gray-200' }}"
    oninput="formatRupiah(this, 'nilai_pagu_anggaran')" placeholder="Nilai Pagu Anggaran"
    required />
    <input type="hidden" name="nilai_pagu_anggaran" id="nilai_pagu_anggaran"
    value="{{old('nilai_pagu_anggaran')}}" />
    @error('nilai_pagu_anggaran')
    <span class="text-sm text-red-500 mt-1">{{$message}}</span>
    @enderror
</div>

<div class="flex w-full flex-col">
    <x-label for="nilai_hps_display" class="w-full sm:w-1/4">Nilai HPS</x-label>
    <x-input type="text" name="nilai_hps_display" id="nilai_hps_display"
    value="{{old('nilai_hps') ? 'Rp ' . number_format(old('nilai_hps'), 0, ',', '.') : ''}}"
    class="{{ $errors->has('nilai_hps') ? 'border-red-500' : 'border-gray-200' }}"
    oninput="formatRupiah(this, 'nilai_hps')" placeholder="Nilai HPS" required />
    <input type="hidden" name="nilai_hps" id="nilai_hps" value="{{old('nilai_hps')}}" />
    @error('nilai_hps')
    <span class="text-sm text-red-500 mt-1">{{$message}}</span>
    @enderror
</div>

<div class="flex w-full flex-col pb-4 ">
    <x-label for="tahun_anggaran" class="w-full sm:w-1/4">Tahun Anggaran</x-label>
    <x-input type="number" name="tahun_anggaran" value="{{old('tahun_anggaran')}}" id=""
    class="{{ $errors->has('tahun_anggaran') ? 'border-red-500' : 'border-gray-200' }}"
    placeholder="Tahun Anggaran" required />
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
    class="w-3/4 rounded bg-white h-10 text-sm dark:bg-gray-800 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm "
    required>
    <option value="" disabled selected>Pilih Pegawai</option>
    @foreach($ppkom as $ppk)
    <option value="{{ $ppk->ppkom_id }}" selected>{{ $ppk->nama }}</option>
    @endforeach
</select>
</div>


<div x-data="daskumSingleManager(@js($dasarHukum), @js(old('daskum_id') ?? null))" x-init="init" class="w-full">
    <label for="daskum_id" class="block mb-1">Dasar Hukum</label>
    <select x-ref="daskumSelect" name="daskum_id" id="daskum_id"
    class="choices w-full {{ $errors->has('daskum_id') ? 'border-red-500' : 'border-gray-200' }}">

    <option selected disabled>Pilih dasar hukum</option>
    <template x-for="option in options" :key="option.daskum_id">
        <option :value="option.daskum_id" x-text="option.dasar_hukum" :selected="option.daskum_id == {{ json_encode(old('daskum_id')) }}"></option>
    </template>

</select>
@error('daskum_id')
<span class="text-sm text-red-500 mt-1">{{ $message }}</span>
@enderror
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
                            <button type="submit" class="btn rounded-md btn-primary text-white bg-blue-600">
                                <i class="fas fa-save"></i>
                                Simpan
                            </button>
                            <label for="add-modal"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                        </div>
                    </form>
                </div>
                <label class="modal-backdrop" for="add-modal">Close</label>
            </div>

            <!-- Edit Modal -->
            <input type="checkbox" id="edit-modal" class="modal-toggle" />
            <div id="modal_matriks" class="modal modal-top px-3">
                <div class="modal-box max-w-[55rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
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

                    <div class="flex w-full flex-col ">
                        <x-label for="nomor_matrik" class="w-full sm:w-1/4">Nomor Matrik</x-label>
                        <x-input type="text" name="nomor_matrik" id="nomor_matrik_edit" value="{{old('nomor_matrik')}}" required />
                    </div>

                    <h1 class="border-b font-bold border-gray-200 text-sm pb-2 dark:border-gray-700 ">PROGRAM KERJA</h1>

                    <div x-data="subKegiatanMultipleManager({{ json_encode($subKegiatan) }})" class="space-y-2" id="sub-kegiatan-edit-manager">
                        <x-label for="sub_kegiatan">Sub Kegiatan</x-label>
                        <select name="sub_kegiatan_id[]"
                        id="sub_kegiatan_multiple_edit"
                        class="choices-multiple w-full {{ $errors->has('sub_kegiatan_id.*') ? 'border-red-500' : 'border-gray-200' }}"
                        multiple
                        x-ref="multipleSelect"
                        required>
                        <template x-for="option in options" :key="option.sub_kegiatan_id">
                            <option :value="option.sub_kegiatan_id"
                            x-text="option.pendidikan ? '(' + option.pendidikan + ') ' + option.nama_sub_kegiatan : option.nama_sub_kegiatan">
                        </option>
                    </template>
                </select>
                @error('sub_kegiatan_id.*')
                <span class="text-sm text-red-500">{{$message}}</span>
                @enderror
            </div>



            {{-- sumber dana || DONE --}}
            <div class="flex w-full flex-col pb-4 ">
                <x-label for="sumber_dana" class="w-full sm:w-1/4">Sumber dana</x-label>
                <select name="sumber_dana" id="sumber_dana"
                class="w-3/4 rounded-lg text-sm bg-white dark:bg-gray-800 dark:border-gray-700 h-10 block w-full rounded-md border-gray-200 shadow-sm "
                required>
                <option value="APBD" {{ old('sumber_dana') == 'APBD' ? 'selected' : '' }}>APBD</option>
                <option value="DAK" {{ old('sumber_dana') == 'DAK' ? 'selected' : '' }}>DAK</option>
                <option value="BANKEU" {{ old('sumber_dana') == 'BANKEU' ? 'selected' : '' }}>BANKEU</option>
                <option value="APBD Perubahan" {{ old('sumber_dana') == 'APBD Perubahan' ? 'selected' : '' }}>
                    APBD Perubahan</option>
                    <option value="APBD Perubahan Biasa" {{ old('sumber_dana') == 'APBD Perubahan Biasa' ? 'selected' : '' }}>APBD Perubahan Biasa</option>
                    <option value="BANKEU Perubahan" {{ old('sumber_dana') == 'BANKEU Perubahan' ? 'selected' : '' }}>BANKEU Perubahan</option>
                    <option value="SG" {{ old('sumber_dana') == 'SG' ? 'selected' : '' }}>SG</option>
                    <option value="Bantuan Pemerintah" {{ old('sumber_dana') == 'Bantuan Pemerintah' ? 'selected' : '' }}>Bantuan Pemerintah</option>
                </select>
            </div>

            {{-- paket pekerjaan || DONE --}}
            <h1 class="border-y border-gray-200 font-bold py-3 text-sm  dark:border-gray-700 ">PAKET PEKERJAAN
            </h1>

            <div class="pt-2">
                <x-label for="paket">Paket</x-label>
                <div class="flex gap-2 flex-wrap sm:flex-nowrap">

                    <div class="sm:w-1/4 w-full">
                        <x-input type="text" name="kode_sirup" id="kode_sirup" placeholder="Kode Sirup"
                        class="{{ $errors->has('kode_sirup') ? 'border-red-500' : 'border-gray-200' }}"
                        required />
                        @error('kode_sirup')
                        <span class="text-red-500 text-sm mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="sm:w-3/4 w-full">
                        <x-input type="text" name="nama_pekerjaan" id="nama_pekerjaan" placeholder="Nama Paket"
                        required />
                    </div>
                </div>
            </div>


            <div x-data="sekolahSingleManager({{ json_encode($sekolah) }})"
            class="space-y-2"
            id="sekolah-edit-manager">

            <x-label for="sekolah_id">Sekolah (Optional)</x-label>

            <select name="sekolah_id"
            id="sekolah_single_edit"
            class="choices w-full {{ $errors->has('sekolah_id') ? 'border-red-500' : 'border-gray-200' }}"
            x-ref="sekolahSelect"
            required>
            <template x-for="option in options" :key="option.sekolah_id">
                <option :value="option.sekolah_id" x-text="option.nama_sekolah"></option>
            </template>
        </select>

        @error('sekolah_id')
        <span class="text-sm text-red-500">{{ $message }}</span>
        @enderror
    </div>



    <div class="flex w-full flex-col ">
        <x-label for="waktu_paket" class="w-full sm:w-1/4">Waktu Paket</x-label>
        <x-input type="date" name="waktu_paket" id="waktu_paket" required />
    </div>

    <div class="flex w-full flex-col  ">
        <x-label for="metode_pemilihan" class="w-full sm:w-1/4">Pengadaan</x-label>
        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
            <select name="metode_pemilihan" id="metode_pemilihan"
            class="sm:w-1/4 w-3/4 text-sm h-10 rounded-lg bg-white dark:bg-gray-800 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm"
            required>
            <option value="Tender">Tender</option>
            <option value="Non Tender">Non Tender</option>
            <option value="E-Katalog">E-Katalog</option>
            <option value="Swakelola">Swakelola</option>
        </select>

        <select name="jenis_pengadaan" id="jenis_pengadaan"
        class="w-3/4 rounded text-sm bg-white dark:bg-gray-800 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm"
        required>
        <option value="Jasa Konsultasi Pengawasan">Jasa Konsultasi Pengawasan</option>
        <option value="Jasa Konsultasi Perencanaan">Jasa Konsultasi Perencanaan</option>
        <option value="Pekerjaan Konstruksi">Pekerjaan Konstruksi</option>
        <option value="Pengadaan Barang">Pengadaan Barang</option>
    </select>
</div>
</div>

<div class="flex w-full flex-col">
    <x-label for="nilai_pagu_paket_display" class="w-full sm:w-1/4">Nilai Pagu Paket</x-label>
    <x-input type="text" name="nilai_pagu_paket_display" id="nilai_pagu_paket_display_edit"
    class="{{ $errors->has('nilai_pagu_paket') ? 'border-red-500' : 'border-gray-200' }}"
    oninput="formatRupiah(this, 'nilai_pagu_paket')" required />
    <input type="hidden" name="nilai_pagu_paket" id="nilai_pagu_paket_edit" />
    @error('nilai_pagu_paket')
    <span class="text-sm text-red-500 mt-1">{{$message}}</span>
    @enderror
</div>

<div class="flex w-full flex-col">
    <x-label for="nilai_pagu_anggaran_display" class="w-full sm:w-1/4">Nilai Pagu Anggaran</x-label>
    <x-input type="text" name="nilai_pagu_anggaran_display" id="nilai_pagu_anggaran_display_edit"
    class="{{ $errors->has('nilai_pagu_anggaran') ? 'border-red-500' : 'border-gray-200' }}"
    oninput="formatRupiah(this, 'nilai_pagu_anggaran')" required />
    <input type="hidden" name="nilai_pagu_anggaran" id="nilai_pagu_anggaran_edit" />
    @error('nilai_pagu_anggaran')
    <span class="text-sm text-red-500 mt-1">{{$message}}</span>
    @enderror
</div>

<div class="flex w-full flex-col">
    <x-label for="nilai_hps_display" class="w-full sm:w-1/4">Nilai HPS</x-label>
    <x-input type="text" name="nilai_hps_display" id="nilai_hps_display_edit"
    class="{{ $errors->has('nilai_hps') ? 'border-red-500' : 'border-gray-200' }}"
    oninput="formatRupiah(this, 'nilai_hps')" required />
    <input type="hidden" name="nilai_hps" id="nilai_hps_edit" />
    @error('nilai_hps')
    <span class="text-sm text-red-500 mt-1">{{$message}}</span>
    @enderror
</div>

<div class="flex w-full flex-col pb-4 ">
    <x-label for="tahun_anggaran" class="w-full sm:w-1/4">Tahun Anggaran</x-label>
    <x-input type="number" name="tahun_anggaran" id="tahun_anggaran" required
    class="{{ $errors->has('tahun_anggaran') ? 'border-red-500' : 'border-gray-200' }}" />
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
    <option value="{{ $ppk->ppkom_id }}" selected>{{ $ppk->nama }}</option>
    @endforeach
</select>
</div>

<div x-data="daskumSingleManager({{ json_encode($dasarHukum) }})"
class="space-y-2"
id="daskum-edit-manager">

<x-label for="daskum_id">Dasar hukum</x-label>

<select name="daskum_id"
id="daskum_single_edit"
class="choices w-full {{ $errors->has('daskum_id') ? 'border-red-500' : 'border-gray-200' }}"
x-ref="daskumSelect"
required>
<template x-for="option in options" :key="option.daskum_id">
    <option :value="option.daskum_id" x-text="option.dasar_hukum"></option>
</template>
</select>

@error('daskum_id')
<span class="text-sm text-red-500">{{ $message }}</span>
@enderror
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
                            <button type="submit" class="btn rounded-md text-white bg-blue-600 btn-primary">
                                <i class="fas fa-save"></i>
                                Update
                            </button>
                            <label for="edit-modal"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                        </div>
                    </form>
                </div>
                <label class="modal-backdrop" for="edit-modal">Close</label>
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
            <label class="modal-backdrop" for="delete-modal">Close</label>
        </div>
    </div>

    <script>



        function EditHandler(paket) {
            const form = document.getElementById('edit-form');
            form.action = `/admin/paket-pekerjaan/${paket.paket_id}`;

            // INPUT BIASA
            document.getElementById('nomor_matrik_edit').value = paket.nomor_matrik;
            document.getElementById('kode_sirup').value = paket.kode_sirup;
            document.getElementById('nama_pekerjaan').value = paket.nama_pekerjaan;
            document.getElementById('waktu_paket').value = paket.waktu_paket;
            document.getElementById('nilai_pagu_paket_edit').value = paket.nilai_pagu_paket;
            document.getElementById('nilai_pagu_anggaran_edit').value = paket.nilai_pagu_anggaran;
            document.getElementById('nilai_hps_edit').value = paket.nilai_hps;
            document.getElementById('nilai_pagu_paket_display_edit').value = 'Rp ' + formatNumber(paket.nilai_pagu_paket);
            document.getElementById('nilai_pagu_anggaran_display_edit').value = 'Rp ' + formatNumber(paket.nilai_pagu_anggaran);
            document.getElementById('nilai_hps_display_edit').value = 'Rp ' + formatNumber(paket.nilai_hps);
            document.getElementById('tahun_anggaran').value = paket.tahun_anggaran;

            // INPUT YANG ADA ALPINE
            // sekolah
            const sekolahEditManagerInstance = Alpine.$data(document.getElementById('sekolah-edit-manager'));

            setTimeout(() => {
                if (paket['sekolah.sekolah_id']) {
                    sekolahEditManagerInstance.setSelectedValue(paket['sekolah.sekolah_id']);
                }
            }, 200);
            const sekolahManagerInstance = Alpine.$data(document.getElementById('sekolah-edit-manager'));

            // dasar hukum
            const daskumEditManagerInstance = Alpine.$data(document.getElementById('daskum-edit-manager'));
            setTimeout(() => {
                if(paket['dasarHukum.daskum_id']) {
                    daskumEditManagerInstance.setSelectedValue(paket['dasarHukum.daskum_id']);
                }
            }, 200)

            const daskumManagerInstance = Alpine.$data(document.getElementById('daskum-edit-manager'));

            // subKegiatan - menggunakan Choices.js multiple select
            const subKegiatanEditManagerInstance = Alpine.$data(document.getElementById('sub-kegiatan-edit-manager'));
            if (paket.sub_kegiatan && paket.sub_kegiatan.length > 0) {
                const selectedSubKegiatanIds = paket.sub_kegiatan.map(item => item.sub_kegiatan_id);

                // Tunggu sedikit untuk memastikan Choices.js sudah terinisialisasi
                setTimeout(() => {
                    subKegiatanEditManagerInstance.setSelectedValues(selectedSubKegiatanIds);
                }, 100);
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
                    option.setAttribute("selected", true);
                }
            });

            // metode pemilihan
            const metode_pemilihan = document.getElementById('metode_pemilihan');
            Array.from(metode_pemilihan.options).forEach(option => {
                if (option.value == paket.metode_pemilihan) {
                    option.setAttribute("selected", true);
                }
            });
        }

        function subKegiatanMultipleManager(options) {
            return {
                options: options,
                choicesInstance: null,
                selectedValues: [],

                init() {
                    this.$nextTick(() => {
                        this.initializeChoicesMultiple();
                    });
                },

                initializeChoicesMultiple() {
                    const selectElement = this.$refs.multipleSelect;

                    if (selectElement && !this.choicesInstance) {
                        this.choicesInstance = new Choices(selectElement, {
                            removeItemButton: true,
                            maxItemCount: -1, // unlimited
                            searchEnabled: true,
                            searchPlaceholderValue: 'Cari sub kegiatan...',
                            noResultsText: 'Tidak ada hasil ditemukan',
                            noChoicesText: 'Tidak ada pilihan tersedia',
                            itemSelectText: 'Klik untuk memilih',
                            maxItemText: (maxItemCount) => `Maksimal ${maxItemCount} item dapat dipilih`,
                            uniqueItemText: 'Item ini sudah dipilih',
                            shouldSort: false,
                            searchFields: ['label'],
                            fuseOptions: {
                                includeScore: true,
                                threshold: 0.3
                            },
                            classNames: {
                                containerOuter: 'choices',
                                containerInner: 'choices__inner',
                                input: 'choices__input',
                                inputCloned: 'choices__input--cloned',
                                list: 'choices__list',
                                listItems: 'choices__list--multiple',
                                listSingle: 'choices__list--single',
                                listDropdown: 'choices__list--dropdown',
                                item: 'choices__item',
                                itemSelectable: 'choices__item--selectable',
                                itemDisabled: 'choices__item--disabled',
                                itemChoice: 'choices__item--choice',
                                placeholder: 'choices__placeholder',
                                group: 'choices__group',
                                groupHeading: 'choices__heading',
                                button: 'choices__button',
                                activeState: 'is-active',
                                focusState: 'is-focused',
                                openState: 'is-open',
                                disabledState: 'is-disabled',
                                highlightedState: 'is-highlighted',
                                selectedState: 'is-selected',
                                flippedState: 'is-flipped',
                                loadingState: 'is-loading',
                                noResults: 'has-no-results',
                                noChoices: 'has-no-choices'
                            }
                        });

                        // Event listener untuk perubahan selection
                        selectElement.addEventListener('change', (event) => {
                            this.selectedValues = Array.from(event.target.selectedOptions).map(option => option.value);
                        });

                        selectElement.addEventListener('addItem', (event) => {
                            this.selectedValues.push(event.detail.value);
                        });

                        selectElement.addEventListener('removeItem', (event) => {
                            this.selectedValues = this.selectedValues.filter(val => val !== event.detail.value);
                        });
                    }
                },

                // Method untuk set selected values (digunakan saat edit)
                setSelectedValues(values) {
                    if (this.choicesInstance && Array.isArray(values)) {
                        // Clear existing selections
                        this.choicesInstance.removeActiveItems();

                        // Set new selections
                        values.forEach(value => {
                            this.choicesInstance.setChoiceByValue(value.toString());
                        });

                        this.selectedValues = values;
                    }
                },

                // Method untuk mendapatkan selected values
                getSelectedValues() {
                    return this.selectedValues;
                },

                // Method untuk clear selections
                clearSelections() {
                    if (this.choicesInstance) {
                        this.choicesInstance.removeActiveItems();
                        this.selectedValues = [];
                    }
                },

                // Destroy instance (untuk cleanup)
                destroy() {
                    if (this.choicesInstance) {
                        this.choicesInstance.destroy();
                        this.choicesInstance = null;
                    }
                }
            }
        }



        function setDeleteId(paket_id) {
            document.getElementById('deleteForm').action = `paket-pekerjaan/${paket_id}`;
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


        function daskumSingleManager(options) {
            return {
                options: options,
                choicesInstance: null,
                selectedValue: null,

                init() {
                    this.$nextTick(() => {
                        this.initializeChoicesSingle();
                    });
                },

                initializeChoicesSingle() {
                    const selectElement = this.$refs.daskumSelect;

                    if (selectElement && !this.choicesInstance) {
                        this.choicesInstance = new Choices(selectElement, {
                            searchEnabled: true,
                            itemSelectText: '',
                            shouldSort: false,
                            searchPlaceholderValue: 'Cari Daskum...',
                            noResultsText: 'Tidak ada hasil ditemukan',
                            noChoicesText: 'Tidak ada pilihan tersedia',
                        });

                        // Sync ke model Alpine
                        selectElement.addEventListener('change', (event) => {
                            this.selectedValue = event.target.value;
                        });
                    }
                },

                setSelectedValue(value) {
                    console.log('Setting selected value:', value); // Debug log

                    if (this.choicesInstance && value) {
                        try {
                            // Pastikan value adalah string
                            const stringValue = value.toString();

                            // Cek apakah value ada dalam options
                            const validOption = this.options.find(option =>
                            option.daskum_id.toString() === stringValue
                            );

                            if (validOption) {
                                this.choicesInstance.setChoiceByValue(stringValue);
                                this.selectedValue = stringValue;
                                console.log('Successfully set value:', stringValue); // Debug log
                            } else {
                                console.warn('Value not found in options:', stringValue);
                            }
                        } catch (error) {
                            console.error('Error setting selected value:', error);
                        }
                    } else {
                        console.warn('Choices instance not ready or value is empty');
                    }
                },

                getSelectedValue() {
                    return this.selectedValue;
                },

                clearSelection() {
                    if (this.choicesInstance) {
                        this.choicesInstance.removeActiveItems();
                        this.selectedValue = null;
                    }
                },

                destroy() {
                    if (this.choicesInstance) {
                        this.choicesInstance.destroy();
                        this.choicesInstance = null;
                    }
                }
            }
        }


        function sekolahSingleManager(options) {
            return {
                options: options,
                choicesInstance: null,
                selectedValue: null,

                init() {
                    this.$nextTick(() => {
                        this.initializeChoicesSingle();
                    });
                },

                initializeChoicesSingle() {
                    const selectElement = this.$refs.sekolahSelect;

                    if (selectElement && !this.choicesInstance) {
                        this.choicesInstance = new Choices(selectElement, {
                            searchEnabled: true,
                            itemSelectText: '',
                            shouldSort: false,
                            searchPlaceholderValue: 'Cari sekolah...',
                            noResultsText: 'Tidak ada hasil ditemukan',
                            noChoicesText: 'Tidak ada pilihan tersedia',
                        });

                        // Sync ke model Alpine
                        selectElement.addEventListener('change', (event) => {
                            this.selectedValue = event.target.value;
                        });
                    }
                },

                setSelectedValue(value) {
                    console.log('Setting selected value:', value); // Debug log

                    if (this.choicesInstance && value) {
                        try {
                            // Pastikan value adalah string
                            const stringValue = value.toString();

                            // Cek apakah value ada dalam options
                            const validOption = this.options.find(option =>
                            option.sekolah_id.toString() === stringValue
                            );

                            if (validOption) {
                                this.choicesInstance.setChoiceByValue(stringValue);
                                this.selectedValue = stringValue;
                                console.log('Successfully set value:', stringValue); // Debug log
                            } else {
                                console.warn('Value not found in options:', stringValue);
                            }
                        } catch (error) {
                            console.error('Error setting selected value:', error);
                        }
                    } else {
                        console.warn('Choices instance not ready or value is empty');
                    }
                },

                getSelectedValue() {
                    return this.selectedValue;
                },

                clearSelection() {
                    if (this.choicesInstance) {
                        this.choicesInstance.removeActiveItems();
                        this.selectedValue = null;
                    }
                },

                destroy() {
                    if (this.choicesInstance) {
                        this.choicesInstance.destroy();
                        this.choicesInstance = null;
                    }
                }
            }
        }

        function formatRupiah(input, hiddenInputId) {
            // Hapus semua karakter selain angka
            let value = input.value.replace(/[^\d]/g, '');

            // Simpan nilai original di hidden input
            document.getElementById(hiddenInputId).value = value;
            document.getElementById(hiddenInputId + '_edit').value = value;

            // Format dengan number_format
            if (value) {
                let formattedValue = formatNumber(value);
                input.value = 'Rp ' + formattedValue;
            } else {
                input.value = '';
            }
        }

        function formatNumber(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }


    </script>
</x-app-layout>
