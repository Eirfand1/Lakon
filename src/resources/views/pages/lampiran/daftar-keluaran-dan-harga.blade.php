<div class="overflow-x-auto pb-5" id="daftarKeluaranDanHarga">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-file-o"></i>
        <span>
            DAFTAR KELUARAN DAN HARGA
        </span>
    </h1>

    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30">Keluaran</th>
                <th class="text-center border border-gray-400/30">Satuan</th>
                <th class="text-center border border-gray-400/30">Total Harga</th>
                <th class="text-center border border-gray-400/30 w-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="{{ route('daftar-keluaran-dan-harga.store') }}" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="daftar_keluaran_dan_harga_id" id="daftarKeluaranDanHargaId">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keluaran" id="keluaranDaftarKeluaranDanHarga">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="satuan" id="satuanDaftarKeluaranDanHarga">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" min="0" name="total_harga" id="totalHargaDaftarKeluaranDanHarga">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>

                </form>
            </tr>

                @foreach($daftarKeluaranDanHarga as $row)
                    <tr>
                         <td class="border border-gray-400/30">{{ $row->keluaran }}</td>
                        <td class="border border-gray-400/30">{{ $row->satuan }}</td>
                        <td class="border border-gray-400/30">{{ $row->total_harga }}</td>

                        <td class="border border-gray-400/30">
                            <div class="flex gap-1">
                                <label class="btn btn-warning btn-sm text-gray-100" onclick="editDaftarKeluaranDanHarga({{ $row }})">
                                    <i class="fa fa-edit"></i>
                                </label>
                                <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deleteDaftarKeluaranDanHarga({{ $row->daftar_keluaran_dan_harga_id }})">
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

    function editDaftarKeluaranDanHarga(row) {
        document.getElementById('daftarKeluaranDanHargaId').value = row.daftar_keluaran_dan_harga_id;
        document.getElementById('keluaranDaftarKeluaranDanHarga').value = row.keluaran;
        document.getElementById('satuanDaftarKeluaranDanHarga').value = row.satuan;
        document.getElementById('totalHargaDaftarKeluaranDanHarga').value = row.total_harga;
    }

    function deleteDaftarKeluaranDanHarga(id) {
        const baseUrl = @json(route('daftar-keluaran-dan-harga.destroy', ['daftar_keluaran_dan_harga' => '__ID__']));
        const actionUrl = baseUrl.replace('__ID__', id);
        document.getElementById('deleteForm').action = actionUrl;
    }
</script>
