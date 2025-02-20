<div class="overflow-x-auto p-5">


    <table class="table border">
        <thead>
            <tr>
                <th rowspan="2" class="text-center border">Kegiatan</th>
                <th colspan="12" class="text-center border">Jadwal Pelasanaan Kegiatan (Bulan)</th>
                <th rowspan="2" class="text-center border">Keterangan</th>
                <th rowspan="2" class="text-center border">Aksi</th>
            </tr>
            <tr>
                <th class="text-center border">1</th>
                <th class="text-center border">2</th>
                <th class="text-center border">3</th>
                <th class="text-center border">4</th>
                <th class="text-center border">5</th>
                <th class="text-center border">6</th>
                <th class="text-center border">7</th>
                <th class="text-center border">8</th>
                <th class="text-center border">9</th>
                <th class="text-center border">10</th>
                <th class="text-center border">11</th>
                <th class="text-center border">12</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="jadwal-kegiatan" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <td class="text-center border">
                    <input class="w-full" type="text" name="kegiatan">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_1" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_2" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_3" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_4" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_5" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_6" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_7" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_8" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_9" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_10" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_11" id="">
                </td>
                <td class="text-center border">
                    <input type="checkbox" name="bulan_12" id="">
                </td>

                <td class="text-center border">
                    <input class="w-full" type="text" name="keterangan">
                </td>
                <td class="text-center border">
                    <button class="btn btn-success"><i class="fa fa-save"></i></button>
                </td>
                </form>
            </tr>

            <tr>
                @foreach($jadwalKegiatan as $row)
                    <tr>
                        <td>{{ $row->kegiatan }}</td>
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
                        <td>{{ $row->keterangan }}</td>
                        <td>
                            <div class="flex gap-1">
                                <button class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-error btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

