<div class="overflow-x-auto p-5">
    <table class="table border">
        <thead>
            <tr>
                <th rowspan="2" class="text-center border">Nama</th>
                <th rowspan="2" class="text-center border">Posisi</th>
                <th rowspan="2" class="text-center border">Status Tenaga</th>
                <th colspan="12" class="text-center border">Jadwal Pelasanaan Kegiatan (Bulan)</th>
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
                <form action="" method="POST">
                <td class="text-center border"><input class="w-full" type="text"></td>
                <td class="text-center border"><input class="w-full" type="text"></td>
                <td class="text-center border"><input class="w-full" type="text"></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><input type="checkbox" name="" id=""></td>
                <td class="text-center border"><button class="btn btn-success">S</button></td>
                </form>
            </tr>

            <tr>
                @foreach($tim as $row)
                    <tr>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->posisi }}</td>
                        <td>{{ $row->status_tenaga }}</td>
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
                        <td>aksi</td>
                    </tr>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

