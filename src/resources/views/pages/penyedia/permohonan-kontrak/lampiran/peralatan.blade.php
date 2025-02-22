<div class="overflow-x-auto pb-5">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-wrench"></i>
        <span>
            PERALATAN UTAMA (Apabila dipersyaratkan)
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30">Nama Peralatan</th>
                <th class="text-center border border-gray-400/30">Merk</th>
                <th class="text-center border border-gray-400/30">Type</th>
                <th class="text-center border border-gray-400/30">Kapasitas</th>
                <th class="text-center border border-gray-400/30">Jumlah</th>
                <th class="text-center border border-gray-400/30">Kondisi</th>
                <th class="text-center border border-gray-400/30">Status Kepemilikan</th>
                <th class="text-center border border-gray-400/30">Keterangan</th>
                <th class="text-center border border-gray-400/30">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="peralatan" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="nama_peralatan">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="merk">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="type">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="kapasitas">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="number" name="jumlah">
                </td>
                <td class="text-center border border-gray-400/30">
                    <select name="kondisi" id="" class="w-full dark:bg-gray-800 rounded">
                        <option value="">Pilih Kondisi</option>
                        <option value="Baik">baik</option>
                        <option value="Sedang">sedang</option>
                        <option value="Rusak">rusak</option>
                    </select>
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="status_kepemilikan">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>

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
