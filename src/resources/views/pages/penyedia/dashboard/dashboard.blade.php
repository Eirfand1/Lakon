<x-app-layout>
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
            <!-- Company Info Card -->
            <div class="md:col-span-5">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="border-b border-gray-100 dark:border-gray-700 p-4">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Informasi Perusahaan</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex justify-center mb-8">
                            <div class="w-40 h-40 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center">
                                <img src="{{ asset($penyedia->logo_perusahaan)  }}" alt="Company Logo" class="max-w-full max-h-full p-4">
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex border-b border-gray-100 dark:border-gray-700 pb-3">
                                <div class="w-2/5 font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan</div>
                                <div class="w-1/20 text-gray-600 dark:text-gray-400">:</div>
                                <div class="flex-1 text-gray-800 dark:text-gray-200">{{$penyedia->nama_perusahaan_lengkap}}</div>
                            </div>
                            <div class="flex border-b border-gray-100 dark:border-gray-700 pb-3">
                                <div class="w-2/5 font-medium text-gray-700 dark:text-gray-300">Alamat Perusahaan</div>
                                <div class="w-1/20 text-gray-600 dark:text-gray-400">:</div>
                                <div class="flex-1 text-gray-800 dark:text-gray-200">{{$penyedia->alamat_perusahaan}}</div>
                            </div>
                            <div class="flex border-b border-gray-100 dark:border-gray-700 pb-3">
                                <div class="w-2/5 font-medium text-gray-700 dark:text-gray-300">No. Telepon</div>
                                <div class="w-1/20 text-gray-600 dark:text-gray-400">:</div>
                                <div class="flex-1 text-gray-800 dark:text-gray-200">{{$penyedia->kontak_hp}}</div>
                            </div>
                            <div class="flex border-b border-gray-100 dark:border-gray-700 pb-3">
                                <div class="w-2/5 font-medium text-gray-700 dark:text-gray-300">Email</div>
                                <div class="w-1/20 text-gray-600 dark:text-gray-400">:</div>
                                <div class="flex-1 text-gray-800 dark:text-gray-200">{{$penyedia->kontak_email}}</div>
                            </div>
                        </div>
                        <div class="mt-6 text-center">
                            <a href="/penyedia/data-perusahaan" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium" wire:navigate>
                                <span class="inline-flex items-center">
                                    <span>Lengkapi Data Perusahaan</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Application Section -->
            <div class="md:col-span-7">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-800 dark:to-blue-900 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-white mb-4">Pengajuan Layanan Kontrak</h2>
                        <p class="text-blue-100 mb-6">
                            Gunakan LAKON PDK untuk mengajukan permohonan kontrak dengan lebih efisien. Siapkan dokumen dan data pendukung untuk memperlancar proses pengajuan Anda.
                        </p>
                        <a href="permohonan-kontrak" 
                           class="block w-full bg-gray-100 hover:bg-gray-200 text-blue-700 dark:text-blue-800 font-bold py-3 px-4 rounded-lg text-center transition-colors duration-200 shadow-md" 
                           wire:navigate>
                            <span class="inline-flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                <span>AJUKAN PERMOHONAN KONTRAK</span>
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Information Cards -->
                    <div class="bg-white my-5 dark:bg-gray-800 rounded-lg shadow p-4 border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">Permohonan Aktif</div>
                                <div class="text-xl font-bold text-gray-800 dark:text-gray-200">{{ count($kontrak) }}</div>
                            </div>
                        </div>
                    </div>
            </div>

            <!-- Contract Applications Table -->
            <div class="md:col-span-12">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-100 dark:border-gray-700">
                    <div class="p-5 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            Permohonan Kontrak Dalam Proses
                        </h2>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            Total: {{ count($kontrak) }} permohonan
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">No.</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Kode Sirup</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Nama Paket</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Jenis Pengadaan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Metode Pengadaan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tanggal</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($kontrak as $index => $row)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700 dark:text-gray-300">{{ $row->paketPekerjaan->kode_sirup }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-700 dark:text-gray-300">
                                            {{ $row->paketPekerjaan->nama_pekerjaan }}
                                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $row->paketPekerjaan->sekolah->nama_sekolah }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $row->paketPekerjaan->jenis_pengadaan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">{{ $row->paketPekerjaan->metode_pemilihan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 dark:text-gray-300">
                                            @if($row->tgl_pembuatan)
                                                <span class="font-medium">{{ $row->tgl_pembuatan }}</span>
                                            @else
                                                <span class="text-gray-400 dark:text-gray-500">-</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            @if ($row->is_layangkan)
                                                <a href="detail-kontrak/{{ $row->kontrak_id }}" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white rounded text-xs font-medium hover:bg-blue-700 transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                    </svg>
                                                    Detail
                                                </a>
                                            @else
                                                <a href="permohonan-kontrak/{{ $row->kontrak_id }}" class="inline-flex items-center px-3 py-1.5 bg-yellow-600 text-white rounded text-xs font-medium hover:bg-yellow-700 transition-colors" wire:navigate>
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Buat Permohonan
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @if (count($kontrak) == 0)
                                    <tr>
                                        <td class="px-6 py-8 text-sm text-gray-500 dark:text-gray-400 text-center" colspan="7">
                                            <div class="flex flex-col items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300 dark:text-gray-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span>Tidak ada data permohonan kontrak</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
