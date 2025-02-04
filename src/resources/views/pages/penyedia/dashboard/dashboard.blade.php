<x-app-layout>


<div class="container mx-auto p-4">
    <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
        <!-- Company Info Card -->
        <div class="md:col-span-5">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6">
                    <div class="text-center mb-6">
                        <img src="/path-to-your-logo.png" alt="Company Logo" class="w-1/2 mx-auto">
                    </div>
                    <div class="px-4">
                        <table class="w-full">
                            <tbody>
                                <tr class="border-b dark:border-gray-700">
                                    <td class="py-3 font-semibold w-1/3 dark:text-gray-200">Nama Perusahaan</td>
                                    <td class="py-3 px-2 dark:text-gray-200">:</td>
                                    <td class="py-3 dark:text-gray-300">{{$penyedia->nama_perusahaan_lengkap}}</td>
                                </tr>
                                <tr class="border-b dark:border-gray-700">
                                    <td class="py-3 font-semibold dark:text-gray-200">Alamat Perusahaan</td>
                                    <td class="py-3 px-2 dark:text-gray-200">:</td>
                                    <td class="py-3 dark:text-gray-300">{{$penyedia->alamat_perusahaan}}</td>
                                </tr>
                                <tr class="border-b dark:border-gray-700">
                                    <td class="py-3 font-semibold dark:text-gray-200">No-telp</td>
                                    <td class="py-3 px-2 dark:text-gray-200">:</td>
                                    <td class="py-3 dark:text-gray-300">{{$penyedia->kontak_hp}}</td>
                                </tr>
                                <tr class="border-b dark:border-gray-700">
                                    <td class="py-3 font-semibold dark:text-gray-200">Email</td>
                                    <td class="py-3 px-2 dark:text-gray-200">:</td>
                                    <td class="py-3 dark:text-gray-300">{{$penyedia->kontak_email}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="py-3 text-sm dark:text-gray-300">
                                        Untuk melengkapi data Perusahaan Anda
                                        <a href="#" class="text-red-600 hover:text-red-500 dark:text-red-400 dark:hover:text-red-300">
                                            Klik Disini!
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Service Application Section -->
        <div class="md:col-span-7">
            <div class="bg-blue-400 text-gray-50 dark:bg-blue-900 p-6 rounded-2xl shadow-lg">
                <h2 class="text-lg mb-4 dark:text-gray-200">
                    Pengajuan Layanan Kontrak menggunakan LAKON PDK. Segera ajukan permohonan Kontrak dengan mempersiapkan data - data terkait Kontrak Anda.
                </h2>
                <a href="permohonan-kontrak" class="block w-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 font-semibold py-3 px-4 rounded-full text-center transition-colors" wire:navigate>
                    <i class="fa fa-hand-o-right"></i>
                    PERMOHONAN KONTRAK
                    <i class="fa fa-hand-o-left"></i>
                </a>
            </div>

            <div class="mt-6 bg-green-500 text-gray-50 dark:bg-green-800 p-6 rounded-2xl shadow-lg text-center">
                <h1 class="text-2xl font-bold">Halo Lakon</h1>
            </div>
        </div>

        <!-- Contract Applications Table -->
        <div class="md:col-span-12">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg">
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-4 flex items-center dark:text-gray-200">
                        <i class="fa fa-calendar-o mr-2"></i>
                        PERMOHONAN KONTRAK DALAM PROSES
                    </h2>
                    <div class="border-b border-gray-200 dark:border-gray-700 mb-4"></div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-700">
                                    <th class="p-3 text-center dark:text-gray-200">No.</th>
                                    <th class="p-3 text-center dark:text-gray-200">Tiket</th>
                                    <th class="p-3 text-center dark:text-gray-200">Kode Paket</th>
                                    <th class="p-3 text-left dark:text-gray-200">Nama Paket</th>
                                    <th class="p-3 text-center dark:text-gray-200">Jenis Pengadaan</th>
                                    <th class="p-3 text-center dark:text-gray-200">Metode Pengadaan</th>
                                    <th class="p-3 text-left dark:text-gray-200">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="7" class="p-4 text-center font-semibold dark:text-gray-300">
                                        Tidak ada permohonan kontrak yang sedang proses.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
