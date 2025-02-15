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
        <div id="modal_matriks" class="modal">
            <div class="modal-box w-10/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Tambah Dasar Hukum</h3>
                    </div>
                    <label for="add-dasar-hukum"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.dasar-hukum.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <div class="flex w-full flex-col ">
                        <label for="dasar_hukum" class="w-full sm:w-1/4 font-bold">Dasar Hukum</label>
                        <textarea name="dasar_hukum" id="dasar_hukum" cols="10" rows="5" class="rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-200" required></textarea>
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded text-white btn-primary">Simpan</button>
                        <label for="add-dasar-hukum" class="btn btn-ghost">Batal</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Dasar Hukum -->
        <input type="checkbox" id="edit-daskum" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-11/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-pen-to-square text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Edit Dasar Hukum</h3>
                    </div>
                    <label for="edit-daskum"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="">
                    @csrf
                    @method('PUT')
                    <div class="flex w-full flex-col">
                            <label class="label font-semibold dark:text-gray-300">Dasar Hukum</label>
                            <textarea name="dasar_hukum" id="dasarHukum" cols="10" rows="5" class="rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-200" required></textarea>
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
                        <label for="delete-daskum" class="btn">Batal</label>
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
