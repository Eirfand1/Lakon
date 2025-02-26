<div class="overflow-x-auto pb-5">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-bars"></i>
        <span>
            RINCIAN BARANG
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30">Jenis</th>
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
                <input type="hidden" name="rincian_belanja_id" id="rincianBelanjaId">
                <input type="hidden" name="uraian" value="-">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="jenis" id="jenis">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="qty" id="qty">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="satuan" id="satuan">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="harga_satuan" id="hargaSatuan">
                </td>
                <td> </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan" id="keteranganBarang">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>

                </form>
            </tr>

                @foreach($rincianBelanja as $row)
                    <tr>
                        <td class="border border-gray-400/30 ">{{ $row->jenis }}</td>
                        <td class="border border-gray-400/30">{{ $row->qty }}</td>
                        <td class="border border-gray-400/30">{{ $row->satuan }}</td>
                        <td class="border border-gray-400/30">{{ $row->harga_satuan }}</td>
                        <td class="border border-gray-400/30">{{ $row->total_harga }}</td>
                        <td class="border border-gray-400/30">{{ $row->keterangan }}</td>

                        <td class="border border-gray-400/30">
                            <div class="flex gap-1">
                                <label class="btn btn-warning btn-sm text-gray-100" onclick="editRincianBelanja({{ $row }})">
                                    <i class="fa fa-edit"></i>
                                </label>
                                <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deleteRincianBelanja({{ $row->rincian_belanja_id }})">
                                    <i class="fa fa-trash"></i>
                                </label>
                            </div>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right border border-gray-400/30">Total</td>
                    <td class="text-right border border-gray-400/30">{{ $totalBiaya }}</td>
                    <td colspan="2" class="border border-gray-400/30"></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right border border-gray-400/30">PPN 11%</td>
                    <td class="text-right border border-gray-400/30">{{ $ppn }}</td>
                    <td colspan="2" class="border border-gray-400/30"></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right border border-gray-400/30">Total Biaya</td>
                    <td class="text-right border border-gray-400/30">{{ $totalBiaya + $ppn }}</td>
                    <td colspan="2" class="border border-gray-400/30"></td>
                </tr>
                <tr>
                    <td colspan="4" class="text-right border border-gray-400/30">Pembulatan</td>
                    <td class="text-right border border-gray-400/30">{{ "gak tau gimana" }}</td>
                    <td colspan="2" class="border border-gray-400/30"></td>
                </tr>
        </tbody>
    </table>
</div>

<script>
    function editRincianBelanja(row) {
        document.getElementById('rincianBelanjaId').value = row.rincian_belanja_id;
        document.getElementById('jenis').value = row.jenis;
        document.getElementById('qty').value = row.qty;
        document.getElementById('satuan').value = row.satuan;
        document.getElementById('hargaSatuan').value = row.harga_satuan;
        document.getElementById('keteranganBarang').value = row.keterangan;
    }

    function deleteRincianBelanja(id) {
            document.getElementById('deleteForm').action = `rincian-belanja/${id}`;
    }
</script>
