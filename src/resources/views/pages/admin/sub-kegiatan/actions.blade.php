<label for="edit-sub-kegiatan" class="btn text-gray-200 btn-sm btn-warning"
    onclick="editDaskum(
        {{ $sub_kegiatan->sub_kegiatan_id }},
        `{{ $sub_kegiatan->no_rekening }}`,
        `{{ $sub_kegiatan->nama_sub_kegiatan }}`,
        `{{ $sub_kegiatan->gabungan }}`,
        `{{ $sub_kegiatan->pendidikan }}`
    )">
    <i class="fa-solid fa-pen-to-square"></i>
</label>
<label for="delete-sub-kegiatan" class="btn text-white btn-sm btn-error"
onclick="setDeleteId({{ $sub_kegiatan->sub_kegiatan_id }})">
    <i class="fa-solid fa-trash"></i>
</label>
