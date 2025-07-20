<div class="overflow-x-auto pb-5" id="biayaNonPersonel">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-bars"></i>
        <span>
            Biaya Non Personel
        </span>
    </h1>



        @if (session('error'))
            <div>
                {{ session('error') }}
            </div>
        @endif
    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Jenis Biaya</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Uraian Biaya</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Satuan</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Qty</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Harga</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Keterangan</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Total Harga</th>
                <th class="text-center border border-gray-400/30">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="{{ route('biaya-personel.store') }}" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="biaya_personel_id" id="id_jenis_biaya_personel">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="jenis_biaya" id="jenis_biaya_personel">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="uraian_biaya" id="uraian_biaya_personel">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="satuan" id="satuan_biaya_personel">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="qty" id="qty_biaya_personel">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="harga" id="harga_biaya_personel">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan" id="keterangan_biaya_personel">
                </td>
                <td> </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success px-4"><i class="fa fa-save text-gray-100"></i></button>
                </td>

                </form>
            </tr>

                @foreach($biayaPersonel as $row)
                    <tr>
                        <td class="border border-gray-400/30 ">{{ $row->jenis_biaya }}</td>
                        <td class="border border-gray-400/30 ">{{ $row->uraian_biaya }}</td>
                        <td class="border border-gray-400/30">{{ $row->satuan }}</td>
                        <td class="border border-gray-400/30">{{ $row->qty }}</td>
                        <td class="border border-gray-400/30 text-right">Rp. {{ number_format($row->harga, 0, ',', '.') }}</td>
                        <td class="border border-gray-400/30 text-right">{{ $row->keterangan }}</td>
                        <td class="border border-gray-400/30 text-right">Rp. {{ number_format($row->jumlah, 0, ',', '.') }}</td>

                        <td class="border border-gray-400/30">
                            <div class="flex gap-1">
                                <label class="btn btn-warning btn-sm text-gray-100" onclick='editBiayaPersonel(@json($row))'">
                                    <i class="fa fa-edit"></i>
                                </label>
                                <label class="btn btn-error btn-sm text-gray-100" for="delete-modal"  onclick="deleteBiayaPersonel({{ $row->biaya_personel_id }})">
                                    <i class="fa fa-trash"></i>
                                </label>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="6" class="text-right border border-gray-400/30">Total</td>
                    <td class="text-right border border-gray-400/30">Rp. {{ number_format($totalBiayaPersonel, 0, ',', '.') }}</td>
                    <td class="border border-gray-400/30"></td>
                </tr>
        </tbody>
    </table>
</div>

<script>
    function editBiayaPersonel(row) {
        console.log(row);
        document.getElementById('id_jenis_biaya_personel').value = row.biaya_personel_id;
        document.getElementById('jenis_biaya_personel').value = row.jenis_biaya;
        document.getElementById('uraian_biaya_personel').value = row.uraian_biaya;
        document.getElementById('satuan_biaya_personel').value = row.satuan;
        document.getElementById('qty_biaya_personel').value = row.qty;
        document.getElementById('harga_biaya_personel').value = row.harga;
        document.getElementById('keterangan_biaya_personel').value = row.keterangan;
    }

    function deleteBiayaPersonel(id) {
        const baseUrl = @json(route('biaya-personel.destroy', ['biaya_personel' => '__ID__']));
        const actionUrl = baseUrl.replace('__ID__', id);
        document.getElementById('deleteForm').action = actionUrl;

    }
</script>
