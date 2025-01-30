<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">SEKOLAH</h1>
            <div>
                <a href="{{ url('admin/sekolah/import-sekolah') }}" wire:navigate class="btn btn-success btn-sm rounded text-white">
                    <i class="fa-solid fa-file-import"></i>
                    <span>
                        Import Excel
                    </span>
                </a>
            </div>
        </div>
    <div>
    <livewire:sekolah-table />
</x-app-layout>