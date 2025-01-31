<x-app-layout>
    <div class="p-5">
        <div class="mb-4 sm:mb-0 flex justify-between">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">PAKET PEKERJAAN</h1>
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


        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_matriks" class="modal">
            <div class="modal-box w-10/12 max-w-3xl rounded-lg shadow-xl dark:bg-gray-800 bg-gray-50">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Tambah Data Paket Pekerjaan</h3>
                    </div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.ppkom.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <h1 class="border-b border-gray-200 py-2 dark:border-gray-700 ">Program kerja</h1>
                    <div class="flex w-full flex-col  ">
                        <label for="sub_kegiatan" class="w-full sm:w-1/4">Sub Kegiatan*</label>
                        <select name="sub_kegiatan" id="" class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="id">a</option>
                            <option value="id">b</option>
                            <option value="id">c</option>
                            <option value="id">d</option>
                        </select>
                        
                    </div>

                    <div class="flex w-full flex-col  ">
                        <label for="sub_kegiatan" class="w-full sm:w-1/4">Sumber dana*</label>
                        <select name="sub_kegiatan" id="" class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <option value="id">a</option>
                            <option value="id">b</option>
                            <option value="id">c</option>
                            <option value="id">d</option>
                        </select>
                        
                    </div>


                    <h1 class="border-y  border-gray-200 py-5 dark:border-gray-700 ">Paket Pekerjaan</h1>
                    <div>
                        <label for="paket">Paket*</label>
                        <div class="flex gap-2 flex-wrap sm:flex-nowrap">
                            <input type="text" name="kode_paket" id="" placeholder="Kode Paket" class="w-1/2 sm:w-1/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                            <input type="text" name="nama_paket" id="" placeholder="Nama Paket"  class="w-full sm:w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                        </div>
                    </div>

                    <div class="flex w-full flex-col ">
                        <label for="sub_kegiatan" class="w-full sm:w-1/4">waktu paket*</label>
                        <input type="date" name="waktu_paket" id="" class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200">
                        
                    </div>
                </form>
            </div>
        </div>
        <livewire:paket-pekerjaan-table/>
    <div>
</x-app-layout>
