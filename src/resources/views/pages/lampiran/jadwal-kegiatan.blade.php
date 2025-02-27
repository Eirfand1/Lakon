<div class="overflow-x-auto pb-5">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-clock-o"></i>
        <span>
            JADWAL PELAKSANAAN KEGIATAN
        </span>
    </h1>

    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th rowspan="2" class="text-center border border-gray-400/30">Kegiatan</th>
                <th colspan="12" class="text-center border border-gray-400/30">Jadwal Pelasanaan Kegiatan (Bulan)</th>
                <th rowspan="2" class="text-center border border-gray-400/30">Keterangan</th>
                <th rowspan="2" class="text-center border border-gray-400/30">Aksi</th>
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
                <form action="jadwal-kegiatan" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="jadwal_kegiatan_id" id="jadwalKegiatanId">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="kegiatan" id="kegiatan">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_1" class="rounded" id="kegiatanBulan1">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_2" class="rounded" id="kegiatanBulan2">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_3" class="rounded" id="kegiatanBulan3">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_4" class="rounded" id="kegiatanBulan4">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_5" class="rounded" id="kegiatanBulan5">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_6" class="rounded" id="kegiatanBulan6">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_7" class="rounded" id="kegiatanBulan7">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_8" class="rounded" id="kegiatanBulan8">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_9" class="rounded" id="kegiatanBulan9">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_10" class="rounded" id="kegiatanBulan10">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_11" class="rounded" id="kegiatanBulan11">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_12" class="rounded" id="kegiatanBulan12">
                </td>

                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan" id="kegiatanKeterangan">
                </td>
                <td class="text-center border border-gray-400/30">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>
                </form>
            </tr>

                @foreach($jadwalKegiatan as $row)
                    <tr>
                        <td class="border border-gray-400/30">{{ $row->kegiatan }}</td>
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
                        <td class="border border-gray-400/30">{{ $row->keterangan }}</td>
                        <td class="border border-gray-400/30">
                            <div class="flex gap-1">
                                <label class="btn btn-warning btn-sm text-gray-100" onclick="editJadwalKegiatan({{ $row }})">
                                    <i class="fa fa-edit"></i>
                                </label>
                                <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deleteJadwalKegiatan({{ $row->jadwal_kegiatan_id }})">
                                    <i class="fa fa-trash"></i>
                                </label>
                            </div>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>


<script>
    function editJadwalKegiatan(jadwal) {


        document.getElementById('jadwalKegiatanId').value = jadwal.jadwal_kegiatan_id;
        document.getElementById('kegiatan').value = jadwal.kegiatan;
        document.getElementById('kegiatanBulan1').checked = jadwal.bulan_1;
        document.getElementById('kegiatanBulan2').checked = jadwal.bulan_2;
        document.getElementById('kegiatanBulan3').checked = jadwal.bulan_3;
        document.getElementById('kegiatanBulan4').checked = jadwal.bulan_4;
        document.getElementById('kegiatanBulan5').checked = jadwal.bulan_5;
        document.getElementById('kegiatanBulan6').checked = jadwal.bulan_6;
        document.getElementById('kegiatanBulan7').checked = jadwal.bulan_7;
        document.getElementById('kegiatanBulan8').checked = jadwal.bulan_8;
        document.getElementById('kegiatanBulan9').checked = jadwal.bulan_9;
        document.getElementById('kegiatanBulan10').checked = jadwal.bulan_10;
        document.getElementById('kegiatanBulan11').checked = jadwal.bulan_11;
        document.getElementById('kegiatanBulan12').checked = jadwal.bulan_12;
        document.getElementById('kegiatanKeterangan').value = jadwal.keterangan;
    }

    function deleteJadwalKegiatan(id) {
        document.getElementById('deleteForm').action = `jadwal-kegiatan/${id}`;
    }
</script>
