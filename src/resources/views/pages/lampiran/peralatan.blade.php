<div class="overflow-x-auto pb-5" id="peralatan">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-wrench"></i>
        <span>
            PERALATAN UTAMA (Apabila dipersyaratkan)
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Nama Peralatan</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Merk</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Type</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Kapasitas</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Jumlah</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Kondisi</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Status Kepemilikan</th>
                <th class="text-center border border-gray-400/30 min-w-[200px]">Keterangan</th>
                @if ($crud_lampiran)
                    <th class="text-center border border-gray-400/30">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="{{ route('peralatan.store') }}" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="peralatan_id" id="peralatanId">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="nama_peralatan" id="namaPeralatan">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="merk" id="merk">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="type" id="type">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="kapasitas" id="kapasitas">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="jumlah" id="jumlah">
                </td>
                <td class="text-center border border-gray-400/30">
                    <select name="kondisi" class="w-full dark:bg-gray-800 rounded" id="kondisi">
                        <option value="">Pilih Kondisi</option>
                        <option value="Baik">Baik</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </td>
                <td class="text-center border border-gray-400/30">
                    <select name="status_kepemilikan" class="w-full dark:bg-gray-800 rounded" id="statusKepemilikan">
                        <option value="">Pilih Status Kepemilikan</option>
                        <option value="Milik Sendiri">Milik Sendiri</option>
                        <option value="Sewa">Sewa</option>
                    </select>
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan" id="keteranganPeralatan">
                </td>
                @if ($crud_lampiran)
                    <td class="text-center border border-gray-400/30 p-0 ">
                        <button class="btn btn-success px-4"><i class="fa fa-save text-gray-100"></i></button>
                    </td>
                @endif

                </form>
            </tr>

                @foreach($peralatan as $row)
                    <tr>
                        <td class="border border-gray-400/30 ">{{ $row->nama_peralatan }}</td>
                        <td class="border border-gray-400/30">{{ $row->merk }}</td>
                        <td class="border border-gray-400/30">{{ $row->type }}</td>
                        <td class="border border-gray-400/30">{{ $row->kapasitas }}</td>
                        <td class="border border-gray-400/30">{{ $row->jumlah }}</td>
                        <td class="border border-gray-400/30">{{ $row->kondisi }}</td>
                        <td class="border border-gray-400/30">{{ $row->status_kepemilikan }}</td>
                        <td class="border border-gray-400/30">{{ $row->keterangan }}</td>

                        @if ($crud_lampiran)
                            <td class="border border-gray-400/30">
                                <div class="flex gap-1">
                                    <label class="btn btn-warning btn-sm text-gray-100" onclick="editPeralatan({{ $row }})">
                                        <i class="fa fa-edit"></i>
                                    </label>
                                    <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deletePeralatan({{ $row->peralatan_id }})">
                                        <i class="fa fa-trash"></i>
                                    </label>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>

<script>
    function editPeralatan(peralatan) {
        console.log(peralatan.keterangan);

        document.getElementById('peralatanId').value = peralatan.peralatan_id;
        document.getElementById('namaPeralatan').value = peralatan.nama_peralatan;
        document.getElementById('merk').value = peralatan.merk;
        document.getElementById('type').value = peralatan.type;
        document.getElementById('kapasitas').value = peralatan.kapasitas;
        document.getElementById('jumlah').value = peralatan.jumlah;
        document.getElementById('kondisi').value = peralatan.kondisi;
        document.getElementById('statusKepemilikan').value = peralatan.status_kepemilikan;
        document.getElementById('keteranganPeralatan').value = peralatan.keterangan;

    }


    function deletePeralatan(id) {
        const baseUrl = @json(route('peralatan.destroy', ['peralatan' => '__ID__']));
        const actionUrl = baseUrl.replace('__ID__', id);
        document.getElementById('deleteForm').action = actionUrl;
    }
</script>
