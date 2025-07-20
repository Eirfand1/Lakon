<div class="overflow-x-auto pb-5" id="tim">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-user"></i>
        <span>
            KOMPOSISI TIM DAN PENUGASAN
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th rowspan="2" class="text-center border border-gray-400/30 min-w-[200px]">Nama</th>
                <th rowspan="2" class="text-center border border-gray-400/30 min-w-[200px]">Posisi</th>
                <th rowspan="2" class="text-center border border-gray-400/30 min-w-[200px]">Status Tenaga</th>
                <th rowspan="2" class="text-center border border-gray-400/30 min-w-[200px]">Pendidikan</th>
                <th rowspan="2" class="text-center border border-gray-400/30 min-w-[200px]">Pengalaman (tahun)</th>
                <th rowspan="2" class="text-center border border-gray-400/30 min-w-[200px]">Sertifikasi</th>
                <th rowspan="2" class="text-center border border-gray-400/30 min-w-[200px]">Keterangan</th>
                <th colspan="12" class="text-center border border-gray-400/30">Jadwal Pelasanaan Kegiatan (Bulan)</th>
                @if ($crud_lampiran)
                    <th rowspan="2" class="text-center border border-gray-400/30">Aksi</th>
                @endif
            </tr>
            <tr>
                <th class="text-center border border-gray-400/30">1</th>
                <th class="text-center border border-gray-400/30">2</th>
                <th class="text-center border border-gray-400/30">3</th>
                <th class="text-center border border-gray-400/30">4</th>
                <th class="text-center border border-gray-400/30">5</th>
                <th class="text-center border border-gray-400/30">6</th>
                <th class="text-center border border-gray-400/30">7</th>
                <th class="text-center border border-gray-400/30">8</th>
                <th class="text-center border border-gray-400/30">9</th>
                <th class="text-center border border-gray-400/30">10</th>
                <th class="text-center border border-gray-400/30">11</th>
                <th class="text-center border border-gray-400/30">12</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="{{ route('tim.store') }}" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="tim_id" id="timId">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="nama" id="nama">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="posisi" id="posisi">
                </td>
                <td class="text-center border border-gray-400/30">
                    <select class="w-full dark:bg-gray-800 rounded" name="status_tenaga" id="statusTenaga">
                        <option value="">Pilih Status Tenaga</option>
                        <option value="Tenaga Ahli">Tenaga Ahli</option>
                        <option value="Tenaga Penunjang">Tenaga Penunjang</option>
                        <option value="Tenaga Teknis">Tenaga Teknis</option>
                    </select>
                </td>
                <td class="text-center border border-gray-400/30">
                    <select class="w-full dark:bg-gray-800 rounded" name="pendidikan" id="pendidikan">
                        <option value="">Pilih Pendidikan</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4/S1">D4/S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="pengalaman" id="pengalaman">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="sertifikasi" id="sertifikasi">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan" id="keterangan">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_1" class="rounded" id="timBulan1">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_2" class="rounded" id="timBulan2">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_3" class="rounded" id="timBulan3">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_4" class="rounded" id="timBulan4">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_5" class="rounded" id="timBulan5">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_6" class="rounded" id="timBulan6">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_7" class="rounded" id="timBulan7">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_8" class="rounded" id="timBulan8">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_9" class="rounded" id="timBulan9">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_10" class="rounded" id="timBulan10">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_11" class=" rounded" id="timBulan11">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_12" class="rounded" id="timBulan12">
                </td>
                @if ($crud_lampiran)
                    <td class="text-center border border-gray-400/30 p-0">
                        <button class="btn btn-success px-4"><i class="fa fa-save text-gray-100"></i></button>
                    </td>
                @endif
                </form>
            </tr>

                @foreach($tim as $row)
                    <tr>
                        <td class="border border-gray-400/30 ">{{ $row->nama }}</td>
                        <td class="border border-gray-400/30">{{ $row->posisi }}</td>
                        <td class="border border-gray-400/30">{{ $row->status_tenaga }}</td>
                        <td class="border border-gray-400/30">{{ $row->pendidikan }}</td>
                        <td class="border border-gray-400/30">{{ $row->pengalaman }}</td>
                        <td class="border border-gray-400/30">{{ $row->sertifikasi }}</td>
                        <td class="border border-gray-400/30">{{ $row->keterangan }}</td>
                        <td class="@if ($row->bulan_1) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_2) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_3) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_4) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_5) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_6) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_7) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_8) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_9) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_10) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_11) bg-green-400 @else bg-red-400 @endif"></td>
                        <td class="@if ($row->bulan_12) bg-green-400 @else bg-red-400 @endif"></td>
                        @if ($crud_lampiran)
                            <td class="border border-gray-400/30">
                                <div class="flex gap-1">
                                    <label class="btn btn-warning btn-sm text-gray-100" onclick="editTim({{ $row }})">
                                        <i class="fa fa-edit"></i>
                                    </label>
                                    <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deleteTim({{ $row->tim_id }})">
                                        <i class="fa fa-trash"></i>
                                    </label>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>

<script>
    function editTim(data) {
        document.getElementById('timId').value = data.tim_id;
        document.getElementById('nama').value = data.nama;
        document.getElementById('posisi').value = data.posisi;
        document.getElementById('statusTenaga').value = data.status_tenaga;
        document.getElementById('pendidikan').value = data.pendidikan;
        document.getElementById('pengalaman').value = data.pengalaman;
        document.getElementById('sertifikasi').value = data.sertifikasi;
        document.getElementById('keterangan').value = data.keterangan;
        document.getElementById('timBulan1').checked = data.bulan_1;
        document.getElementById('timBulan2').checked = data.bulan_2;
        document.getElementById('timBulan3').checked = data.bulan_3;
        document.getElementById('timBulan4').checked = data.bulan_4;
        document.getElementById('timBulan5').checked = data.bulan_5;
        document.getElementById('timBulan6').checked = data.bulan_6;
        document.getElementById('timBulan7').checked = data.bulan_7;
        document.getElementById('timBulan8').checked = data.bulan_8;
        document.getElementById('timBulan9').checked = data.bulan_9;
        document.getElementById('timBulan10').checked = data.bulan_10;
        document.getElementById('timBulan11').checked = data.bulan_11;
        document.getElementById('timBulan12').checked = data.bulan_12;
    }


    function deleteTim(id) {
        const baseUrl = @json(route('tim.destroy', ['tim' => '__ID__']));
        const actionUrl = baseUrl.replace('__ID__', id);
        document.getElementById('deleteForm').action = actionUrl;
    }

</script>
