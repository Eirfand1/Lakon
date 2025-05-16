<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">DASAR HUKUM</h1>
            <!-- Add Button -->
            <div class="flex gap-2">
                <a href="{{ route('admin.dasar-hukum.export') }}" class="btn btn-success btn-sm rounded text-white">
                    <i class="fa-solid fa-file-export"></i>
                    <span>
                        Export to Excel
                    </span>
                </a>
                <label for="add-dasar-hukum"
                    class="btn rounded btn-sm px-3 bg-gray-800 hover:bg-gray-700 text-white dark:bg-gray-100 dark:text-gray-800 ">
                    <i class="fa-solid fa-square-plus"></i>
                    <span>Tambah Data</span>
                </label>
            </div>

        </div>

        <div class="overflow-x-hidden">
            <livewire:dasar-hukum-table />
        </div>

        <!-- Tambah Dasar Hukum -->
        <input type="checkbox" id="add-dasar-hukum" class="modal-toggle" />
        <div id="modal_matriks" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">TAMBAH DASAR HUKUM</h3>
                    </div>
                    <label for="add-dasar-hukum"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 rounded-full shadow-none dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.dasar-hukum.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <div class="flex w-full flex-col ">
                        <x-label for="dasar_hukum">Dasar Hukum</x-label>
                        <textarea name="dasar_hukum" id="dasar_hukum" cols="10" rows="5"
                            class="{{ $errors->has('nilai_pagu_anggaran') ? 'border-red-500' : 'border-gray-200' }} rounded bg-white dark:bg-gray-900/20 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-200"
                            required>{{old('dasar_hukum')}}</textarea>
                        @error('dasar_hukum')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded-lg text-white btn-primary bg-blue-500">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                        <label for="add-dasar-hukum"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>

            <label class="modal-backdrop" for="add-dasar-hukum">Close</label>
        </div>

        <!-- Edit Dasar Hukum -->
        <input type="checkbox" id="edit-daskum" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">EDIT DASAR HUKUM</h3>
                    </div>
                    <label for="edit-daskum"
                        class="btn btn-sm rounded-full shadow-none btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form id="editForm" method="POST" class="space-y-2">
                    @csrf
                    @method('PUT')
                    <div class="flex w-full flex-col">
                        <x-label>Dasar Hukum</x-label>
                        <textarea name="dasar_hukum" id="dasarHukum" cols="10" rows="5"
                            class="{{ $errors->has('nilai_pagu_anggaran') ? 'border-red-500' : 'border-gray-200' }} rounded bg-white dark:bg-gray-900/20 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-200"
                            required></textarea>
                        @error('dasar_hukum')
                            <span class="text-sm text-red-500 mt-1">{{$message}}</span>
                        @enderror
                    </div>

                    <div class="modal-action">
                        <button type="submit" class="btn text-white btn-primary bg-blue-500">
                            <i class="fas fa-save"></i>
                            Update
                        </button>
                        <label for="edit-daskum"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Tutup</label>
                    </div>
                </form>
            </div>

            <label class="modal-backdrop" for="edit-daskum">Close</label>
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
                        <label for="delete-daskum"
                            class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>

            <label class="modal-backdrop" for="delete-daskum">Close</label>
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

                document.addEventListener('DOMContentLoaded', () => {
                    console.log(
                        numberToText.convertToText(12346, {
                            language: 'id'
                        })
                    )
                })

            </script>
</x-app-layout>
