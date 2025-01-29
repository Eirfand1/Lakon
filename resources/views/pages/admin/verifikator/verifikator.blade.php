<x-app-layout>
    <div class="p-5">
        <div class="sm:flex sm:justify-between sm:items-center p-2 pb-5">
            <div class="">
                <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">VERIFIKATOR</h1>
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
                        padding: "12px 20px",
                    },
                }).showToast();
            </script>
        @endif

        <!-- Table -->
        <livewire:verifikator-table />

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_verifikator" class="modal modal-top">
            <div class="modal-box w-10/12 mx-auto mt-4 max-w-2xl rounded  dark:bg-gray-800 bg-gray-100">
                <div>
                    <label for="add-modal" class="btn btn-sm btn-circle mt-2 btn-ghost absolute right-2 top-2">X</label>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-square-plus text-xl"></i>
                    <h3 class="font-bold text-xl">FORM TAMBAH DATA VERIFIKATOR</h3>
                </div>
                <form action="{{ route('admin.verifikator.store') }}" method="POST" class="mt-4">
                    @csrf
                    <div class="form-control">
                        <label class="label">NIP</label>
                        <input type="number" name="nip" class="input bg-white shadow dark:bg-gray-700" required
                            placeholder="nip" />
                    </div>
                    <div class="form-control">
                        <label class="label">Nama</label>
                        <input type="text" name="nama_verifikator" class="input bg-white shadow dark:bg-gray-700"
                            required placeholder="nama verifikator" />
                    </div>

                    <div class="form-control">
                        <label class="label">Username</label>
                        <input type="text" name="name" class="input bg-white shadow dark:bg-gray-700 " required
                            placeholder="username" />
                    </div>
                    <div class="form-control">
                        <label class="label">Email</label>
                        <input type="text" name="email" class="input bg-white shadow dark:bg-gray-700" required
                            placeholder="email" />
                    </div>

                    <div class="form-control">
                        <label class="label">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="input bg-white shadow dark:bg-gray-700 w-full" required placeholder="password" />
                            <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2"
                                onclick="togglePassword('password')">
                                <i class="fa-solid fa-eye" id="password-icon"></i>
                            </button>
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn text-white btn-primary rounded">Simpan</button>
                        <label for="add-modal" class="btn rounded">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal modal-top">
            <div class="modal-box mx-auto mt-4 w-10/12 max-w-2xl rounded  dark:bg-gray-800 bg-gray-100">
                <h3 class="font-bold text-lg">EDIT DATA VERIVIKATOR</h3>
                <div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle font-bold mt-2 btn-ghost absolute right-2 top-2">X</label>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_user_id" name="user_id">
                    <div class="form-control">
                        <label class="label">NIP</label>
                        <input type="number" id="edit_nip" name="nip" class="bg-white shadow dark:bg-gray-700 input"
                            required placeholder="nip" />
                    </div>
                    <div class="form-control">
                        <label class="label">Nama</label>
                        <input type="text" id="edit_nama" name="nama_verifikator"
                            class="bg-white shadow dark:bg-gray-700 input" required placeholder="nama verifikator" />
                    </div>

                    <div class="form-control">
                        <label class="label">Username</label>
                        <input type="text" id="edit_name" name="edit_name" class="input  bg-white shadow dark:bg-gray-700 " required
                            placeholder="username" />
                    </div>
                    <div class="form-control">
                        <label class="label">Email</label>
                        <input type="text" id="edit_email" name="edit_email" class="input bg-white shadow dark:bg-gray-700" required
                            placeholder="email" />
                    </div>


                    <div class="form-control">
                        <label class="label">Password</label>
                        <div class="relative">
                            <input type="password" id="edit_password" name="edit_password" id="edit_password"
                                class="input bg-white shadow dark:bg-gray-700 w-full" placeholder="password" />
                            <button type="button" class="absolute right-2 top-1/2 transform -translate-y-1/2"
                                onclick="togglePassword('edit_password')">
                                <i class="fa-solid fa-eye mr-4" id="edit_password-icon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="modal-action">
                        <button type="submit" class="btn text-white btn-primary">Update</button>
                        <label for="edit-modal" class="btn text-white">Tutup</label>
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

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(inputId + '-icon');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function editVerifikator(verifikator_id, nip, nama, name, email, user_id) {
            document.getElementById('editForm').action = `verifikator/${verifikator_id}`;
            document.getElementById('edit_nip').value = nip;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_user_id').value = user_id;
            document.getElementById('edit_password').value = '';
        }

        function setDeleteId(verifikator_id) {
            document.getElementById('deleteForm').action = `verifikator/${verifikator_id}`;
        }
    </script>
</x-app-layout>