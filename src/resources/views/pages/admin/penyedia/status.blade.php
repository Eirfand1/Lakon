<div>
    @if ($status == 0)
        <a href="/admin/penyedia/verifikasi/{{ $id }}" class="btn rounded-md text-white btn-sm btn-error">
            belum terverifikasi
        </a>
    @elseif ($status == 1)
        <a href="/admin/penyedia/batal_verifikasi/{{ $id }}" class="btn rounded-md text-white btn-sm btn-success">
            terverifikasi
        </a>
    @endif
</div>
