<x-app-layout>
    <div class="p-4 sm:p-6">
        <!-- Header Section -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                Detail Realisasi Kontrak
            </h2>

            <!-- Info Kontrak Card -->
            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4 shadow-sm space-y-3">
                <div class="flex items-start gap-3">
                    <div class="text-gray-600 dark:text-gray-400 mt-0.5">
                        <i class="fa fa-file-contract text-lg"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs text-gray-500 dark:text-gray-400 font-medium mb-1">Nama Paket Pekerjaan</p>
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-100 leading-relaxed">
                            {{ $kontrak->paketPekerjaan->nama_pekerjaan }}
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-start gap-2">
                        <i class="fa fa-hashtag text-gray-600 dark:text-gray-400 text-sm mt-1"></i>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Nomor Kontrak</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $kontrak->nomor_spk ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-2">
                        <i class="fa fa-building text-gray-600 dark:text-gray-400 text-sm mt-1"></i>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Penyedia</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">
                                @if($kontrak->penyedia && $kontrak->penyedia->nama_pemilik)sss
                                    {{ $kontrak->penyedia->nama_pemilik }}
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="flex items-start gap-2">
                        <i class="fa fa-money-bill-wave text-gray-600 dark:text-gray-400 text-sm mt-1"></i>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Nilai Kontrak</p>
                            <p class="text-sm font-medium text-gray-800 dark:text-gray-200">Rp {{ number_format($kontrak->nilai_kontrak ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        <!-- Table Section -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse" id="tableRealisasi">
                    <thead>
                        <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-left font-semibold w-[180px]">
                                Nama Sekolah
                            </th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-semibold w-[90px]">
                                Tahun
                            </th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-semibold w-[110px]">
                                Bulan
                            </th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-semibold w-[140px]">
                                Target
                            </th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-semibold w-[140px]">
                                Realisasi
                            </th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center font-semibold">
                                Dokumentasi
                            </th>
                        </tr>
                    </thead>

                <tbody>
                    @php
                        if (! function_exists('__parseNumber')) {
                            function __parseNumber($v) {
                                if (is_null($v) || $v === '') return 0.0;
                                if (is_numeric($v)) return (float)$v;
                                $s = trim((string)$v);
                                $s = str_replace('%', '', $s);
                                $s = preg_replace('/[^\d\-\.,]/u', '', $s);
                                if (strpos($s, '.') !== false && strpos($s, ',') !== false) {
                                    $lastDot = strrpos($s, '.'); $lastComma = strrpos($s, ',');
                                    if ($lastDot > $lastComma) {
                                        $s = str_replace(',', '', $s);
                                    } else {
                                        $s = str_replace('.', '', $s);
                                        $s = str_replace(',', '.', $s);
                                    }
                                } elseif (strpos($s, ',') !== false) {
                                    $s = str_replace(',', '.', $s);
                                }
                                return is_numeric($s) ? (float)$s : 0.0;
                            }
                        }

                        if (! function_exists('__percentLabel')) {
                            function __percentLabel($val) {
                                if ($val === null) return '-';
                                if (abs($val - round($val)) < 0.000001) {
                                    return number_format(round($val), 0, ',', '.') . '%';
                                }
                                return number_format($val, 2, ',', '.') . '%';
                            }
                        }

                        $pillWidth = 120;
                        $monthNames = [
                            1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',
                            7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'
                        ];
                    @endphp

                    @php
                        $realisasiCollection = $kontrak->realisasi->map(function($r){
                            $r->sekolah = trim((string)($r->sekolah ?? '-'));
                            $r->tahun   = trim((string)($r->tahun ?? '-'));
                            $r->bulan   = (int)($r->bulan ?? 0);
                            return $r;
                        });
                        $groupBySchool = $realisasiCollection->groupBy('sekolah');
                    @endphp

                    @forelse($groupBySchool as $sekolah => $dataSekolah)
                        @php
                            $schoolRowCount = $dataSekolah->count();
                            $printedSchool = false;
                        @endphp

                        @foreach($dataSekolah->groupBy('tahun') as $tahun => $dataTahun)
                            @php
                                $yearRowCount = $dataTahun->count();
                                $printedYear = false;
                            @endphp

                            @foreach($dataTahun->groupBy('bulan') as $bulan => $dataBulan)
                                @php
                                    $rows = $dataBulan->sortBy(function($item) {
                                        return __parseNumber($item->target);
                                    })->values();
                                    $monthRowCount = $rows->count();
                                    $printedMonth = false;
                                    $bulanText = $monthNames[(int)$bulan] ?? '-';
                                @endphp

                                @foreach($rows as $r)
                                    @php
                                        $targetVal = __parseNumber($r->target);
                                        $realisasiVal = __parseNumber($r->realisasi);

                                        $target_bar = min(max($targetVal, 0), 100);
                                        $realisasi_bar = min(max($realisasiVal, 0), 100);

                                        $target_label = __percentLabel($targetVal);
                                        $realisasi_label = __percentLabel($realisasiVal);
                                    @endphp

                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                                        @if (!$printedSchool)
                                            <td rowspan="{{ $schoolRowCount }}" class="border border-gray-300 dark:border-gray-600 px-4 py-3 font-medium align-top w-[180px] text-gray-800 dark:text-gray-200">
                                                {{ $sekolah }}
                                            </td>
                                            @php $printedSchool = true; @endphp
                                        @endif

                                        @if (!$printedYear)
                                            <td rowspan="{{ $yearRowCount }}" class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center align-top w-[90px] text-gray-700 dark:text-gray-300">
                                                {{ $tahun }}
                                            </td>
                                            @php $printedYear = true; @endphp
                                        @endif

                                        @if (!$printedMonth)
                                            <td rowspan="{{ $monthRowCount }}" class="border border-gray-300 dark:border-gray-600 px-4 py-3 text-center align-top w-[110px] text-gray-700 dark:text-gray-300">
                                                {{ $bulanText }}
                                            </td>
                                            @php $printedMonth = true; @endphp
                                        @endif

                                        {{-- Target --}}
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 align-top w-[140px]">
                                            <div class="flex flex-col items-center gap-2">
                                                <span class="text-sm font-semibold text-blue-600 dark:text-blue-400">{{ $target_label }}</span>
                                                <div style="width: {{ $pillWidth }}px; height:16px; background:#e5e7eb; border-radius:8px; overflow:hidden;">
                                                    <div style="
                                                        height:100%;
                                                        width: {{ $target_bar }}%;
                                                        background: #3b82f6;
                                                        border-radius: 8px;
                                                    "></div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Realisasi --}}
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 align-top w-[140px]">
                                            <div class="flex flex-col items-center gap-2">
                                                <span class="text-sm font-semibold text-green-600 dark:text-green-400">{{ $realisasi_label }}</span>
                                                <div style="width: {{ $pillWidth }}px; height:16px; background:#e5e7eb; border-radius:8px; overflow:hidden;">
                                                    <div style="
                                                        height:100%;
                                                        width: {{ $realisasi_bar }}%;
                                                        background: #10b981;
                                                        border-radius: 8px;
                                                    "></div>
                                                </div>
                                            </div>
                                        </td>

                                        {{-- Gambar --}}
                                        <td class="border border-gray-300 dark:border-gray-600 px-4 py-3 align-top">
                                            <div class="grid grid-cols-3 gap-2">
                                                @if(!empty($r->gambar1))
                                                    <button type="button" class="open-image group relative overflow-hidden rounded shadow hover:shadow-md transition-shadow" data-src="{{ asset($r->gambar1) }}">
                                                        <img src="{{ asset($r->gambar1) }}" loading="lazy" class="w-full h-20 object-cover">
                                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                                                            <i class="fa fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                                        </div>
                                                    </button>
                                                @endif
                                                @if(!empty($r->gambar2))
                                                    <button type="button" class="open-image group relative overflow-hidden rounded shadow hover:shadow-md transition-shadow" data-src="{{ asset($r->gambar2) }}">
                                                        <img src="{{ asset($r->gambar2) }}" loading="lazy" class="w-full h-20 object-cover">
                                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                                                            <i class="fa fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                                        </div>
                                                    </button>
                                                @endif
                                                @if(!empty($r->gambar3))
                                                    <button type="button" class="open-image group relative overflow-hidden rounded shadow hover:shadow-md transition-shadow" data-src="{{ asset($r->gambar3) }}">
                                                        <img src="{{ asset($r->gambar3) }}" loading="lazy" class="w-full h-20 object-cover">
                                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                                                            <i class="fa fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                                        </div>
                                                    </button>
                                                @endif
                                                @if(!empty($r->gambar4))
                                                    <button type="button" class="open-image group relative overflow-hidden rounded shadow hover:shadow-md transition-shadow" data-src="{{ asset($r->gambar4) }}">
                                                        <img src="{{ asset($r->gambar4) }}" loading="lazy" class="w-full h-20 object-cover">
                                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                                                            <i class="fa fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                                        </div>
                                                    </button>
                                                @endif
                                                @if(!empty($r->gambar5))
                                                    <button type="button" class="open-image group relative overflow-hidden rounded shadow hover:shadow-md transition-shadow" data-src="{{ asset($r->gambar5) }}">
                                                        <img src="{{ asset($r->gambar5) }}" loading="lazy" class="w-full h-20 object-cover">
                                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                                                            <i class="fa fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                                        </div>
                                                    </button>
                                                @endif
                                                @if(!empty($r->gambar6))
                                                    <button type="button" class="open-image group relative overflow-hidden rounded shadow hover:shadow-md transition-shadow" data-src="{{ asset($r->gambar6) }}">
                                                        <img src="{{ asset($r->gambar6) }}" loading="lazy" class="w-full h-20 object-cover">
                                                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                                                            <i class="fa fa-search-plus text-white opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                                        </div>
                                                    </button>
                                                @endif
                                                @if(empty($r->gambar1) && empty($r->gambar2) && empty($r->gambar3) && empty($r->gambar4) && empty($r->gambar5) && empty($r->gambar6))
                                                    <div class="col-span-3 text-center text-sm text-gray-400 py-2">
                                                        Tidak ada dokumentasi
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            @endforeach
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-6 text-gray-500 dark:text-gray-400">
                                Belum ada data realisasi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <!-- Modal zoom gambar (DaisyUI modal) -->
    <!-- menggunakan modal-toggle input agar konsisten dengan DaisyUI -->
    <input type="checkbox" id="image-modal" class="modal-toggle" />
    <label for="image-modal" class="modal cursor-pointer">
        <label class="modal-box p-0 max-w-5xl max-h-[90vh] w-full relative" for="">
            <div class="absolute top-2 right-2 z-50">
                <!-- tombol tutup: klik akan toggle input -->
                <label for="image-modal" class="btn btn-circle btn-sm bg-white/80 text-gray-800 hover:bg-white">
                    <i class="fa fa-times"></i>
                </label>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden">
                <img id="daisyModalImage" src="" alt="preview" class="w-full h-auto max-h-[85vh] object-contain" />
            </div>
        </label>
    </label>

    <script>
        // Robust modal handler:
        // - Use event delegation so dynamically inserted .open-image buttons work
        // - Query modal elements dynamically to survive partial DOM replacements (Livewire/Turbo)
        // - Support Escape to close and clear image src after close

        (function() {
            const openImageHandler = function(e) {
                const btn = e.target.closest && e.target.closest('.open-image');
                if (!btn) return;
                e.preventDefault();
                const src = btn.getAttribute('data-src');
                if (!src) return;

                const modalToggle = document.getElementById('image-modal');
                const modalImg = document.getElementById('daisyModalImage');
                if (!modalToggle || !modalImg) return;

                modalImg.src = src;
                modalToggle.checked = true;
            };

            // Delegate clicks on document so elements added later still work
            document.addEventListener('click', openImageHandler);

            // Clear image src when modal is closed
            const clearOnClose = function() {
                const modalToggle = document.getElementById('image-modal');
                const modalImg = document.getElementById('daisyModalImage');
                if (!modalToggle || !modalImg) return;
                if (!modalToggle.checked) {
                    setTimeout(() => { modalImg.src = ''; }, 150);
                }
            };

            // Watch for changes on the checkbox using event delegation (in case it's re-rendered)
            document.addEventListener('change', function(e) {
                const target = e.target;
                if (!target) return;
                if (target.id === 'image-modal') {
                    clearOnClose();
                }
            });

            // Escape to close modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modalToggle = document.getElementById('image-modal');
                    if (modalToggle && modalToggle.checked) modalToggle.checked = false;
                }
            });

            // Optional: re-clear img after Livewire/Turbo partial updates
            ['livewire:update', 'livewire:load', 'turbo:load', 'turbolinks:load', 'pjax:complete'].forEach(evt => {
                document.addEventListener(evt, () => {
                    // ensure stale src cleared if modal input is unchecked
                    clearOnClose();
                });
            });
        })();
    </script>
</x-app-layout>
