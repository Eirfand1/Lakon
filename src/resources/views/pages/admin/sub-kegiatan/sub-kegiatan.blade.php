<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">SUB KEGIATAN</h1>
            <!-- Add Button -->

            <div class="flex gap-2">
                <a href="{{ route('admin.sub-kegiatan.export') }}" class="btn btn-success btn-sm rounded text-white">
                    <i class="fa-solid fa-file-export"></i>
                    <span>
                        Export to Excel
                    </span>
                </a>
                <label for="add-sub-kegiatan"
                    class="btn rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                    <i class="fa-solid fa-square-plus"></i>
                    <span>Tambah Data</span>
                </label>

            </div>
        </div>

        <livewire:sub-kegiatan-table />

        <!-- Tambah Sub Kegiatan -->
        <input type="checkbox" id="add-sub-kegiatan" class="modal-toggle" />
        <div id="modal_matriks" class="modal modal-top px-3">
            <div class="modal-box max-w-[55rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
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
                        <x-input type="number" name="no_rekening" id="no_rekening" value="{{old('no_rekening')}}"
                            class="{{ $errors->has('no_rekening') ? 'border-red-500' : 'border-gray-200' }}"
                            placeholder="Nomor Rekening" />
                        @error('no_rekening')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex w-full flex-col ">
                        <x-label for="nama_sub_kegiatan" class="w-full sm:w-1/4">Nama Sub Kegiatan</x-label>
                        <x-input type="text" name="nama_sub_kegiatan" id="nama_sub_kegiatan"
                            value="{{old('nama_sub_kegiatan')}}"
                            class="{{ $errors->has('nama_sub_kegiatan') ? 'border-red-500' : 'border-gray-200' }}"
                            placeholder="Nama Sub Kegiatan" />
                        @error('nama_sub_kegiatan')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex w-full flex-col ">
                        <x-label for="gabungan" class="w-full sm:w-1/4">Gabungan</x-label>
                        <x-input type="text" name="gabungan" id="gabungan" value="{{old('gabungan')}}"
                            class="{{ $errors->has('gabungan') ? 'border-red-500' : 'border-gray-200' }}"
                            placeholder="Gabungan" />
                        @error('gabungan')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="flex w-full flex-col ">
                        <x-label for="pendidikan" class="w-full sm:w-1/4">Pendidikan</x-label>
                        <select name="pendidikan" id="pendidikan" class="{{$errors->has('pendidikan') ? 'border-red-500' : 'border-gray-200'}} rounded-md dark:bg-gray-800 dark:border-gray-700">
                            <option value="PAUD" @if (old('pendidikan') ? '' : 'selected') @endif disabled>Pilih Pendidikan</option>
                            <option value="PAUD" @if (old('pendidikan') == 'PAUD' ? 'selected' : '') @endif>PAUD</option>
                            <option value="SD"  @if (old('pendidikan') == 'SD' ? 'selected' : '') @endif>SD</option>
                            <option value="SMP" @if (old('pendidikan') == 'SMP' ? 'selected' : '') @endif>SMP</option>
                        </select>
                        @error('pendidikan')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded-md btn-primary text-white bg-blue-600">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                        <label for="add-sub-kegiatan"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="add-sub-kegiatan">Close</label>
        </div>

        <!-- Edit Sub Kegiatan -->
        <input type="checkbox" id="edit-sub-kegiatan" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box max-w-[55rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">EDIT SUB KEGIATAN</h3>
                    </div>
                    <label for="edit-sub-kegiatan"
                        class="btn btn-sm btn-circle rounded-full shadow-none btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="space-y-2">
                    @csrf
                    @method('PUT')
                    <div class="w-full flex flex-col">
                        <x-label>Nomor Rekening</x-label>
                        <x-input type="number" id="noRekening" name="no_rekening"
                            class="{{ $errors->has('no_rekening') ? 'border-red-500' : 'border-gray-200' }}" required />
                        @error('no_rekening')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="">
                        <x-label>Nama Sub Kegiatan</x-label>
                        <x-input type="text" id="namaSubKegiatan" name="nama_sub_kegiatan"
                            class="{{ $errors->has('nama_sub_kegiatan') ? 'border-red-500' : 'border-gray-200' }}"
                            required />
                        @error('nama_sub_kegiatan')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="">
                        <x-label>Gabungan</x-label>
                        <x-input type="text" id="edit_gabungan" name="gabungan"
                            class="{{ $errors->has('gabungan') ? 'border-red-500' : 'border-gray-200' }}" required />
                        @error('gabungan')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="">
                        <x-label>Pendidikan</x-label>
                        <x-input type="text" id="edit_pendidikan" name="pendidikan"
                            class="{{ $errors->has('pendidikan') ? 'border-red-500' : 'border-gray-200' }}" required />
                        @error('pendidikan')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn bg-blue-600 btn-primary text-white rounded-md">
                            <i class="fas fa-save"></i>
                            Update
                        </button>
                        <label for="edit-sub-kegiatan"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Tutup</label>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="edit-sub-kegiatan">Close</label>
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
                        <label for="delete-sub-kegiatan"
                            class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
            <label class="modal-backdrop" for="delete-sub-kegiatan">Close</label>
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