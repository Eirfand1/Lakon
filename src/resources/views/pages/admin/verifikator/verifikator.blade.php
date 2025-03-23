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

        <!-- Table -->
        <livewire:verifikator-table />

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_verifikator" class="modal modal-top px-3">
            <div class="modal-box max-w-[55rem] mx-auto m-3 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div>
                    <label for="add-modal" class="btn btn-sm rounded-full shadow-none btn-circle mt-2 btn-ghost absolute right-4 top-2">
                        ✕
                    </label>
                </div>
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-lg">FORM TAMBAH DATA VERIFIKATOR</h3>
                </div>
                <form action="{{ route('admin.verifikator.store') }}" method="POST" class="mt-4 space-y-2">
                    @csrf
                    <div class="flex gap-2 sm:flex-nowrap flex-wrap">
                        <div class="sm:w-2/5 w-full">
                            <x-label >NIP</x-label>
                            <x-input type="number" name="nip" required
                                class="{{ $errors->has('nip') ? 'border-red-500' : 'border-gray-200' }}"
                                value="{{old('nip')}}"
                                placeholder="nip" />
                            @error('nip')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="sm:w-3/5 w-full">
                            <x-label >Nama</x-label>
                            <x-input type="text" name="nama_verifikator"
                                placeholder="nama verifikator"
                                value="{{old('nama_verifikator')}}"
                                class="{{ $errors->has('nama_verifikator') ? 'border-red-500' : 'border-gray-200' }}"
                                required
                            />

                            @error('nama_verifikator')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>


                    <div class="">
                        <x-label >Username</x-label>
                        <x-input type="text" name="name"
                            placeholder="username"
                            value="{{old('name')}}"
                            class="{{ $errors->has('name') ? 'border-red-500' : 'border-gray-200' }}"
                            required
                            />

                        @error('name')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="">
                        <x-label >Email</x-label>
                        <x-input type="text" name="email"
                            placeholder="email"
                            class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }}"
                            value="{{old('email')}}"
                            required
                            />
                        @error('email')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="form-control">
                        <x-label >Password</x-label>
                        <div class="relative">
                            <x-input type="password" name="password" id="password"
                                placeholder="password"
                                class="{{ $errors->has('password') ? 'border-red-500' : 'border-gray-200' }}"
                                required
                            />
                            <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2"
                                onclick="togglePassword('password')">
                                <i class="fa-solid fa-eye" id="password-icon"></i>
                            </button>
                        </div>

                        @error('password')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary text-white bg-blue-600 rounded-md">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                        <label for="add-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Tutup</label>
                    </div>
                </form>
            </div>

            <label class="modal-backdrop" for="add-modal">Close</label>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box max-w-[55rem] mx-auto m-3 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <h3 class="font-bold text-lg mb-3">EDIT DATA VERIFIKATOR</h3>
                <div>
                    <label for="edit-modal"
                        class="btn btn-sm rounded-full shadow-none btn-circle font-bold mt-2 btn-ghost absolute right-4 top-2">
                        ✕
                    </label>
                </div>
                <form id="editForm" method="POST" class="space-y-2">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_user_id" name="user_id">
                    <div class="flex sm:flex-nowrap flex-wrap gap-2">
                        <div class="sm:w-2/5 w-full">
                            <x-label >NIP</x-label>
                            <x-input type="number" id="edit_nip" name="edit_nip"
                                placeholder="nip"
                                class="{{ $errors->has('nip') ? 'border-red-500' : 'border-gray-200' }}"
                                required
                            />
                        @error('edit_nip')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                        </div>
                        <div class="sm:w-3/5 w-full">
                            <x-label >Nama</x-label>
                            <x-input type="text" id="edit_nama" name="edit_nama_verifikator"
                            placeholder="nama verifikator"
                            class="{{ $errors->has('edit_nama_verifikator') ? 'border-red-500' : 'border-gray-200' }}"
                            required
                            />
                        @error('edit_nama_verifikator')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                        </div>
                    </div>


                    <div class="form-control">
                        <x-label >Username</x-label>
                        <x-input type="text" id="edit_name" name="edit_name"
                            class="{{ $errors->has('edit_name') ? 'border-red-500' : 'border-gray-200' }}"
                            required
                            placeholder="username" />
                        @error('edit_name')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-control">
                        <x-label >Email</x-label>
                        <x-input type="text" id="edit_email" name="edit_email"  required
                            placeholder="email" />
                        @error('edit_email')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>


                    <div class="form-control">
                        <x-label>Password</x-label>
                        <div class="relative">
                            <x-input type="password" id="edit_password" name="edit_password" id="edit_password"
                                placeholder="password"
                                class="{{ $errors->has('edit_password') ? 'border-red-500' : 'border-gray-200' }}"
                                />
                            <button type="button" class="absolute right-4 top-1/2 transform -translate-y-1/2"
                                onclick="togglePassword('edit_password')">
                                <i class="fa-solid fa-eye" id="edit_password-icon"></i>
                            </button>
                        </div>
                        @error('edit_password')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary text-white bg-blue-600">
                            <i class="fas fa-save"></i>
                            Update
                        </button>
                        <label for="edit-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Tutup</label>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="edit-modal">Close</label>
        </div>

        <!-- Delete Modal -->
        <input type="checkbox" id="delete-modal" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div
                class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white bg-white text-gray-800  dark:bg-gray-800">
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
                        <label for="delete-modal" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="delete-modal">Close</label>
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
