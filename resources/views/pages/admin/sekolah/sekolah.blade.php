<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">SEKOLAH</h1>
            <div>
                <a href="{{ url('admin/sekolah/import-sekolah') }}" class="btn btn-success btn-sm rounded text-white">
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