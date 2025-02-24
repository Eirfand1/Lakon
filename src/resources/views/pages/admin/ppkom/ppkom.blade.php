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

        @if ($errors->any())
            <script>
                Toastify({
                    escapeMarkup: false,
                    text: '<i class="fas fa-exclamation-circle mr-3" style="font-size:20px;"></i>' + "{{ $errors->first() }}",
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
        <div id="modal_ppkom" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">TAMBAH DATA PPKOM</h3>
                    </div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle btn-ghost rounded-full shadow-none hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.ppkom.store') }}" method="POST" class="space-y-2">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>NIP</x-label>
                            <x-input type="number" name="nip" value="{{old('value')}}"
                                class="{{ $errors->has('nip') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="NIP"
                                required />
                            @error('nip')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Nama</x-label>
                            <x-input type="text" name="nama" value="{{old('nama')}}"
                                class="{{ $errors->has('nama') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="Nama"
                                required />

                            @error('nama')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>Pangkat</x-label>
                            <x-input type="text" name="pangkat" value="{{old('pangkat')}}"
                            class="{{ $errors->has('pangkat') ? 'border-red-500' : 'border-gray-200' }}"
                            placeholder="Pangkat"
                            required
                            />
                            @error('pangkat')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Jabatan</x-label>
                            <x-input type="text" name="jabatan" value="{{old('jabatan')}}"
                            placeholder="Jabatan"
                            class="{{ $errors->has('jabatan') ? 'border-red-500' : 'border-gray-200' }}"
                            />

                            @error('jabatan')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <x-label>Alamat</x-label>
                        <textarea name="alamat"
                            class="rounded bg-white dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-200
                            {{ $errors->has('alamat') ? 'border-red-500' : 'border-gray-200' }}"
                            placeholder="Jabatan"
                            >{{old('alamat')}}</textarea>
                            @error('alamat')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>No. Telp</x-label>
                            <x-input type="number" name="no_telp"
                            class="{{ $errors->has('alamat') ? 'border-red-500' : 'border-gray-200' }}"
                            value="{{old('no_telp')}}"
                            placeholder="Nomor Telepon"
                            />
                            @error('no_telp')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Email</x-label>
                            <x-input type="email" name="email"
                            class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }}"
                            value="{{old('email')}}"
                            placeholder="Email"
                            />
                            @error('email')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn bg-blue-600 btn-primary rounded-md text-white">Simpan</button>
                        <label for="add-modal" class="btn rounded-md text-white">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">EDIT DATA PPKOM</h3>
                    </div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle rounded-full shadow-none btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="space-y-2">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>NIP</x-label>
                            <x-input type="number" id="edit_nip" name="nip"

                                class="{{ $errors->has('nip') ? 'border-red-500' : 'border-gray-200' }}"
                                required />

                            @error('nip')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Nama</x-label>
                            <x-input type="text" id="edit_nama" name="nama"

                                class="{{ $errors->has('nama') ? 'border-red-500' : 'border-gray-200' }}"
                                required />
                            @error('nama')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label >Pangkat</x-label>
                            <x-input type="text" id="edit_pangkat" name="pangkat"
                             class="{{ $errors->has('pangkat') ? 'border-red-500' : 'border-gray-200' }}"
                            />
                            @error('pangkat')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Jabatan</x-label>
                            <x-input type="text" id="edit_jabatan" name="jabatan"
                             class="{{ $errors->has('jabatan') ? 'border-red-500' : 'border-gray-200' }}"
                            />
                            @error('jabatan')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <x-label>Alamat</x-label>
                        <textarea id="edit_alamat" name="alamat"
                            class="rounded bg-white dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-200
                             {{ $errors->has('alamat') ? 'border-red-500' : 'border-gray-200' }}
                            "></textarea>

                            @error('alamat')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>No. Telp</x-label>
                            <x-input type="text" id="edit_no_telp" name="no_telp"
                             class="{{ $errors->has('no_telp') ? 'border-red-500' : 'border-gray-200' }}"
                            />
                            @error('no_telp')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Email</x-label>
                            <x-input type="email" id="edit_email" name="email"
                             class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }}"
                            />
                            @error('email')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn bg-blue-600 rounded-md btn-primary text-white">Update</button>
                        <label for="edit-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Modal -->
        <input type="checkbox" id="delete-modal" class="modal-toggle" />
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
                        <label for="delete-modal" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
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