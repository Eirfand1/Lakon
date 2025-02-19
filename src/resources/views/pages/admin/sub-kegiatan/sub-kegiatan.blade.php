<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">SUB KEGIATAN</h1>
            <!-- Add Button -->
            <label for="add-sub-kegiatan" class="btn rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                <i class="fa-solid fa-square-plus"></i>
                <span>Tambah Data</span>
            </label>
        </div>
        <!-- Success Message -->

        @include('pages.alert')

        <livewire:sub-kegiatan-table />

        <!-- Tambah Sub Kegiatan -->
        <input type="checkbox" id="add-sub-kegiatan" class="modal-toggle" />
        <div id="modal_matriks" class="modal">
            <div class="modal-box w-10/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Tambah Paket Kegiatan</h3>
                    </div>
                    <label for="add-sub-kegiatan"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                @livewire('sub-kegiatan-add')

            </div>
        </div>

        <!-- Edit Sub Kegiatan -->
        <input type="checkbox" id="edit-sub-kegiatan" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-11/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-pen-to-square text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Edit Sub Kegiatan</h3>
                    </div>
                    <label for="edit-sub-kegiatan"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="space-y-4 pt-4">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-1 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Nomor Rekening</label>
                            <input type="number" id="noRekening" name="no_rekening"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Nama Sub Kegiatan</label>
                            <input type="text" id="namaSubKegiatan" name="nama_sub_kegiatan"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Gabungan</label>
                            <input type="text" id="edit_gabungan" name="gabungan"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Pendidikan</label>
                            <input type="text" id="edit_pendidikan" name="pendidikan"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <label for="edit-sub-kegiatan" class="btn btn-ghost">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <input type="checkbox" id="delete-sub-kegiatan" class="modal-toggle" />
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
                        <label for="delete-sub-kegiatan" class="btn">Batal</label>
                    </div>
                </form>
            </div>
        </div>
    <div>

    <!-- Script for PPkom Table -->
    <script>
        function editDaskum(sub_kegiatan_id, no_rekening, nama_sub_kegiatan, gabungan, pendidikan) {
            document.getElementById('editForm').action = `sub-kegiatan/${sub_kegiatan_id}`;
            document.getElementById('noRekening').value = no_rekening;
            document.getElementById('namaSubKegiatan').value = nama_sub_kegiatan;
            document.getElementById('edit_gabungan').value = gabungan;
            document.getElementById('edit_pendidikan').value = pendidikan;
        }
        function setDeleteId(sub_kegiatan_id) {
            document.getElementById('deleteForm').action = `sub-kegiatan/${sub_kegiatan_id}`;
        }
    </script>
</x-app-layout>
