<div class="overflow-x-auto pb-5" id="hakDanKewajiban">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-file-o"></i>
        <span>
            HAK DAN KEWAJIBAN PENYEDIA
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30 w-1">No.</th>
                <th class="text-center border border-gray-400/30">Keterangan Hak dan Kewajiban Pengguna</th>
                <th class="text-center border border-gray-400/30 w-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="keterangan" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="keterangan_id" id="keteranganIdHakDanKewajiban">
                <input type="hidden" name="jenis" value="hak dan kewajiban">
                <td class="text-center border border-gray-400/30"></td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan" id="keteranganHakDanKewajiban">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>

                </form>
            </tr>

                @foreach($keterangan_hak_dan_kewajiban as $row)
                    <tr>
                        <td class="border border-gray-400/30">{{ $loop->iteration }}</td>
                        <td class="border border-gray-400/30">{{ $row->keterangan }}</td>

                        <td class="border border-gray-400/30">
                            <div class="flex gap-1">
                                <label class="btn btn-warning btn-sm text-gray-100" onclick="editKeteranganHakDanKewajiban({{ $row }})">
                                    <i class="fa fa-edit"></i>
                                </label>
                                <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deleteKeteranganHakDanKewajiban({{ $row->keterangan_id }})">
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

    function editKeteranganHakDanKewajiban(row) {
        document.getElementById('keteranganIdHakDanKewajiban').value = row.keterangan_id;
        document.getElementById('keteranganHakDanKewajiban').value = row.keterangan;
    }

    function deleteKeteranganHakDanKewajiban(id) {
            document.getElementById('deleteForm').action = `keterangan/${id}`;
    }
</script>
