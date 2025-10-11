<div class="overflow-x-auto pb-5" id="rincianBelanja">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-bars"></i>
        <span>
            RINCIAN BARANG
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Jenis</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Qty</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Satuan</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Harga (per Satuan)</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Ongkos Kirim</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Total Harga</th>
                @if ($crud_lampiran)
                    <th class="text-center border border-gray-400/30">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="{{ route('rincian-belanja.store') }}" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="rincian_belanja_id" id="rincianBelanjaId_belanja">
                <input type="hidden" name="uraian" value="-">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="jenis" id="jenis_belanja">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="qty" id="qty_belanja">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="satuan" id="satuan_belanja">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="harga_satuan" id="hargaSatuan_belanja">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="ongkos_kirim" id="ongkos_kirim_belanja">
                </td>
                <td class="text-center border border-gray-400/30"> </td>

                @if ($crud_lampiran)
                    <td class="text-center border border-gray-400/30 p-0">
                        <button class="btn btn-success px-4"><i class="fa fa-save text-gray-100"></i></button>
                    </td>
                @endif

                </form>
            </tr>

                @foreach($rincianBelanja as $row)
                    <tr>
                        <td class="border border-gray-400/30 ">{{ $row->jenis }}</td>
                        <td class="border border-gray-400/30">{{ $row->qty }}</td>
                        <td class="border border-gray-400/30">{{ $row->satuan }}</td>
                        <td class="border border-gray-400/30 text-right">Rp. {{ number_format($row->harga_satuan, 0, ',', '.') }}</td>
                        <td class="border border-gray-400/30 text-right">Rp. {{ number_format($row->ongkos_kirim, 0, ',', '.') }}</td>
                        <td class="border border-gray-400/30 text-right">Rp. {{ number_format($row->total_harga, 0, ',', '.') }}</td>

                        @if ($crud_lampiran)
                            <td class="border border-gray-400/30">
                                <div class="flex gap-1">
                                    <label class="btn btn-warning btn-sm text-gray-100" onclick='editRincianBelanja(@json($row))'>
                                        <i class="fa fa-edit"></i>
                                    </label>
                                    <label class="btn btn-error btn-sm text-gray-100" for="delete-modal"  onclick="deleteRincianBelanja({{ $row->rincian_belanja_id }})">
                                        <i class="fa fa-trash"></i>
                                    </label>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-right border border-gray-400/30">Total</td>
                    <td class="text-right border border-gray-400/30">Rp. {{ number_format($totalBiaya, 0, ',', '.') }}</td>
                    @if ($crud_lampiran)
                        <td class="border border-gray-400/30"></td>
                    @endif
                </tr>
        </tbody>
    </table>
</div>

<script>
    function editRincianBelanja(row) {
        console.log(row);
        document.getElementById('rincianBelanjaId_belanja').value = row.rincian_belanja_id;
        document.getElementById('jenis_belanja').value = row.jenis;
        document.getElementById('qty_belanja').value = row.qty;
        document.getElementById('satuan_belanja').value = row.satuan;
        document.getElementById('hargaSatuan_belanja').value = row.harga_satuan;
        document.getElementById('ongkos_kirim_belanja').value = row.ongkos_kirim;
    }

    function deleteRincianBelanja(id) {
        const baseUrl = @json(route('rincian-belanja.destroy', ['rincian_belanja' => '__ID__']));
        const actionUrl = baseUrl.replace('__ID__', id);
        document.getElementById('deleteForm').action = actionUrl;

    }
</script>
