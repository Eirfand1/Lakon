<!-- livewire/ppkom-action-buttons.blade.php -->
<div class="flex justify-center gap-2">
    <!-- Edit Button -->
    <button onclick="editPpkom({{ $row->id }}, '{{ $row->nip }}', '{{ $row->nama }}', '{{ $row->pangkat }}', '{{ $row->jabatan }}', '{{ $row->alamat }}', '{{ $row->no_telp }}', '{{ $row->email }}')" class="btn btn-sm btn-warning">
        Edit
    </button>

    <!-- Delete Button -->
    <button onclick="setDeleteId({{ $row->id }})" class="btn btn-sm btn-danger">
        Delete
    </button>
</div>
