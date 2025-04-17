<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Verifikasi</h1>
</div>

<div class="m-4 p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-xl">
    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Konfirmasi Verifikasi</h2>

    <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-lg mb-6">
        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
            Dengan ini saya menyatakan bahwa data yang saya lihat dan saya sampaikan adalah benar sesuai dengan fakta yang ada, dan apabila dikemudian hari data yang saya lihat atau sampaikan tidak benar, maka saya bersedia untuk diproses secara hukum sesuai dengan ketentuan Undang-Undang yang berlaku.
        </p>
    </div>

    <form action="terima/{{$kontrak->kontrak_id}}" method="POST" class="mt-4">
        @csrf
        <div class="flex items-center mb-6">
            <input type="checkbox" required name="konfirmasi_pernyataan" id="konfirmasi"
                class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
            <label for="konfirmasi" class="ml-3 text-gray-700 dark:text-gray-300 font-medium">
                Saya setuju dengan pernyataan di atas
            </label>
        </div>

        <button type="submit"
            class="w-full px-6 py-3 text-white bg-green-600 rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all dark:bg-green-700 dark:hover:bg-green-600 flex items-center justify-center">
            <i class="fas fa-check mr-2"></i> Terima Permohonan Kontrak
        </button>
    </form>
</div>
