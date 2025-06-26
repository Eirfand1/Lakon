<div class="flex gap-1">
    <!-- Tombol Download -->
    <button onclick="downloadTemplate({{ $template->template_id }})"
        class="btn text-white rounded-md btn-sm bg-green-600 hover:bg-green-700">
        <i class="fa-solid fa-download"></i>
    </button>

    <!-- Tombol Edit -->
    <label for="edit-modal"
        class="btn text-white rounded-md btn-sm bg-blue-600 hover:bg-blue-700"
        onclick="setEditData({{ $template->template_id }}, '{{ $template->name }}', '{{ basename($template->file_path) }}')">
        <i class="fa-solid fa-edit"></i>
    </label>

    <!-- Tombol Delete -->
    <label for="delete-template"
        class="btn text-white rounded-md btn-sm btn-error"
        onclick="setDeleteId({{ $template->template_id }})">
        <i class="fa-solid fa-trash"></i>
    </label>
</div>
