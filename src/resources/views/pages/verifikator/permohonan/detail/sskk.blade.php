<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Syarat - Syarat Khusus Kontrak</h1>
</div>

<div class="mb-8">
    @include('pages.lampiran.keterangan-hak-dan-kewajiban')
</div>

<div class="mb-8">
    @include('pages.lampiran.keterangan-tindakan')
</div>

<div class="mb-8">
    @include('pages.lampiran.keterangan-fasilitas')
</div>

<form action="sskk/{{ $kontrak->kontrak_id }}" method="POST">
    @csrf
    <div class="h-10 mt-6 rounded flex items-center bg-blue-500">
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Simpan Syarat - Syarat Khusus Kontrak
        </button>
    </div>
</form>
