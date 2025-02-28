<label for="edit-modal"
    class="btn text-gray-200 btn-sm rounded-md btn-warning"
    onclick="handleEdit('{{ json_encode($sekolah) }}')">
    <i class="fa-solid fa-pen-to-square"></i>
</label>

<label for="delete-sekolah" class="btn rounded-md text-white btn-sm btn-error" onclick="setDeleteId({{ $sekolah->sekolah_id }})">
    <i class="fa-solid fa-trash"></i>
</label>
