<x-app-layout>
    <div class="p-5">
        <div class="sm:flex sm:justify-between sm:items-center p-2 pb-5">
            <div class="">
                <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">TEMPLATE</h1>
            </div>
            <!-- Add Button -->
            <label for="add-modal" class="btn bg-gray-800 hover:bg-gray-700 rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                <i class="fa-solid fa-square-plus"></i>
                <span>Tambah Data</span>
            </label>
        </div>

        <livewire:template-table />


        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_template" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-lg dark:text-gray-200">TAMBAH TEMPLATE</h3>
                    </div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 rounded-full shadow-none dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.template.store') }}" method="POST" class="space-y-2 " enctype="multipart/form-data">
                    @csrf
                    <div class="flex w-full flex-col ">
                        <x-label for="name">Nama Template</x-label>
                        <x-input type="text" name="name" required /> 
                    </div>

                    <div class="flex w-full flex-col ">
                        <x-label for="name">File Template</x-label>
                        <x-input name="file_path" type="file" required /> 
                    </div>

                    <div class="modal-action pt-4">
                        <button type="submit" class="btn rounded-md text-white btn-primary bg-blue-500">
                            <i class="fas fa-save"></i>
                            Simpan
                        </button>
                        <label for="add-modal" class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>

        <input type="checkbox" id="delete-template" class="modal-toggle" />
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
                        <label for="delete-template" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script>
        function setDeleteId(template_id) {
            document.getElementById('deleteForm').action = `template/${template_id}`;
        }
    </script>

</x-app-layout>