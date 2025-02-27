<div class="overflow-x-auto pb-5">
    <h1 class="text-lg dark:text-gray-300 flex gap-2 items-center font-semibold mb-4">
        <i class="fas fa-list-ul fa-lg"></i>
        <span>
            RUANG LINGKUP
        </span>
    </h1>


    <table class="table">
        <thead class="text-gray-600  dark:text-gray-300">
            <tr>
                <th class="text-center border border-gray-400/30">Ruang Lingkup</th>
                <th class="text-center border border-gray-400/30 w-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <form action="ruang-lingkup" method="POST">
                    @csrf
                <input type="hidden" name="kontrak_id" value="{{ $kontrak->kontrak_id }}">
                <input type="hidden" name="ruang_lingkup_id" id="ruangLingkupId">
                <td class="text-center border border-gray-400/30">
                    <input class="w-full dark:bg-gray-800 rounded" id="ruangLingkup" type="text" name="ruang_lingkup">
                </td>
                <td class="text-center border border-gray-400/30 p-0">
                    <button class="btn btn-success"><i class="fa fa-save text-gray-100"></i></button>
                </td>

                </form>
            </tr>

                @foreach($ruangLingkup as $row)
                    <tr>
                        <td class="border border-gray-400/30 ">{{ $row->ruang_lingkup }}</td>

                        <td class="border border-gray-400/30">
                            <div class="flex gap-1">
                                <label class="btn btn-warning btn-sm text-gray-100" onclick="editRuangLingkup({{ $row }})">
                                    <i class="fa fa-edit"></i>
                                </label>
                                <label class="btn btn-error btn-sm text-gray-100" for="delete-modal" onclick="deleteRuangLingkup({{ $row->ruang_lingkup_id }})">
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
    function editRuangLingkup(row) {
        document.getElementById('ruangLingkupId').value = row.ruang_lingkup_id;
        document.getElementById('ruangLingkup').value = row.ruang_lingkup;
    }

    function deleteRuangLingkup(id) {
        document.getElementById('deleteForm').action = `ruang-lingkup/${id}`;
    }
</script>
