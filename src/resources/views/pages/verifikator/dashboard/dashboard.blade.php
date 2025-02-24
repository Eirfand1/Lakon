<x-app-layout>

<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">
        <i class="fa fa-calendar-o mr-2"></i> PERMOHONAN KONTRAK VERIFIKASI
    </h2>
    <div class="border-b border-gray-300 my-4"></div>

    <livewire:verifikasi-table />

</div>

<!-- Tolak Kontrak Modal -->
<input type="checkbox" id="tolak" class="modal-toggle" />
<div class="modal modal-top px-3">
    <div
        class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
        <h3 class="font-bold text-lg">Konfirmasi Menolak Kontrak</h3>
        <p>Apakah Anda yakin ingin menolak kontrak ini?</p>

            <div class="modal-action">
                <a class="btn btn-error dark:text-white" id="tolakBtn">
                    <i class="fa-solid fa-trash"></i>
                    <span>Tolak</span>
                </a>
                <label for="tolak" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
            </div>
    </div>
</div>

<!-- Terima Kontrak Modal -->
<input type="checkbox" id="terima" class="modal-toggle" />
<div class="modal modal-top px-3">
    <div
        class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
        <h3 class="font-bold text-lg">Konfirmasi Menyetujui Kontrak</h3>
        <p>Apakah Anda yakin ingin menyetujui kontrak ini?</p>
            <div class="modal-action">
                <a class="btn btn-success dark:text-white" id="terimaBtn">
                    <i class="fa-solid fa-check"></i>
                    <span>Terima</span>
                </a>
                <label for="terima" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
            </div>
    </div>
</div>

<script>
    function tolak(kontrak_id) {
        document.getElementById('tolak').checked = true;
        document.getElementById('tolakBtn').href = `tolak/${kontrak_id}`
    }

    function terima(kontrak_id) {
        document.getElementById('terima').checked = true;
        document.getElementById('terimaBtn').href = `terima/${kontrak_id}`
    }
</script>
</x-app-layout>

