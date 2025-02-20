<div class="overflow-x-auto pb-5">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-user"></i>
        <span>
            KOMPOSISI TIM DAN PENUGASAN
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th rowspan="2" class="text-center border border-gray-400/30">Nama</th>
                <th rowspan="2" class="text-center border border-gray-400/30">Posisi</th>
                <th rowspan="2" class="text-center border border-gray-400/30">Status Tenaga</th>
                <th colspan="12" class="text-center border border-gray-400/30">Jadwal Pelasanaan Kegiatan (Bulan)</th>
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
                <form action="tim" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="nama">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="posisi">
                </td>
                <td class="text-center border border-gray-400/30">
                    <select class="w-full dark:bg-gray-800 rounded" name="status_tenaga" id="">
                        <option value="">Pilih Status Tenaga</option>
                        <option value="Tenaga Ahli">Tenaga Ahli</option>
                        <option value="Tenaga Penunjang">Tenaga Penunjang</option>
                    </select>
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_1" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_2" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_3" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_4" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_5" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_6" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_7" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_8" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_9" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_10" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_11" id="" class=" rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <input type="checkbox" name="bulan_12" id="" class="rounded">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>
                </form>
            </tr>

                @foreach($tim as $row)
                    <tr>
                        <td class="border border-gray-400/30 ">{{ $row->nama }}</td>
                        <td class="border border-gray-400/30">{{ $row->posisi }}</td>
                        <td class="border border-gray-400/30">{{ $row->status_tenaga }}</td>
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
                        <td class="border border-gray-400/30">
                            <div class="flex gap-1">
                                <button class="btn btn-warning btn-sm text-gray-100">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button class="btn btn-error btn-sm text-gray-100">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>

