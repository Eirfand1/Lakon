
    <form wire:submit.prevent="save" method="POST" class="space-y-2 ">
        @csrf
        <div class="flex w-full flex-col ">
            <label for="dasar_hukum" class="w-full sm:w-1/4 font-bold">Dasar Hukum</label>
            <textarea name="dasar_hukum" id="dasar_hukum" cols="10" rows="5" wire:model="dasar_hukum"
            class="rounded bg-white dark:bg-gray-50/10 dark:border-gray-600 block rounded-md border-gray-300 shadow-sm focus:border-blue-200" required></textarea>
            @error('dasar_hukum') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="modal-action pt-4">
            <button type="submit" class="btn rounded text-white btn-primary">Simpan</button>
            <label for="add-dasar-hukum" class="btn btn-ghost">Batal</label>
        </div>
    </form>

    @script
        <script>
            $wire.on('dasarHukumSaved', () => {
                document.getElementById('add-dasar-hukum').checked = false
            });
        </script>
    @endscript
