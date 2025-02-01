<div>
<label for="delete-modal" class="btn text-white btn-sm btn-error" onclick="setDeleteId({{ $p->paket_id }})">
        <i class="fa-solid fa-trash"></i>
</label>
</div>

<script>
function setDeleteId(paket_id) {
            document.getElementById('deleteForm').action = `penyedia/${paket_id}`;
}
</script>

