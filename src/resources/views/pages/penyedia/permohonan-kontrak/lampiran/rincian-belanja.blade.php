<div class="overflow-x-auto pb-5">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-bars"></i>
        <span>
            RINCIAN BELANJA
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30">Jenis</th>
                <th class="text-center border border-gray-400/30">Uraian</th>
                <th class="text-center border border-gray-400/30">Qty</th>
                <th class="text-center border border-gray-400/30">Satuan</th>
                <th class="text-center border border-gray-400/30">Harga (per Satuan)</th>
                <th class="text-center border border-gray-400/30">Total Harga</th>
                <th class="text-center border border-gray-400/30">Keterangan</th>
                <th class="text-center border border-gray-400/30">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="rincian-belanja" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="jenis">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="uraian">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="qty">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="satuan">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="harga_satuan">
                </td>
                <td> </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>

                </form>
            </tr>

                @foreach($rincianBelanja as $row)
                    <tr>
                        <td class="border border-gray-400/30 ">{{ $row->jenis }}</td>
                        <td class="border border-gray-400/30">{{ $row->uraian}}</td>
                        <td class="border border-gray-400/30">{{ $row->qty }}</td>
                        <td class="border border-gray-400/30">{{ $row->satuan }}</td>
                        <td class="border border-gray-400/30">{{ $row->harga_satuan }}</td>
                        <td class="border border-gray-400/30">{{ $row->total_harga }}</td>
                        <td class="border border-gray-400/30">{{ $row->keterangan }}</td>

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
                <tr>
                    <td colspan="5" class="text-right border border-gray-400/30">Total</td>
                    <td class="text-right border border-gray-400/30">{{ $totalBiaya }}</td>
                    <td colspan="2" class="border border-gray-400/30"></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right border border-gray-400/30">ppn</td>
                    <td class="text-right border border-gray-400/30">{{ $ppn }}</td>
                    <td colspan="2" class="border border-gray-400/30"></td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right border border-gray-400/30">Total Biaya</td>
                    <td class="text-right border border-gray-400/30">{{ $totalBiaya + $ppn }}</td>
                    <td colspan="2" class="border border-gray-400/30"></td>
                </tr>
        </tbody>
    </table>

</div>

.
