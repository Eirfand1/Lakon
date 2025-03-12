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
                                {{ $kontrak->paketPekerjaan->sekolah->nama_sekolah }}
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

                <input type="hidden" name="realisasi_id" id="realisasiId">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tahun</label>
                        <input type="number" name="tahun" id="tahunRealisasi" placeholder="Tahun" required class="w-full dark:bg-gray-800 rounded mt-2">
                    </div>

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Bulan</label>
                        <select name="bulan" required id="bulanRealisasi"
                        class="w-full dark:bg-gray-800 rounded mt-2">
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
                        <input type="text" name="target" id="targetRealisasi" placeholder="target" required oninput="point(this)"
                        class="w-full dark:bg-gray-800 rounded mt-2">
                    </div>

                    <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Realisasi</label>
                        <input type="text" name="realisasi" id="realisasiRealisasi" placeholder="realisasi" required oninput="point(this)"
                        class="w-full dark:bg-gray-800 rounded mt-2">
                    </div>

                </div>
                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <div class="flex gap-8">
                        <div>
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Gambar 1</label>
                            <input type="file" name="gambar1" onchange="previewImage(event)" accept="image/png, image/jpg, image/jpeg"
                            class="block pt-2 w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-blue-300 dark:hover:file:bg-gray-600">
                        </div>

                        <img id="gambar1" class="mt-2 hidden object-cover rounded-lg" alt="Logo Preview" width="100">
                    </div>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <div class="flex gap-8">
                        <div>
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Gambar 2</label>
                            <input type="file" name="gambar2" onchange="previewImage(event)" accept="image/png, image/jpg, image/jpeg"
                            class="block pt-2 w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-blue-300 dark:hover:file:bg-gray-600">
                        </div>

                        <img id="gambar2" class="mt-2 hidden object-cover rounded-lg" alt="Logo Preview" width="100">
                    </div>
                </div>

                <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                    <div class="flex gap-8">
                        <div>
                            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Gambar 3</label>
                            <input type="file" name="gambar3" onchange="previewImage(event)" accept="image/png, image/jpg, image/jpeg"
                            class="block pt-2 w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-blue-300 dark:hover:file:bg-gray-600">
                        </div>

                        <img id="gambar3" class="mt-2 hidden object-cover rounded-lg" alt="Logo Preview" width="100">
                    </div>
                </div>

                <button class="btn bg-blue-600 btn-primary rounded-md text-white w-full">SIMPAN REALISASI</button>
            </form>

            <div class="border-b border-gray-300 my-4"></div>

            <table class="table mt-4" id="tableRealisasi">
                <thead>
                    <tr>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Tahun</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Bulan</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Target</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Realisasi</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Gambar</th>
                        <th class="p-3 bg-blue-50 dark:bg-gray-700/60 text-blue-900 dark:text-blue-300 border-3 border-gray-400">Aksi</th>
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
                            <td class="p-3 bg-blue-50 w-1 dark:bg-gray-700/60 border-2 border-x-3 border-gray-400">
                                <div class="flex gap-1">
                                    <label class="btn btn-warning btn-sm text-gray-100" onclick="editRealisasi({{ $item }})">
                                        <i class="fa fa-edit"></i>
                                    </label>
                                    <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deleteRealisasi({{ $item->realisasi_id }})">
                                        <i class="fa fa-trash"></i>
                                    </label>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- delete modal --}}
            <input type="checkbox" id="delete-modal" class="modal-toggle" />
            <div class="modal modal-top px-3">
                <div
                    class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
                    <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-action">
                            <x-danger-button type="submit">
                                <i class="fa-solid fa-trash"></i>
                                <span>Hapus</span>
                            </x-danger-button>
                            <label for="delete-modal"
                                class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                        </div>
                    </form>
                </div>
            </div>

    </div>

    <script>
        function point(angka) {
            const input = event.target;
            let value = input.value.replace(/[^0-9]/g, '');

            if (value === "") {
                input.value = "";
                return;
            }

            value = (parseInt(value, 10) / 100).toFixed(2);
            value = value.replace('.', ',');

            if (parseFloat(value.replace(',', '.')) > 100) {
                value = "100,00";
            }

            value = value + "%";
            input.value = value;
        }

        function previewImage(event) {
            const input = event.target;
            const file = input.files[0];
            const name = input.name;
            const logoPreview = document.getElementById(name);



            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    logoPreview.src = e.target.result;
                    logoPreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                logoPreview.src = '';
                logoPreview.classList.add('hidden');
            }
        }


        function editRealisasi(data){
            console.log(data);

            document.getElementById('realisasiId').value = data.realisasi_id;
            document.getElementById('tahunRealisasi').value = data.tahun;
            document.getElementById('targetRealisasi').value = data.target;
            document.getElementById('realisasiRealisasi').value = data.realisasi;

            // form option
            const bulan = document.getElementById('bulanRealisasi');
            Array.from(bulan.options).forEach(option => {
                if (option.value == data.bulan) {
                    option.selected = true;
                }
            });

            // form gambar
            const assetPath = "{{ asset('') }}";
            console.log(assetPath);
            const gambar1 = document.getElementById('gambar1');
            const gambar2 = document.getElementById('gambar2');
            const gambar3 = document.getElementById('gambar3');
            gambar1.src = assetPath + data.gambar1;
            gambar1.classList.remove('hidden');
            gambar2.src = assetPath + data.gambar2;
            gambar2.classList.remove('hidden');
            gambar3.src = assetPath + data.gambar3;
            gambar3.classList.remove('hidden');
        }

        function deleteRealisasi(id){
            document.getElementById('deleteForm').action = `/penyedia/realisasi/${id}`;
        }
    </script>

</x-app-layout>
