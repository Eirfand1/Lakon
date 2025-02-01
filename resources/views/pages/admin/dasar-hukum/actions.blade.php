<label for="edit-daskum" class="btn text-gray-200 btn-sm btn-warning"
    onclick="editDaskum({{ $daskum->daskum_id }}, `{{ $daskum->dasar_hukum }}`)">
    <i class="fa-solid fa-pen-to-square"></i>
</label>
<label for="delete-daskum" class="btn text-white btn-sm btn-error"
onclick="setDeleteId({{ $daskum->daskum_id }})">
    <i class="fa-solid fa-trash"></i>
</label>
