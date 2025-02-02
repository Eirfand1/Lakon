<a href="/admin/sekolah/edit-sekolah/{{ $sekolah->sekolah_id }}" for="edit-sekolah" class="btn text-gray-200 btn-sm btn-warning">
    <i class="fa-solid fa-pen-to-square"></i>
</a>
<label for="delete-sekolah" class="btn text-white btn-sm btn-error"
onclick="setDeleteId({{ $sekolah->sekolah_id }})">
    <i class="fa-solid fa-trash"></i>
</label>
