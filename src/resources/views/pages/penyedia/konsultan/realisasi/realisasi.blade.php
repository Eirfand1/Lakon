<x-app-layout>
    <div class="p-4">
        <h2 class="text-2xl font-bold mb-4">
            <i class="fa fa-calendar-o mr-2 text-blue-500"></i>
            REALISASI KONTRAK
        </h2>
        <span class="font-semibold text-gray-800 dark:text-gray-200 ml-2">
            {{ $kontrak->paketPekerjaan->nama_pekerjaan }}
        </span>
        <div class="border-b border-gray-300 my-4"></div>

        {{-- SERVER-SIDE ERRORS --}}
        @if ($errors->any())
            <div class="mb-4 p-3 rounded bg-red-50 border border-red-200 text-red-700">
                <strong>Ada kesalahan saat validasi:</strong>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM INPUT --}}
        <form id="formRealisasi" action="/penyedia/realisasi/{{ $kontrak->kontrak_id }}"
              method="POST" enctype="multipart/form-data" class="space-y-4" novalidate>
            @csrf
            <input type="hidden" name="realisasi_id" id="realisasiId" value="{{ old('realisasi_id') }}">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold">Nama Sekolah</label>
                    <input type="text" name="sekolah" id="sekolahRealisasi"
                           class="w-full rounded mt-2 py-2 px-3 dark:bg-gray-800"
                           value="{{ old('sekolah') }}">
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold">Tahun</label>
                    <input type="number" name="tahun" id="tahunRealisasi" value="{{ old('tahun', 2025) }}"
                           class="w-full rounded mt-2 py-2 px-3 dark:bg-gray-800">
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold">Bulan</label>
                    <select name="bulan" id="bulanRealisasi"
                            class="w-full rounded mt-2 py-2 px-3 dark:bg-gray-800">
                        <option value="">Pilih Bulan</option>
                        @foreach ([1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',
                            5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',
                            9=>'September',10=>'Oktober',11=>'November',12=>'Desember'] as $k=>$v)
                            <option value="{{ $k }}" {{ (string)old('bulan') === (string)$k ? 'selected' : '' }}>{{ $v }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold">Target</label>
                    <input type="text" name="target" id="targetRealisasi" oninput="point(this)"
                           class="w-full rounded mt-2 py-2 px-3 dark:bg-gray-800"
                           value="{{ old('target') }}">
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <label class="block text-sm font-semibold">Realisasi</label>
                    <input type="text" name="realisasi" id="realisasiRealisasi" oninput="point(this)"
                           class="w-full rounded mt-2 py-2 px-3 dark:bg-gray-800"
                           value="{{ old('realisasi') }}">
                </div>
            </div>

            {{-- Upload gambar (3 wajib) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ([1,2,3,4,5,6] as $i)
                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg relative">
                        <label class="block text-sm font-semibold">Gambar {{ $i }}</label>
                        <input type="file" id="gambar{{ $i }}" name="gambar{{ $i }}"
                               onchange="previewImage(event,'preview{{ $i }}','removeBtn{{ $i }}')"
                               accept="image/*" class="block pt-2 w-full">

                        {{-- preview + close button wrapper --}}
                        <div class="relative mt-2">
                            <img id="preview{{ $i }}"
                                 class="hidden object-cover rounded-lg cursor-pointer max-h-40 w-full border"
                                 alt="preview {{ $i }}">
                            <button type="button" id="removeBtn{{ $i }}"
                                    onclick="removeImage({{ $i }})"
                                    class="hidden absolute top-1 right-1 bg-red-600 text-white text-xs rounded-full p-1 shadow">
                                ✕
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="submit" class="btn bg-blue-600 text-white w-full py-2 rounded-md">
                SIMPAN REALISASI
            </button>
        </form>

        <div class="border-b border-gray-300 my-4"></div>

        {{-- TABLE --}}
        <div class="overflow-x-auto bg-[#071226] p-4 rounded-lg">
            <table class="min-w-full table-fixed text-left border border-white/30" id="tableRealisasi">
                <thead>
                    <tr class="text-sm text-white/90 border border-white/30">
                        <th class="p-3 bg-[#0b2235] text-center border border-white/30">Nama Sekolah</th>
                        <th class="p-3 bg-[#0b2235] text-center border border-white/30">Tahun</th>
                        <th class="p-3 bg-[#0b2235] text-center border border-white/30">Bulan</th>
                        <th class="p-3 bg-[#0b2235] text-center border border-white/30">Target</th>
                        <th class="p-3 bg-[#0b2235] text-center border border-white/30">Realisasi</th>
                        <th class="p-3 bg-[#0b2235] text-center border border-white/30">Gambar</th>
                        <th class="p-3 bg-[#0b2235] text-center border border-white/30">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        // URUTAN: sekolah -> tahun -> bulan -> target (numeric)
                        $data = $kontrak->realisasi->sort(function($a, $b) {
                            $sa = mb_strtolower(trim($a->sekolah ?? ''));
                            $sb = mb_strtolower(trim($b->sekolah ?? ''));
                            if ($sa !== $sb) return $sa <=> $sb;

                            $ta = intval($a->tahun ?? 0);
                            $tb = intval($b->tahun ?? 0);
                            if ($ta !== $tb) return $ta <=> $tb;

                            $ba = intval($a->bulan ?? 0);
                            $bb = intval($b->bulan ?? 0);
                            if ($ba !== $bb) return $ba <=> $bb;

                            $na = floatval(str_replace(',', '.', $a->target ?? '0'));
                            $nb = floatval(str_replace(',', '.', $b->target ?? '0'));
                            return $na <=> $nb;
                        })->values();

                        $lastSekolah = $lastTahun = $lastBulan = null;
                    @endphp

                    @foreach ($data as $item)
                        <tr class="border border-white/30 text-blue-200 align-top hover:bg-gray-700/30 transition">
                            {{-- Sekolah --}}
                            @if ($lastSekolah != $item->sekolah)
                                <td rowspan="{{ $data->where('sekolah',$item->sekolah)->count() }}"
                                    class="p-3 font-semibold text-lg border border-white/30">
                                    {{ $item->sekolah }}
                                </td>
                                @php $lastSekolah=$item->sekolah; $lastTahun=null; $lastBulan=null; @endphp
                            @endif

                            {{-- Tahun --}}
                            @if ($lastTahun != $item->tahun)
                                <td rowspan="{{ $data->where('sekolah',$item->sekolah)->where('tahun',$item->tahun)->count() }}"
                                    class="p-3 text-center border border-white/30">
                                    {{ $item->tahun }}
                                </td>
                                @php $lastTahun=$item->tahun; $lastBulan=null; @endphp
                            @endif

                            {{-- Bulan --}}
                            @if ($lastBulan != $item->bulan)
                                <td rowspan="{{ $data->where('sekolah',$item->sekolah)->where('tahun',$item->tahun)->where('bulan',$item->bulan)->count() }}"
                                    class="p-3 text-center border border-white/30">
                                    {{ [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'][$item->bulan] ?? '-' }}
                                </td>
                                @php $lastBulan=$item->bulan; @endphp
                            @endif

                            {{-- Target --}}
                            <td class="p-3 border border-white/30">
                                @php $targetVal=floatval(str_replace(',','.',$item->target)); @endphp
                                <div class="text-center text-sm mb-1">{{ number_format($targetVal,2,',','.') }}%</div>
                                <div class="w-full h-4 bg-white/10 rounded-full overflow-hidden">
                                    <div class="h-4 rounded-full"
                                         style="width:{{ $targetVal }}%; background:linear-gradient(90deg,#1976d2,#63a4ff)"></div>
                                </div>
                            </td>

                            {{-- Realisasi --}}
                            <td class="p-3 border border-white/30">
                                @php $realVal=floatval(str_replace(',','.',$item->realisasi)); @endphp
                                <div class="text-center text-sm mb-1">{{ number_format($realVal,2,',','.') }}%</div>
                                <div class="w-full h-4 bg-white/10 rounded-full overflow-hidden">
                                    <div class="h-4 rounded-full"
                                         style="width:{{ $realVal }}%; background:linear-gradient(90deg,#2e7d32,#66bb6a)"></div>
                                </div>
                            </td>

                            {{-- Gambar --}}
                            <td class="p-3 border border-white/30">
                                <div class="grid grid-cols-3 gap-2">
                                    @foreach ([1,2,3,4,5,6] as $i)
                                        @php $g = "gambar$i"; @endphp
                                        @if($item->$g)
                                            <img src="{{ asset($item->$g) }}"
                                                 class="object-cover rounded shadow cursor-pointer h-20 w-full border border-white/30"
                                                 onclick="openImage('{{ asset($item->$g) }}')">
                                        @endif
                                    @endforeach
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="p-3 text-center border border-white/30">
                                <div class="flex gap-2 justify-center">
                                    <button type="button" class="btn btn-warning btn-sm text-white"
                                            onclick='editRealisasi(@json($item))'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-error btn-sm text-white"
                                            onclick="deleteRealisasi({{ $item->realisasi_id }})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- MODAL IMAGE --}}
        <div id="imageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/70">
            <div class="max-w-5xl max-h-[90vh] p-4">
                <button id="closeModal" class="text-white mb-2 float-right">Tutup ✕</button>
                <img id="modalImage" class="w-full h-auto rounded-lg object-contain max-h-[85vh]">
            </div>
        </div>
    </div>

    {{-- STYLE: border 3px and invalid highlights --}}
    <style>
        #tableRealisasi,
        #tableRealisasi th,
        #tableRealisasi td {
            border-width: 3px !important;
            border-color: #e5e7eb;
        }
        html.dark #tableRealisasi,
        html.dark #tableRealisasi th,
        html.dark #tableRealisasi td {
            border-color: rgba(255,255,255,0.15);
        }
        #tableRealisasi img { border-width: 3px !important; }

        /* invalid input highlight */
        .input-invalid {
            box-shadow: 0 0 0 3px rgba(220,38,38,0.08);
            border: 2px solid #dc2626 !important;
        }
        .file-invalid {
            outline: 2px solid rgba(220,38,38,0.12);
            border-radius: 6px;
        }

        /* small responsive fix for remove button */
        @media (max-width: 640px) {
            .absolute.top-1.right-1 { top: 0.25rem; right: 0.25rem; }
        }
    </style>

    {{-- SCRIPTS --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // helper: apakah preview image terlihat (untuk edit case)
        function previewVisible(i){
            const img = document.getElementById('preview' + i);
            if(!img) return false;
            return img.src && img.src.trim() !== '' && !img.classList.contains('hidden');
        }

        // clear invalid markers
        function clearAllInvalidMarks(){
            document.querySelectorAll('.input-invalid').forEach(el => el.classList.remove('input-invalid'));
            document.querySelectorAll('.file-invalid').forEach(el => el.classList.remove('file-invalid'));
        }

        // attach auto-clear handlers
        ['sekolahRealisasi','tahunRealisasi','bulanRealisasi','targetRealisasi','realisasiRealisasi'].forEach(id=>{
            const el = document.getElementById(id);
            if(el) { el.addEventListener('input', ()=> el.classList.remove('input-invalid')); el.addEventListener('change', ()=> el.classList.remove('input-invalid')); }
        });
        [1,2,3].forEach(i=>{
            const f = document.getElementById('gambar' + i);
            if(f) f.addEventListener('change', function(){
                this.classList.remove('input-invalid');
                this.parentElement.classList.remove('file-invalid');
            });
        });

        // VALIDASI FORM (client-side): semua 3 gambar wajib
        document.getElementById('formRealisasi').addEventListener('submit', function(e) {
            clearAllInvalidMarks();

            const missing = [];
            const sekolahEl = document.getElementById('sekolahRealisasi');
            const tahunEl = document.getElementById('tahunRealisasi');
            const bulanEl = document.getElementById('bulanRealisasi');
            const targetEl = document.getElementById('targetRealisasi');
            const realEl = document.getElementById('realisasiRealisasi');

            const sekolah = (sekolahEl?.value||'').trim();
            const tahun = (tahunEl?.value||'').toString().trim();
            const bulan = (bulanEl?.value||'').toString().trim();
            const target = (targetEl?.value||'').trim();
            const real = (realEl?.value||'').trim();

            if(!sekolah){ missing.push('Nama Sekolah'); sekolahEl.classList.add('input-invalid'); }
            if(!tahun){ missing.push('Tahun'); tahunEl.classList.add('input-invalid'); }
            if(!bulan){ missing.push('Bulan'); bulanEl.classList.add('input-invalid'); }
            if(!target){ missing.push('Target'); targetEl.classList.add('input-invalid'); }
            if(!real){ missing.push('Realisasi'); realEl.classList.add('input-invalid'); }

            // REQUIRE ALL 3 IMAGES (either file selected or existing preview visible when editing)
            for(let i=1;i<=6;i++){
                const fileInput = document.getElementById('gambar' + i);
                const hasFile = fileInput && fileInput.files && fileInput.files.length > 0;
                const hasPreview = previewVisible(i);
                if(!hasFile && !hasPreview){
                    missing.push('Gambar ' + i);
                    if(fileInput){
                        fileInput.classList.add('input-invalid');
                        fileInput.parentElement.classList.add('file-invalid');
                    }
                }
            }

            if(missing.length > 0){
                e.preventDefault();
                const listHtml = '<ul style="text-align:left;margin:0;padding-left:18px">' + missing.map(m => `<li>${m}</li>`).join('') + '</ul>';
                Swal.fire({
                    icon: 'error',
                    title: 'Form belum lengkap',
                    html: `<p>Silakan lengkapi field berikut sebelum menyimpan:</p> ${listHtml}`,
                    confirmButtonText: 'Tutup'
                }).then(()=> {
                    const first = document.querySelector('.input-invalid, .file-invalid');
                    if(first){ first.scrollIntoView({behavior:'smooth', block:'center'}); }
                });
                return false;
            }

            // allow submit
        });

        // percent formatter
        function point(input){
            let digits = (input.value||'').replace(/[^0-9]/g,'');
            if(!digits){ input.value=''; return; }
            let num = parseInt(digits,10)/100; if(num>100) num=100;
            input.value = num.toFixed(2).replace('.',',') + '%';
        }

        // preview image with remove button
        function previewImage(event, imgId, btnId){
            const file = event.target.files && event.target.files[0];
            const img = document.getElementById(imgId);
            const btn = document.getElementById(btnId);
            const fileInput = event.target;
            // if user re-uploads, clear removed flag
            const removedHidden = document.getElementById('removed_gambar' + imgId.replace('preview',''));
            if(removedHidden) removedHidden.remove();

            if(file){
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                    btn.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                img.src = '';
                img.classList.add('hidden');
                btn.classList.add('hidden');
            }
        }

        // remove image preview and mark removed for server (useful when editing existing)
        function removeImage(i){
            const img = document.getElementById('preview'+i);
            const btn = document.getElementById('removeBtn'+i);
            const file = document.getElementById('gambar'+i);

            // hide preview + btn + reset file input
            img.src = '';
            img.classList.add('hidden');
            btn.classList.add('hidden');
            file.value = ''; // reset input file

            // set hidden removed flag so server knows to delete stored image when editing
            let oldRemoved = document.getElementById('removed_gambar'+i);
            if(!oldRemoved){
                oldRemoved = document.createElement('input');
                oldRemoved.type = 'hidden';
                oldRemoved.name = 'removed_gambar'+i;
                oldRemoved.id = 'removed_gambar'+i;
                document.getElementById('formRealisasi').appendChild(oldRemoved);
            }
            oldRemoved.value = '1';

            // remove invalid markers if present (user action)
            file.classList.remove('input-invalid');
            file.parentElement.classList.remove('file-invalid');
        }

        // populate form for editing an existing realisasi item
        function editRealisasi(d){
            document.getElementById('realisasiId').value = d.realisasi_id ?? '';
            document.getElementById('sekolahRealisasi').value = d.sekolah ?? '';
            document.getElementById('tahunRealisasi').value = d.tahun ?? '';
            document.getElementById('targetRealisasi').value = d.target ?? '';
            document.getElementById('realisasiRealisasi').value = d.realisasi ?? '';

            const bulan = document.getElementById('bulanRealisasi');
            Array.from(bulan.options).forEach(o => { o.selected = (o.value == d.bulan); });

            // clear removed flags if any (editing new item)
            [1,2,3,4,5,6].forEach(i => {
                const oldRemoved = document.getElementById('removed_gambar'+i);
                if(oldRemoved) oldRemoved.remove();
            });

            for(let i=1;i<=6;i++){
                const img = document.getElementById('preview'+i);
                const btn = document.getElementById('removeBtn'+i);
                const fileInput = document.getElementById('gambar'+i);

                // reset file input always on edit (cannot set value programmatically)
                fileInput.value = '';

                if(d['gambar'+i]){
                    img.src = "{{ asset('') }}" + d['gambar'+i].replace(/^\//,'');
                    img.classList.remove('hidden');
                    btn.classList.remove('hidden');
                } else {
                    img.src = '';
                    img.classList.add('hidden');
                    btn.classList.add('hidden');
                }
            }

            clearAllInvalidMarks();
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // delete confirmation
        function deleteRealisasi(id){
            Swal.fire({
                title: 'Yakin hapus data?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/penyedia/realisasi/${id}`;
                    let token = document.createElement('input');
                    token.type = 'hidden'; token.name = '_token'; token.value = "{{ csrf_token() }}";
                    let method = document.createElement('input');
                    method.type = 'hidden'; method.name = '_method'; method.value = 'DELETE';
                    form.appendChild(token); form.appendChild(method);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // image modal helpers
        const modal = document.getElementById('imageModal');
        const modalImg = document.getElementById('modalImage');
        document.getElementById('closeModal')?.addEventListener('click', () => closeImage());
        function openImage(src){
            modalImg.src = src; modal.classList.remove('hidden'); modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }
        function closeImage(){
            modalImg.src = ''; modal.classList.add('hidden'); modal.classList.remove('flex');
            document.body.style.overflow = '';
        }
        modal?.addEventListener('click', e => { if(e.target === modal) closeImage(); });
        document.addEventListener('keydown', e => { if(e.key === 'Escape') closeImage(); });
    </script>
</x-app-layout>
