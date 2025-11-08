<x-app-layout>
    <div class="p-5">
        <div class="sm:flex sm:justify-between sm:items-center p-2 pb-5">
            <div class="">
                <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">SATUAN KERJA</h1>
            </div>
            <!-- Add Button -->
            <label for="add-modal" class="btn bg-gray-800 hover:bg-gray-700 rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800">
                <i class="fa-solid fa-square-plus"></i>
                <span>Tambah Data</span>
            </label>
        </div>

        <!-- Table -->
        <livewire:satuan-kerja-table />

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_satuan_kerja" class="modal modal-top px-3">
            <div class="modal-box max-w-[55rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">TAMBAH SATUAN KERJA</h3>
                    </div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle btn-ghost rounded-full shadow-none hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.satuan-kerja.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>NIP</x-label>
                            <x-input type="text" name="nip" value="{{old('nip')}}"
                                class="{{ $errors->has('nip') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="NIP"
                                required />
                            @error('nip')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Nama Pimpinan</x-label>
                            <x-input type="text" name="nama_pimpinan" value="{{old('nama_pimpinan')}}"
                                class="{{ $errors->has('nama_pimpinan') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="Nama Pimpinan"
                                required />
                            @error('nama_pimpinan')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>Jabatan</x-label>
                            <x-input type="text" name="jabatan" value="{{old('jabatan')}}"
                                class="{{ $errors->has('jabatan') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="Jabatan"
                                required />
                            @error('jabatan')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>KLPD</x-label>
                            <x-input type="text" name="klpd" value="{{old('klpd')}}"
                                class="{{ $errors->has('klpd') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="KLPD"
                                required />
                            @error('klpd')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>Website</x-label>
                            <x-input type="url" name="website" value="{{old('website')}}"
                                class="{{ $errors->has('website') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="https://example.com" />
                            @error('website')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Email</x-label>
                            <x-input type="email" name="email" value="{{old('email')}}"
                                class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="email@example.com"
                                required />
                            @error('email')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <x-label>Telepon</x-label>
                        <x-input type="text" name="telp" value="{{old('telp')}}"
                            class="{{ $errors->has('telp') ? 'border-red-500' : 'border-gray-200' }}"
                            placeholder="Nomor Telepon"
                            required />
                        @error('telp')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn bg-blue-600 btn-primary rounded-md text-white">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                        <label for="add-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Tutup</label>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="add-modal">Close</label>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box max-w-[55rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">EDIT SATUAN KERJA</h3>
                    </div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle rounded-full shadow-none btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>NIP</x-label>
                            <x-input type="text" name="nip" id="edit_nip"
                                class="{{ $errors->has('nip') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="NIP"
                                required />
                            @error('nip')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Nama Pimpinan</x-label>
                            <x-input type="text" name="nama_pimpinan" id="edit_nama_pimpinan"
                                class="{{ $errors->has('nama_pimpinan') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="Nama Pimpinan"
                                required />
                            @error('nama_pimpinan')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>Jabatan</x-label>
                            <x-input type="text" name="jabatan" id="edit_jabatan"
                                class="{{ $errors->has('jabatan') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="Jabatan"
                                required />
                            @error('jabatan')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>KLPD</x-label>
                            <x-input type="text" name="klpd" id="edit_klpd"
                                class="{{ $errors->has('klpd') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="KLPD"
                                required />
                            @error('klpd')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <x-label>Website</x-label>
                            <x-input type="url" name="website" id="edit_website"
                                class="{{ $errors->has('website') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="https://example.com" />
                            @error('website')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <x-label>Email</x-label>
                            <x-input type="email" name="email" id="edit_email"
                                class="{{ $errors->has('email') ? 'border-red-500' : 'border-gray-200' }}"
                                placeholder="email@example.com"
                                required />
                            @error('email')
                                <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <x-label>Telepon</x-label>
                        <x-input type="text" name="telp" id="edit_telp"
                            class="{{ $errors->has('telp') ? 'border-red-500' : 'border-gray-200' }}"
                            placeholder="Nomor Telepon"
                            required />
                        @error('telp')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn bg-blue-600 btn-primary rounded-md text-white">
                            <i class="fas fa-save"></i>
                            Update
                        </button>
                        <label for="edit-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Batal</label>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="edit-modal">Close</label>
        </div>

        <!-- Delete Modal -->
        <input type="checkbox" id="delete-modal" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
                <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                <p>Apakah Anda yakin ingin menghapus data satuan kerja ini?</p>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-action">
                        <x-danger-button type="submit">
                            <i class="fa-solid fa-trash"></i>
                            <span>Hapus</span>
                        </x-danger-button>
                        <label for="delete-modal" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Batal</label>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="delete-modal">Close</label>
        </div>
    </div>

    <script>
        function editHandler(satker) {
            const form = document.getElementById('editForm');
            form.action = `/admin/satuan-kerja/${satker.satker_id}`;

            document.getElementById('edit_nip').value = satker.nip;
            document.getElementById('edit_nama_pimpinan').value = satker.nama_pimpinan;
            document.getElementById('edit_jabatan').value = satker.jabatan;
            document.getElementById('edit_klpd').value = satker.klpd;
            document.getElementById('edit_website').value = satker.website || '';
            document.getElementById('edit_email').value = satker.email;
            document.getElementById('edit_telp').value = satker.telp;
        }

        function setDeleteId(satker_id) {
            document.getElementById('deleteForm').action = `/admin/satuan-kerja/${satker_id}`;
        }
    </script>
</x-app-layout>
