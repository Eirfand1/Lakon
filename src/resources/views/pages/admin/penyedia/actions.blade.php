<div>
    <label for="edit-modal" class="btn rounded-md text-gray-200 btn-sm btn-warning" onclick="editPenyedia(
                                       {{ $p->penyedia_id }},
                                        `{{ $p->NIK }}`,
                                        `{{ $p->nama_pemilik }}`,
                                        `{{ $p->alamat_pemilik ?? '' }}`,
                                        `{{ $p->nama_perusahaan_lengkap ?? '' }}`,
                                        `{{ $p->nama_perusahaan_singkat ?? '' }}`,
                                        `{{ $p->akta_notaris_no ?? '' }}`,
                                        `{{ $p->akta_notaris_nama ?? '' }}`,
                                        `{{ $p->akta_notaris_tanggal ?? '' }}`,
                                        `{{ $p->alamat_perusahaan ?? '' }}`,
                                        '{{ $p->kontak_hp ?? '' }}',
                                        '{{ $p->kontak_email ?? '' }}',
                                        '{{ $p->rekening_norek ?? '' }}',
                                        '{{ $p->rekening_nama ?? '' }}',
                                        '{{ $p->rekening_bank ?? '' }}',
                                        '{{ $p->npwp_perusahaan ?? '' }}',
                                        '{{ $p->logo_perusahaan ?? '' }}',
                                        '{{ $p->status ?? '' }}',
                                        '{{ $p->user->name ?? ''}}'

                                    )">
        <i class="fa-solid fa-pen-to-square"></i>
    </label>

    <label for="delete-modal" class="btn rounded-md text-white btn-sm btn-error" onclick="setDeleteId({{ $p->penyedia_id }})">
        <i class="fa-solid fa-trash"></i>
    </label>
</div>