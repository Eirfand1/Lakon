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

        <livewire:sub-kegiatan-table />

        <!-- Tambah Sub Kegiatan -->
        <input type="checkbox" id="add-sub-kegiatan" class="modal-toggle" />
        <div id="modal_matriks" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">TAMBAH SUB KEGIATAN</h3>
                    </div>
                    <label for="add-sub-kegiatan"
                        class="btn btn-sm rounded-full shadow-none btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.sub-kegiatan.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <div class="flex w-full flex-col ">
                        <x-label for="no_rekening" class="w-full sm:w-1/4">Nomor Rekening</x-label>
                        <x-input type="number" name="no_rekening" id="no_rekening"
                        />
                    </div>
                    <div class="flex w-full flex-col ">
                        <x-label for="nama_sub_kegiatan" class="w-full sm:w-1/4">Nama Sub Kegiatan</x-label>
                        <x-input type="text" name="nama_sub_kegiatan" id="nama_sub_kegiatan"
                        />
                    </div>
                    <div class="flex w-full flex-col ">
                        <x-label for="gabungan" class="w-full sm:w-1/4">Gabungan</x-label>
                        <x-input type="text" name="gabungan" id="gabungan"
                        />
                    </div>
                    <div class="flex w-full flex-col ">
                        <x-label for="pendidikan" class="w-full sm:w-1/4">Pendidikan</x-label>
                        <x-input type="text" name="pendidikan" id="pendidikan"
                        />
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded-md btn-primary text-white bg-blue-600">Simpan</button>
                        <label for="add-sub-kegiatan" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Sub Kegiatan -->
        <input type="checkbox" id="edit-sub-kegiatan" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">EDIT SUB KEGIATAN</h3>
                    </div>
                    <label for="edit-sub-kegiatan"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="space-y-2">
                    @csrf
                    @method('PUT')
                        <div class="w-full flex flex-col">
                            <x-label >Nomor Rekening</x-label>
                            <x-input type="number" id="noRekening" name="no_rekening"
                                required />
                        </div>
                        <div class="">
                            <x-label >Nama Sub Kegiatan</x-label>
                            <x-input type="text" id="namaSubKegiatan" name="nama_sub_kegiatan"
                                required />
                        </div>
                        <div class="">
                            <x-label >Gabungan</x-label>
                            <x-input type="text" id="edit_gabungan" name="gabungan"
                                required />
                        </div>
                        <div class="">
                            <x-label>Pendidikan</x-label>
                            <x-input type="text" id="edit_pendidikan" name="pendidikan"
                                required />
                        </div>

                    <div class="modal-action">
                        <button type="submit" class="btn bg-blue-600 btn-primary text-white rounded-md">Update</button>
                        <label for="edit-sub-kegiatan" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <input type="checkbox" id="delete-sub-kegiatan" class="modal-toggle" />
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
                        <label for="delete-sub-kegiatan" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
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
