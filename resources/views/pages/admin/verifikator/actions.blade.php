<div>
    <label for="edit-modal" class="btn text-gray-200  btn-sm btn-warning"
        onclick="editVerifikator({{ $verifikator->verifikator_id }}, '{{ $verifikator->nip }}', '{{ $verifikator->nama_verifikator }}')">
        <i class="fa-solid fa-pen-to-square"></i>
    </label>
    <label for="delete-modal" class="btn text-white btn-sm btn-error" onclick="setDeleteId({{ $verifikator->verifikator_id }})">
        <i class="fa-solid fa-trash"></i>
    </label>
</div>