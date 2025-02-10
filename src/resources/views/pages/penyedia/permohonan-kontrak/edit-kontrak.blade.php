<x-app-layout>
    <div class="m-4 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-xl">
        <p class="mb-4 text-sm text-gray-600 dark:text-gray-300">
            DETAIL PERMOHONAN
        </p>

        <form action="{{ route('penyedia.permohonan-kontrak.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
            <input type="hidden" name="penyedia_id" value="{{ $kontrak->penyedia->penyedia_id }}">
            <input type="hidden" name="paket_id" value="{{ $kontrak->paketPekerjaan->paket_id }}">

            <!-- Section Direktur -->
            <div class="mb-8">
                <div class="flex items-center mb-4 space-x-2 text-blue-600 dark:text-blue-400">
                    <i class="fas fa-user fa-lg"></i>
                    <h3 class="text-xl font-bold">DIREKTUR</h3>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300">Nama
                            Direktur</label>
                        <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->nama_pemilik }}</p>
                    </div>

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300">Alamat
                            Direktur</label>
                        <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->alamat_pemilik }}</p>
                    </div>
                </div>
            </div>

            <!-- Section Perusahaan -->
            <div class="mb-8">
                <div class="flex items-center mb-4 space-x-2 text-blue-600 dark:text-blue-400">
                    <i class="fas fa-building fa-lg"></i>
                    <h3 class="text-xl font-bold">PERUSAHAAN</h3>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300">Nama
                            Perusahaan</label>
                        <p class="mt-1 text-gray-700 dark:text-gray-200">
                            {{ $kontrak->penyedia->nama_perusahaan_lengkap }}</p>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300">Nomor
                                Telp</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->kontak_hp }}</p>
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300">Email</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200">{{ $kontrak->penyedia->kontak_email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section Paket Pekerjaan -->
            <div class="mb-8">
                <div class="flex items-center mb-4 space-x-2 text-blue-600 dark:text-blue-400">
                    <i class="fas fa-cogs fa-lg"></i>
                    <h3 class="text-xl font-bold">PAKET PEKERJAAN</h3>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300">Kode Paket</label>
                        <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                            {{ $kontrak->paketPekerjaan->kode_paket }}</p>
                    </div>

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-800 dark:text-blue-300">Nama Paket</label>
                        <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                            {{ $kontrak->paketPekerjaan->nama_pekerjaan }}</p>
                    </div>
                </div>
            </div>

            <!-- Form Input Section -->
            <div class="space-y-6">
                <!-- File Upload -->
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Upload Berkas Penawaran <span class="text-red-500">(.pdf)</span>
                    </label>
                    <input type="file" name="berkas_penawaran"
                        class="block w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-blue-300 dark:hover:file:bg-gray-600"
                        accept=".pdf">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Pastikan maksimal ukuran berkas 5MB dan bertipe .pdf
                    </p>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-8">
                <button type="submit"
                    class="w-full px-6 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all dark:bg-blue-700 dark:hover:bg-blue-800">
                    <i class="mr-2 fas fa-save"></i> SIMPAN DATA DASAR PERMOHONAN
                </button>
            </div>
        </form>
    </div>
</x-app-layout>