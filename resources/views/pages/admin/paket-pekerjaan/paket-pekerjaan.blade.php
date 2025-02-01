<x-app-layout>
    <div class="p-5">
        <div class="mb-4 sm:mb-0 flex justify-between">
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
                        textTransform: "uppercase",
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
            <div class="modal-box w-10/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
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
                    <h1 class="border-b font-bold border-gray-200 py-2 dark:border-gray-700 ">Program kerja</h1>

                    <div x-data="subKegiatanManager({{ json_encode($subKegiatan) }})" class="space-y-2">
                        <label for="sub_kegiatan[]">Sub Kegiatan</label>
                        <template x-for="(input, index) in inputs" :key="index">
                            <div class="relative w-full">
                                <div class="flex items-center gap-2">
                                    <input type="text" x-model="input.search" name="sub_kegiatan[]"
                                        @input.debounce.100ms="filterOptions(index)" @focus="showDropdown(index)"
                                        @click.away="input.showDropdown = false" placeholder="Pilih Sub Kegiatan"
                                        class="w-full rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">

                                    <button type="button" @click="removeInput(index)"
                                        class="text-white bg-error p-2 rounded-lg px-3 hover:text-red-700"
                                        x-show="inputs.length > 1">
                                        <i class="fa-solid fa-xmark"></i>

                                    </button>
                                </div>

                                <div x-show="input.showDropdown && input.filteredOptions.length" x-transition
                                    class="absolute z-10 w-content mt-2  bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                    <template x-for="option in input.filteredOptions" :key="option . sub_kegiatan_id">
                                        <div @click="selectOption(index, option)"
                                            class="px-4 py-2 hover:bg-gray-100 cursor-pointer"
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
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
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
                                class="w-1/2 sm:w-1/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <input type="text" name="nama_pekerjaan" id="" placeholder="Nama Paket"
                                class="w-full sm:w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="waktu_paket" class="w-full sm:w-1/4">Waktu Paket*</label>
                        <input type="date" name="waktu_paket" id=""
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col  ">
                        <label for="jenis_pengadaan" class="w-full sm:w-1/4">Pengadaan*</label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <select name="jenis_pengadaan" id="metode_pemilihan"
                                class="sm:w-1/4 w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                <option value="tender">Tender</option>
                                <option value="non-tender">Non-Tender</option>
                                <option value="e_catalog">E-Catalog</option>
                            </select>

                            <select name="metode_pemilihan" id="metode_pemilihan"
                                class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                <option value="" disabled selected>Pilih Jenis Pengadaan</option>
                                <option value="Jasa Konsultasi Pengawasan">Jasa Konsultasi Pengawasan</option>
                                <option value="Jasa Konsultasi Perencanaan">Jasa Konsultasi Pelaksanaan</option>
                                <option value="Jasa Konstruksi">Jasa Konstruksi</option>
                                <option value="Pengadaan Barang">Pengadaan Barang</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_pagu_paket" class="w-full sm:w-1/4">Nilai Pagu Paket*</label>
                        <input type="number" name="nilai_pagu_paket" id=""
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_pagu_anggaran" class="w-full sm:w-1/4">Nilai Pagu Anggaran*</label>
                        <input type="number" name="nilai_pagu_anggaran" id=""
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nilai_hps" class="w-full sm:w-1/4">Nilai HPS*</label>
                        <input type="number" name="nilai_hps" id=""
                            class=" rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Pejabat Pembuat Komitmen
                    </h1>

                    <div class="flex w-full flex-col ">
                        <label for="daskum_id" class="w-full sm:w-1/4">Ppkom*</label>
                        <select name="daskum_id" id="daskum_id"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="" disabled selected>Pilih Pegawai</option>
                            @foreach($ppkom as $ppk)
                                <option value="{{ $ppk->ppkom_id }}">{{ $ppk->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="ppkom_id" class="w-full sm:w-1/4">Dasar Hukum*</label>
                        <select name="ppkom_id" id="ppkom_id"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="" disabled selected>Pilih Dasar Hukum</option>
                            @foreach($dasarHukum as $daskum)
                                <option value="{{ $daskum->daskum_id }}">{{ $daskum->dasar_hukum }}</option>
                            @endforeach
                        </select>
                    </div>

                    <h1 class="border-y border-gray-200 font-bold py-3  dark:border-gray-700 ">Informasi Satuan Kerja
                    </h1>

                    <div class="flex w-full flex-col ">
                        <label for="satker_id" class="w-full sm:w-1/4">Satuan Kerja*</label>
                        <select name="satker_id" id="satker_id"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="" disabled selected>Pilih Satuan Kerja</option>
                            @foreach($satuanKerja as $satker)
                                <option value="{{ $satker->satker_id }}">{{ $satker->nama_pimpinan }}</option>
                            @endforeach
                        </select>
                    </div>



                    <div class="flex w-full flex-col ">
                        <label for="tahun_anggaran" class="w-full sm:w-1/4">Tahun Anggaran*</label>
                        <input type="number" name="tahun_anggaran" id="tahun_anggaran"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded text-white btn-primary">Simpan</button>
                        <label for="add-modal" class="btn btn-ghost">Batal</label>
                    </div>
                </form>
            </div>



        </div>

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
    </script>
</x-app-layout>