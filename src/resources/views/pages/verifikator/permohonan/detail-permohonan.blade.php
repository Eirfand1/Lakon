<x-app-layout>

<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">
        <i class="fa fa-calendar-o mr-2"></i> HALLO (BELUM JADI NIH)
    </h2>
    <div class="border-b border-gray-300 my-4"></div>

    @include('pages.lampiran.penerima-barang')
    @include('pages.lampiran.dokumen-penagihan')
    @include('pages.lampiran.dokumen-pekerjaan')
    @include('pages.lampiran.dokumen-tambahan')
    @include('pages.lampiran.keterangan-hak-dan-kewajiban')
    @include('pages.lampiran.keterangan-tindakan')
    @include('pages.lampiran.keterangan-fasilitas')

</div>

<!-- Delete -->
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
                <button type="submit" class="btn btn-error">
                    <i class="fa-solid fa-trash"></i>
                    <span>Hapus</span>
                </button>
                <label for="delete-modal" class="btn">Batal</label>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
