<x-app-layout>
    <div class="p-5">
        <div class="sm:flex sm:justify-between sm:items-center p-2 pb-5">
            <div class="">
                <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">PPKOM</h1>
            </div>
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

        <!-- Table -->

        <livewire:ppkom-table />

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_ppkom" class="modal">
            <div class="modal-box w-10/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Tambah Data PPKOM</h3>
                    </div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.ppkom.store') }}" method="POST" class="space-y-4 pt-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">NIP</label>
                            <input type="number" name="nip" oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Nama</label>
                            <input type="text" name="nama"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Pangkat</label>
                            <input type="text" name="pangkat"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700" />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Jabatan</label>
                            <input type="text" name="jabatan"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700" />
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold dark:text-gray-300">Alamat</label>
                        <textarea name="alamat"
                            class="textarea textarea-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"></textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">No. Telp</label>
                            <input type="number" name="no_telp"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700" />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Email</label>
                            <input type="email" name="email"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700" />
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <label for="add-modal" class="btn btn-ghost">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-11/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-pen-to-square text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Edit Data PPKOM</h3>
                    </div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="space-y-4 pt-4">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">NIP</label>
                            <input type="number" id="edit_nip" name="nip"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Nama</label>
                            <input type="text" id="edit_nama" name="nama"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"
                                required />
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Pangkat</label>
                            <input type="text" id="edit_pangkat" name="pangkat"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700" />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Jabatan</label>
                            <input type="text" id="edit_jabatan" name="jabatan"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700" />
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label font-semibold dark:text-gray-300">Alamat</label>
                        <textarea id="edit_alamat" name="alamat"
                            class="textarea textarea-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700"></textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">No. Telp</label>
                            <input type="text" id="edit_no_telp" name="no_telp"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700" />
                        </div>
                        <div class="form-control">
                            <label class="label font-semibold dark:text-gray-300">Email</label>
                            <input type="email" id="edit_email" name="email"
                                class="input input-bordered w-full bg-gray-100 dark:bg-gray-700 dark:border-gray-700" />
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <label for="edit-modal" class="btn btn-ghost">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
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

    <!-- Script for PPkom Table -->
    <script>
        function editPpkom(ppkom_id, nip, nama, pangkat, jabatan, alamat, no_telp, email) {
            document.getElementById('editForm').action = `ppkom/${ppkom_id}`;
            document.getElementById('edit_nip').value = nip;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_pangkat').value = pangkat;
            document.getElementById('edit_jabatan').value = jabatan;
            document.getElementById('edit_alamat').textContent = alamat;
            document.getElementById('edit_no_telp').value = no_telp;
            document.getElementById('edit_email').value = email;
        }

        function setDeleteId(ppkom_id) {
            document.getElementById('deleteForm').action = `ppkom/${ppkom_id}`;
        }
    </script>

</x-app-layout>