<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Surat Perintah Pengiriman</h1>
</div>

<div class="mb-8">
    @include('pages.lampiran.rincian-barang')
</div>

<div class="mb-8">
    @include('pages.lampiran.penerima-barang')
</div>

<form action="spp/{{ $kontrak->kontrak_id }}" method="POST">
    @csrf
    <div class="h-10 mt-6 rounded-md flex items-center bg-green-500">
        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white  py-2 px-4 rounded-md">
            <i class="fa-solid fa-check"></i>
            Simpan Surat Perintah Pengiriman
        </button>
    </div>
</form>
