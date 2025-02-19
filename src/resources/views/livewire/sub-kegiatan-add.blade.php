<form wire:submit.prevent="save" method="POST" class="space-y-2 ">
    @csrf
    <div class="flex w-full flex-col ">
        <label for="no_rekening" class="w-full sm:w-1/4">Nomor Rekening*</label>
        <input type="number" name="no_rekening" id="no_rekening" wire:model="no_rekening"
            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-200">
        @error('no_rekening') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="flex w-full flex-col ">
        <label for="nama_sub_kegiatan" class="w-full sm:w-1/4">Nama Sub Kegiatan*</label>
        <input type="text" name="nama_sub_kegiatan" id="nama_sub_kegiatan" wire:model="nama_sub_kegiatan"
            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-200">
        @error('nama_sub_kegiatan') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="flex w-full flex-col ">
        <label for="gabungan" class="w-full sm:w-1/4">Gabungan*</label>
        <input type="text" name="gabungan" id="gabungan" wire:model="gabungan"
            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-200">
        @error('gabungan') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="flex w-full flex-col ">
        <label for="pendidikan" class="w-full sm:w-1/4">Pendidikan*</label>
        <input type="text" name="pendidikan" id="pendidikan" wire:model="pendidikan"
            class="w-3/4 rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-200">
        @error('pendidikan') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <div class="modal-action pt-4">
        <button type="submit" class="btn rounded text-white btn-primary">Simpan</button>
        <label for="add-sub-kegiatan" class="btn btn-ghost">Batal</label>
    </div>
</form>


@script
<script>
    $wire.on('Saved', () => {
        document.getElementById('add-sub-kegiatan').checked = false
    });
</script>
@endscript
