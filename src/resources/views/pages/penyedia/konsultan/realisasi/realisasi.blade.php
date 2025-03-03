<x-app-layout>

    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">
            <i class="fa fa-calendar-o mr-2"></i> REALISASI KONTRAK <span class="text-red-500"> {{ $kontrak->no_kontrak }} </span>
        </h2>
        <div class="border-b border-gray-300 my-4"></div>

            <div class="mb-8">
                <div class="grid grid-cols-1 gap-4">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Kode
                                Paket</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->kode_paket }}
                            </p>
                        </div>

                        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nama
                                Paket</label>
                            <p class="mt-1 text-gray-700 dark:text-gray-200 font-medium">
                                {{ $kontrak->paketPekerjaan->nama_pekerjaan }}
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


            <form action="/penyedia/realisasi/{{ $kontrak->kontrak_id }}" method="POST" class="space-y-4" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tahun</label>
                        <input type="number" name="tahun" id="tahun" placeholder="Tahun" required class="w-full dark:bg-gray-800 rounded mt-2">
                    </div>

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Bulan</label>
                        <select name="bulan" id="bulan" required class="w-full dark:bg-gray-800 rounded mt-2">
                            <option value="">Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Target</label>
                        <input type="text" name="target" id="target" placeholder="target" required class="w-full dark:bg-gray-800 rounded mt-2">
                    </div>

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Realisasi</label>
                        <input type="file" name="gambar" id="gambar" required class="block pt-2 w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-blue-300 dark:hover:file:bg-gray-600">
                    </div>
                </div>

                <button class="btn bg-blue-600 btn-primary rounded-md text-white w-full">SIMPAN REALISASI KONTRAK</button>
            </form>

            <div class="border-b border-gray-300 my-4"></div>

            <table class="table mt-4">
                <thead>
                    <tr>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Tahun</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Bulan</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Target</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Realisasi</th>
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
                                {{ $item->target }}
                            </td>
                            <td class="p-3 bg-blue-50 dark:bg-gray-700/60 border-2 border-x-3 border-gray-400">
                                <img src="{{ asset($item->gambar) }}" alt="gambar error" class="w-auto h-[200px] border-2 border-x-3 border-gray-400">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>

</x-app-layout>
