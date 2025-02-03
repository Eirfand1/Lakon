<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">RIWAYAT KONTRAK</h1>
            <div>
                <a href="{{ route('admin.riwayat-kontrak.export') }}" class="btn btn-success btn-sm rounded text-white">
                    <i class="fa-solid fa-file-export"></i>
                    <span>
                        Export to Excel
                    </span>
                </a>
            </div>
        </div>
    <div>
    <livewire:kontrak-table />
</x-app-layout>