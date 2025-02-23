<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">DASAR HUKUM</h1>
            <!-- Add Button -->
            <label for="add-dasar-hukum" class="btn rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
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

        <livewire:dasar-hukum-table />

        <!-- Tambah Dasar Hukum -->
        <input type="checkbox" id="add-dasar-hukum" class="modal-toggle" />
        <div id="modal_matriks" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Tambah Dasar Hukum</h3>
                    </div>
                    <label for="add-dasar-hukum"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 rounded-full shadow-none dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.dasar-hukum.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <div class="flex w-full flex-col ">
                        <label for="dasar_hukum" class="w-full sm:w-1/4 font-bold">Dasar Hukum</label>
                        <textarea name="dasar_hukum" id="dasar_hukum" cols="10" rows="5" class="rounded bg-white dark:bg-gray-900/20 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-200" required></textarea>
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded text-white btn-primary">Simpan</button>
                        <label for="add-dasar-hukum" class="btn text-white rounded">Batal</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Dasar Hukum -->
        <input type="checkbox" id="edit-daskum" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-pen-to-square text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Edit Dasar Hukum</h3>
                    </div>
                    <label for="edit-daskum"
                        class="btn btn-sm rounded-full shadow-none btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="">
                    @csrf
                    @method('PUT')
                    <div class="flex w-full flex-col">
                            <label class="label font-semibold dark:text-gray-300">Dasar Hukum</label>
                            <textarea name="dasar_hukum" id="dasarHukum" cols="10" rows="5" class="rounded bg-white dark:bg-gray-900/20 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-200" required></textarea>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <label for="edit-daskum" class="btn btn-ghost">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <input type="checkbox" id="delete-daskum" class="modal-toggle" />
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
                        <label for="delete-daskum" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>
    <div>

    <!-- Script for Dasar Hukum -->
    <script>
        function editDaskum(daskum_id, dasar_hukum) {
            document.getElementById('editForm').action = `dasar-hukum/${daskum_id}`;
            document.getElementById('dasarHukum').value = dasar_hukum;
        }
        function setDeleteId(daskum_id) {
            document.getElementById('deleteForm').action = `dasar-hukum/${daskum_id}`;
        }
    </script>
</x-app-layout>
