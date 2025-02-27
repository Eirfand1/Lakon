<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Verifikasi</h1>
</div>

<div>
    <form action="terima/{{ $kontrak->kontrak_id }}" method="POST">
        @csrf
        <div class="h-10 mt-6 rounded flex items-center bg-blue-500">
            <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Terima Permohonan
            </button>
        </div>
    </form>
</div>
