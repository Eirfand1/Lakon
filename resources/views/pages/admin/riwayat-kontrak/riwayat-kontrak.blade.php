<x-app-layout>
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="mb-4 flex justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">RIWAYAT KONTRAK</h1>
            <div>
                <a href="{{ route('admin.riwayat-kontrak.export') }}" class="btn btn-success btn-sm rounded text-white">Export to Excel</a>
            </div>
        </div>
    <div>
    <livewire:kontrak-table />
</x-app-layout>