<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">SEKOLAH</h1>
            <div class="flex gap-2">
                <div>
                    <a href="{{ url('admin/sekolah/import-sekolah') }}" wire:navigate class="btn btn-success btn-sm rounded text-white">
                        <i class="fa-solid fa-file-import"></i>
                        <span>
                            Import Excel
                        </span>
                    </a>
                </div>
                <label for="add-sekolah" class="btn rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                    <i class="fa-solid fa-square-plus"></i>
                    <span>Tambah Data</span>
                </label>
            </div>
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
        <livewire:sekolah-table />

        <!-- Tambah Sekolah -->
        <input type="checkbox" id="add-sekolah" class="modal-toggle" />
        <div id="modal_matriks" class="modal">
            <div class="modal-box w-10/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Tambah Sekolah</h3>
                    </div>
                    <label for="add-sekolah"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.sekolah.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <div class="flex w-full flex-col ">
                        <label for="npsn" class="w-full sm:w-1/4">NPSN*</label>
                        <input type="number" name="npsn" id="npsn"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="nama_sekolah" class="w-full sm:w-1/4">Nama Sekolah*</label>
                        <input type="text" name="nama_sekolah" id="nama_sekolah"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col pb-4 ">
                        <label for="jenjang" class="w-full sm:w-1/4">Jenjang*</label>
                        <select name="jenjang" id=""
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="SMK">SMK</option>
                        </select>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="status" class="w-full sm:w-1/4">Status*</label>
                        <input type="text" name="status" id="status"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="alamat" class="w-full sm:w-1/4">Alamat*</label>
                        <input type="text" name="alamat" id="alamat"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="desa" class="w-full sm:w-1/4">Desa*</label>
                        <input type="text" name="desa" id="desa"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="kecamatan" class="w-full sm:w-1/4">Kecamatan*</label>
                        <input type="text" name="kecamatan" id="kecamatan"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="koordinat" class="w-full sm:w-1/4">Koordinat*</label>
                        <input type="text" name="koordinat" id="koordinat" placeholder="Contoh: -6.175392, 106.827153"
                            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded text-white btn-primary">Simpan</button>
                        <label for="add-sekolah" class="btn btn-ghost">Batal</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Sekolah -->
        @if ($sekolah ?? null != null)
        <div class="modal">
            <div class="modal-box w-11/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-pen-to-square text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Edit Sekolah</h3>
                    </div>
                    <label for="edit-sekolah"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="space-y-4 pt-4">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-1 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">NPSN*</label>
                            <input type="text" id="edit_npsn" name="npsn" value="{{ $sekolah->npsn ?? '' }}"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Nama Sekolah*</label>
                            <input type="text" id="namaSekolah" name="nama_sekolah" value="{{ $sekolah->nama_sekolah ?? '' }}"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>

                        <div class="flex w-full flex-col pb-4">
                            <label for="jenjang" class="w-full sm:w-1/4">Jenjang*</label>
                            <select  name="jenjang"
                                class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                                <option value="SD" {{ $sekolah->jenjang ?? '' == 'SD' ? 'selected' : '' }}>SD</option>
                                <option value="SMP" {{  $sekolah->jenjang ?? '' == 'SMP' ? 'selected' : ''}}>SMP</option>
                                <option value="SMA" {{ $sekolah->jenjang ?? '' == 'SMA' ? 'selected' : '' }}>SMA</option>
                                <option value="SMK" {{ $sekolah->jenjang ?? '' == 'SMK' ? 'selected' : '' }}>SMK</option>
                            </select>
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Status*</label>
                            <input type="text" id="edit_status" name="status" value="{{ $sekolah->status ?? '' }}"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Alamat*</label>
                            <input type="text" id="edit_alamat" name="alamat" value="{{ $sekolah->alamat ?? '' }}"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Desa*</label>
                            <input type="text" id="edit_desa" name="desa" value="{{ $sekolah->desa ?? '' }}"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Kecamatan*</label>
                            <input type="text" id="edit_kecamatan" name="kecamatan" value="{{ $sekolah->kecamatan ?? '' }}"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>

                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Koordinat*</label>
                            <input type="text" id="edit_koordinat" name="koordinat" value="{{ $sekolah->koordinat ?? '' }}"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <label for="edit-sekolah" class="btn btn-ghost">Tutup</label>
                    </div>
                </form>
            </div>
        @endif


        <!-- Delete Sekolah -->
        <input type="checkbox" id="delete-sekolah" class="modal-toggle" />
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
                        <label for="delete-sekolah" class="btn">Batal</label>
                    </div>
                </form>
            </div>
        </div>
    <div>

    <!-- Script for Sekolah -->
    <script>
        function setDeleteId(sekolah_id) {
            document.getElementById('deleteForm').action = `sekolah/${sekolah_id}`;
        }
    </script>
</x-app-layout>
