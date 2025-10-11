<x-app-layout>
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">
            <i class="fa fa-calendar-o mr-2"></i> REALISASI KONTRAK
            <span class="text-red-500"> {{ $kontrak->no_kontrak ?? '' }} </span>
        </h2>

        <div class="border-b border-gray-300 my-4"></div>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse" id="tableRealisasi">
                <thead>
                    <tr class="bg-blue-50 text-blue-900">
                        <th class="border px-2 py-2 text-center w-[160px]">Nama Sekolah</th>
                        <th class="border px-2 py-2 text-center w-[80px]">Tahun</th>
                        <th class="border px-2 py-2 text-center w-[100px]">Bulan</th>
                        <th class="border px-2 py-2 text-center w-[120px]">Target</th>
                        <th class="border px-2 py-2 text-center w-[120px]">Realisasi</th>
                        <th class="border px-2 py-2 text-center">Gambar</th>
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

                                    <tr class="even:bg-gray-50 align-top">
                                        @if (!$printedSchool)
                                            <td rowspan="{{ $schoolRowCount }}" class="border px-2 py-2 font-semibold align-top w-[160px]">
                                                {{ $sekolah }}
                                            </td>
                                            @php $printedSchool = true; @endphp
                                        @endif

                                        @if (!$printedYear)
                                            <td rowspan="{{ $yearRowCount }}" class="border px-2 py-2 text-center align-top w-[80px]">
                                                {{ $tahun }}
                                            </td>
                                            @php $printedYear = true; @endphp
                                        @endif

                                        @if (!$printedMonth)
                                            <td rowspan="{{ $monthRowCount }}" class="border px-2 py-2 text-center align-top w-[100px]">
                                                {{ $bulanText }}
                                            </td>
                                            @php $printedMonth = true; @endphp
                                        @endif

                                        {{-- Target --}}
                                        <td class="border px-2 py-2 text-right align-top w-[120px]">
                                            <div class="text-center text-gray-400 text-xs mb-1">{{ $target_label }}</div>
                                            <div style="width: {{ $pillWidth }}px; height:14px; background:#e5e7eb; border-radius:999px; overflow:hidden; margin:0 auto; box-shadow: inset 0 1px 2px rgba(0,0,0,0.2);">
                                                <div style="
                                                    height:100%;
                                                    width: {{ $target_bar }}%;
                                                    background: linear-gradient(90deg, #4facfe 0%, #00f2fe 100%);
                                                    box-shadow: 0 0 6px rgba(79,172,254,0.65);
                                                    border-radius: 999px;
                                                "></div>
                                            </div>
                                        </td>

                                        {{-- Realisasi --}}
                                        <td class="border px-2 py-2 text-right align-top w-[120px]">
                                            <div class="text-center text-gray-400 text-xs mb-1">{{ $realisasi_label }}</div>
                                            <div style="width: {{ $pillWidth }}px; height:14px; background:#e5e7eb; border-radius:999px; overflow:hidden; margin:0 auto; box-shadow: inset 0 1px 2px rgba(0,0,0,0.2);">
                                                <div style="
                                                    height:100%;
                                                    width: {{ $realisasi_bar }}%;
                                                    background: linear-gradient(90deg, #43e97b 0%, #38f9d7 100%);
                                                    box-shadow: 0 0 6px rgba(67,233,123,0.65);
                                                    border-radius: 999px;
                                                "></div>
                                            </div>
                                        </td>

                                        {{-- Gambar --}}
                                        <td class="border px-2 py-2 align-top">
                                            <div class="grid grid-cols-3 gap-2">
                                                @if(!empty($r->gambar1))
                                                    <button type="button" class="open-image" data-src="{{ asset($r->gambar1) }}">
                                                        <img src="{{ asset($r->gambar1) }}" loading="lazy" class="w-full h-24 object-cover border rounded">
                                                    </button>
                                                @endif
                                                @if(!empty($r->gambar2))
                                                    <button type="button" class="open-image" data-src="{{ asset($r->gambar2) }}">
                                                        <img src="{{ asset($r->gambar2) }}" loading="lazy" class="w-full h-24 object-cover border rounded">
                                                    </button>
                                                @endif
                                                @if(!empty($r->gambar3))
                                                    <button type="button" class="open-image" data-src="{{ asset($r->gambar3) }}">
                                                        <img src="{{ asset($r->gambar3) }}" loading="lazy" class="w-full h-24 object-cover border rounded">
                                                    </button>
                                                @endif
                                                @if(empty($r->gambar1) && empty($r->gambar2) && empty($r->gambar3))
                                                    <div class="col-span-3 text-center text-sm text-gray-500">-</div>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            @endforeach
                        @endforeach
                    @empty
                        <tr>
                            <td colspan="6" class="text-center p-4 text-gray-500">Belum ada data realisasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal zoom gambar -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70">
        <div class="max-w-5xl max-h-[90vh] p-4">
            <button id="closeModal" class="text-white mb-2 float-right">Tutup ✕</button>
            <img id="modalImage" src="" alt="preview" class="w-full h-auto rounded shadow-lg" />
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');
            const closeBtn = document.getElementById('closeModal');

            document.querySelectorAll('.open-image').forEach(btn => {
                btn.addEventListener('click', function() {
                    const src = this.getAttribute('data-src');
                    if (!src) return;
                    modalImg.src = src;
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                });
            });

            closeBtn.addEventListener('click', function() {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                modalImg.src = '';
            });

            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    modalImg.src = '';
                }
            });

            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    modal.classList.add('hidden');
                    modal.classList.remove('flex');
                    modalImg.src = '';
                }
            });
        });
    </script>
</x-app-layout>
