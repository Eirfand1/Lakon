<x-app-layout>
    <div class="p-5">
        <div class="sm:flex sm:justify-between sm:items-center p-2 pb-5">
            <div class="">
                <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">VERIFIKATOR</h1>
            </div>
            <!-- Add Button -->
            <label for="add-modal" class="btn btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                <i class="fa-solid fa-square-plus"></i>
                <span>Tambah Data</span>
            </label>
        </div>

        <!-- Success Message -->

        @if (session('success'))

        <script>
        Toastify({
            text: "{{ session('success') }}",
            duration: 2000,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            style: {
                background: "linear-gradient(to right, #00b09b, #96c93d)", // Hijau untuk sukses
            },
        }).showToast();
        </script>

        @endif
        <!-- Error message -->
        @if (session('error'))
            <script>
                Toastify({
                    text: "{{ session('error') }}",
                    duration: 2000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    },
                }).showToast();
            </script>
        @endif

        <!-- Table -->
        <livewire:verifikator-table/>

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_verifikator" class="modal">
            <div class="modal-box w-10/12 max-w-2xl rounded  dark:bg-gray-800 bg-gray-100">
                <div>
                    <label for="add-modal" class="btn btn-sm btn-circle font-bold mt-2 btn-ghost absolute right-2 top-2">X</label>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-square-plus text-xl"></i>
                    <h3 class="font-bold text-xl">FORM TAMBAH DATA VERIFIKATOR</h3>
                </div>
                <form action="{{ route('admin.verifikator.store') }}" method="POST" class="border-t border-violet-800/40 mt-4">
                    @csrf
                    <div class="form-control">
                        <label class="label">NIP</label>
                        <input type="number" name="nip" class="input bg-gray-200 dark:bg-gray-700 " required />
                    </div>
                    <div class="form-control">
                        <label class="label">Nama</label>
                        <input type="text" name="nama_verifikator" class="input bg-gray-200 dark:bg-gray-700" required />
                    </div>
                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <label for="add-modal" class="btn">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-10/12 max-w-2xl rounded  dark:bg-gray-800 bg-gray-100">
                <h3 class="font-bold text-lg">EDIT DATA VERIVIKATOR</h3>
                <div>
                    <label for="edit-modal" class="btn btn-sm btn-circle font-bold mt-2 btn-ghost absolute right-2 top-2">X</label>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-control">
                        <label class="label">NIP</label>
                        <input type="number" id="edit_nip" name="nip" class="bg-gray-200 dark:bg-gray-700 input" required />
                    </div>
                    <div class="form-control">
                        <label class="label">Nama</label>
                        <input type="text" id="edit_nama" name="nama_verifikator" class="bg-gray-200 dark:bg-gray-700 input" required />
                    </div>
                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <label for="edit-modal" class="btn">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <input type="checkbox" id="delete-modal" class="modal-toggle" />
        <div class="modal modal-top">
            <div class="modal-box w-auto mt-5 mx-auto rounded-lg dark:text-white text-gray-800 bg-gray-100 dark:bg-gray-800">
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

    <!-- Script for Verifikator Table -->
        <script>
            function editVerifikator(verifikator_id, nip, nama) {
                document.getElementById('editForm').action = `verifikator/${verifikator_id}`;
                document.getElementById('edit_nip').value = nip;
                document.getElementById('edit_nama').value = nama;
            }

            function setDeleteId(verifikator_id) {
                document.getElementById('deleteForm').action = `verifikator/${verifikator_id}`;
            }
        </script>
</x-app-layout>
