<label for="edit-modal" class="btn text-gray-200 btn-sm btn-warning"
 onclick="editPpkom({{ $ppkom->ppkom_id }}, `{{ $ppkom->nip }}`, `{{ $ppkom->nama }}`, 
`{{ $ppkom->pangkat }}`, `{{ $ppkom->jabatan }}`, `{{ $ppkom->alamat }}`, 
`{{ $ppkom->no_telp }}`, `{{ $ppkom->email }}`)">
    <i class="fa-solid fa-pen-to-square"></i>
</label>
<label for="delete-modal" class="btn text-white btn-sm btn-error" 
onclick="setDeleteId({{ $ppkom->ppkom_id }})">
    <i class="fa-solid fa-trash"></i>
</label>