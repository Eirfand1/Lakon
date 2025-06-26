<x-app-layout>

    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">
            <i class="fa fa-calendar-o mr-2"></i> REALISASI KONTRAK <span class="text-red-500"> {{ $kontrak->no_kontrak }} </span>
        </h2>
        <div class="border-b border-gray-300 my-4"></div>

            <div class="mb-8">
                <div class="grid grid-cols-1 gap-4">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-1">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Kode
                                Sirup</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->kode_sirup }}
                            </p>
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama
                                Paket</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->nama_pekerjaan }}
                                {{ $kontrak->paketPekerjaan->sekolah->nama_sekolah ?? "" }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Jenis
                                Pengadaan</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->jenis_pengadaan }}
                            </p>
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Metode
                                Pemilihan</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->metode_pemilihan }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-300 my-4"></div>

            <table class="table mt-4" id="tableRealisasi">
                <thead>
                    <tr>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Tahun</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Bulan</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Target</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Realisasi</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Gambar</th>
                    </tr>
                </thead>

                <tbody>
                    @php $tahun = null; $bulan = null @endphp
                    @foreach ($kontrak->realisasi as $item)
                        <tr>
                            @if ($tahun != $item->tahun)
                                <td rowspan="{{ $kontrak->realisasi->where('tahun', $item->tahun)->count() }}" class="p-3 bg-blue-50 dark:bg-gray-700/60 border-2 border-x-3 border-gray-400">
                                    {{ $item->tahun }}
                                </td>
                                @php $tahun = $item->tahun; $bulan = null @endphp
                            @endif
                            @if ($bulan != $item->bulan)
                                <td rowspan="{{ $kontrak->realisasi->where('tahun', $item->tahun)->where('bulan', $item->bulan)->count() }}" class="p-3 bg-blue-50 dark:bg-gray-700/60 border-2 border-x-3 border-gray-400">
                                    @switch($item->bulan)
                                        @case(1) Januari @break
                                        @case(2) Februari @break
                                        @case(3) Maret @break
                                        @case(4) April @break
                                        @case(5) Mei @break
                                        @case(6) Juni @break
                                        @case(7) Juli @break
                                        @case(8) Agustus @break
                                        @case(9) September @break
                                        @case(10) Oktober @break
                                        @case(11) November @break
                                        @case(12) Desember @break
                                    @endswitch
                                </td>
                                @php $bulan = $item->bulan @endphp
                            @endif
                            <td class="p-3 bg-blue-50 dark:bg-gray-700/60 border-2 border-x-3 border-gray-400">
                                <div class="text-center">
                                    {{ $item->target }}
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div
                                        class="bg-blue-600 h-2.5 rounded-full"
                                        style="width: {{ str_replace(',', '.', $item->target) }};"
                                    ></div>
                                </div>
                            </td>
                            <td class="p-3 bg-blue-50 dark:bg-gray-700/60 border-2 border-x-3 border-gray-400">
                                <div class="text-center">
                                    {{ $item->realisasi }}
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                    <div
                                        class="bg-blue-600 h-2.5 rounded-full"
                                        style="width: {{ str_replace(',', '.', $item->realisasi) }};"
                                    ></div>
                                </div>
                            </td>
                            <td class="p-3 bg-blue-50 dark:bg-gray-700/60 border-2 border-x-3 border-gray-400">
                                <div class="flex gap-1">
                                    <img src="{{ asset($item->gambar1) }}" alt="gambar error" class="w-auto h-[200px] border-2 border-x-3 border-gray-400">
                                    <img src="{{ asset($item->gambar2) }}" alt="gambar error" class="w-auto h-[200px] border-2 border-x-3 border-gray-400">
                                    <img src="{{ asset($item->gambar3) }}" alt="gambar error" class="w-auto h-[200px] border-2 border-x-3 border-gray-400">
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


    </div>
</x-app-layout>
