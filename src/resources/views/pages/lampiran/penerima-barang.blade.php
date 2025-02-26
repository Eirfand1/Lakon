<div class="overflow-x-auto pb-5">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-bars"></i>
        <span>
            PENERIMA BARANG
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30">No.</th>
                <th class="text-center border border-gray-400/30">Keterangan Penerima Barang</th>
                <th class="text-center border border-gray-400/30">Alamat Penerima Barang</th>
                <th class="text-center border border-gray-400/30">Qty</th>
                <th class="text-center border border-gray-400/30">Satuan</th>
                <th class="text-center border border-gray-400/30">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="penerima-barang" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="penerima_id" id="penerimaId">
                <td class="text-center border border-gray-400/30"></td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan_penerima" id="keteranganPenerima">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="alamat" id="alamatPenerima">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="qty" id="qtyPenerima">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="satuan" id="satuanPenerima">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>

                </form>
            </tr>

                @foreach($penerima as $row)
                    <tr>
                        <td class="border border-gray-400/30">{{ $loop->iteration }}</td>
                        <td class="border border-gray-400/30">{{ $row->keterangan_penerima }}</td>
                        <td class="border border-gray-400/30">{{ $row->alamat }}</td>
                        <td class="border border-gray-400/30">{{ $row->qty }}</td>
                        <td class="border border-gray-400/30">{{ $row->satuan }}</td>

                        <td class="border border-gray-400/30">
                            <div class="flex gap-1">
                                <label class="btn btn-warning btn-sm text-gray-100" onclick="editPenerima({{ $row }})">
                                    <i class="fa fa-edit"></i>
                                </label>
                                <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deletePenerima({{ $row->penerima_id }})">
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

    function editPenerima(row) {
        document.getElementById('penerimaId').value = row.penerima_id;
        document.getElementById('keteranganPenerima').value = row.keterangan_penerima;
        document.getElementById('alamatPenerima').value = row.alamat;
        document.getElementById('qtyPenerima').value = row.qty;
        document.getElementById('satuanPenerima').value = row.satuan;
    }

    function deletePenerima(id) {
            document.getElementById('deleteForm').action = `penerima-barang/${id}`;
    }
</script>
