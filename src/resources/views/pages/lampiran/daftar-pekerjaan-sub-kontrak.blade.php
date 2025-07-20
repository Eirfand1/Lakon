<div class="overflow-x-auto pb-5" id="daftarPekerjaanSubKontrak">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fa fa-file-o"></i>
        <span>
            DAFTAR PEKERJAAN SUB KONTRAK
        </span>
    </h1>

    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30">Bagian Pekerjaan yang disubkonntrakkan</th>
                <th class="text-center border border-gray-400/30">Nama Sub Penyedia</th>
                <th class="text-center border border-gray-400/30">Alamat Sub Penyedia</th>
                <th class="text-center border border-gray-400/30">Kualifikasi Sub Penyedia</th>
                <th class="text-center border border-gray-400/30">keterangan</th>
                @if ($crud_lampiran)
                    <th class="text-center border border-gray-400/30 w-1">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="{{ route('daftar-pekerjaan-sub-kontrak.store') }}" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="daftar_pekerjaan_sub_kontrak_id" id="bagianPekerjaanSubKontrakId">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="bagian_pekerjaan" id="bagianPekerjaanDaftarSubKontrak">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="nama_sub_penyedia" id="namaSubPenyediaDaftarSubKontrak">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="alamat_sub_penyedia" id="alamatSubPenyediaDaftarSubKontrak">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="kualifikasi_sub_penyedia" id="kualifikasiSubPenyediaDaftarSubKontrak">
                </td>
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" type="text" name="keterangan" id="keteranganDaftarSubKontrak">
                </td>
                @if ($crud_lampiran)
                    <td class="text-center border border-gray-400/30 p-0">
                        <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                    </td>
                @endif

                </form>
            </tr>

                @foreach($daftarPekerjaanSubKontrak as $row)
                    <tr>
                         <td class="border border-gray-400/30">{{ $row->bagian_pekerjaan }}</td>
                        <td class="border border-gray-400/30">{{ $row->nama_sub_penyedia }}</td>
                        <td class="border border-gray-400/30">{{ $row->alamat_sub_penyedia }}</td>
                        <td class="border border-gray-400/30">{{ $row->kualifikasi_sub_penyedia }}</td>
                        <td class="border border-gray-400/30">{{ $row->keterangan }}</td>

                        @if ($crud_lampiran)
                            <td class="border border-gray-400/30">
                                <div class="flex gap-1">
                                    <label class="btn btn-warning btn-sm text-gray-100" onclick="editDaftarPekerjaanSubKontrak({{ $row }})">
                                        <i class="fa fa-edit"></i>
                                    </label>
                                    <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deleteDaftarPekerjaanSubKontrak({{ $row->daftar_pekerjaan_sub_kontrak_id }})">
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

    function editDaftarPekerjaanSubKontrak(row) {
        document.getElementById('bagianPekerjaanSubKontrakId').value = row.daftar_pekerjaan_sub_kontrak_id;
        document.getElementById('bagianPekerjaanDaftarSubKontrak').value = row.bagian_pekerjaan;
        document.getElementById('namaSubPenyediaDaftarSubKontrak').value = row.nama_sub_penyedia;
        document.getElementById('alamatSubPenyediaDaftarSubKontrak').value = row.alamat_sub_penyedia;
        document.getElementById('kualifikasiSubPenyediaDaftarSubKontrak').value = row.kualifikasi_sub_penyedia;
        document.getElementById('keteranganDaftarSubKontrak').value = row.keterangan;
    }

    function deleteDaftarPekerjaanSubKontrak(id) {
        const baseUrl = @json(route('daftar-pekerjaan-sub-kontrak.destroy', ['daftar_pekerjaan_sub_kontrak' => '__ID__']));
        const actionUrl = baseUrl.replace('__ID__', id);
        document.getElementById('deleteForm').action = actionUrl;
    }
</script>
