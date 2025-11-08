<label for="edit-modal" class="btn rounded-md text-gray-200 btn-sm btn-warning"
 onclick='editHandler(@json($satker))'>
    <i class="fa-solid fa-pen-to-square"></i>
</label>
<label for="delete-modal" class="btn text-white rounded-md btn-sm btn-error"
onclick="setDeleteId({{ $satker->satker_id }})">
    <i class="fa-solid fa-trash"></i>
</label>
