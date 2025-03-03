<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Surat Perintah Kerja</h1>
</div>

<form action="spk/{{ $kontrak->kontrak_id }}" method="POST">
@csrf

    <div class="mb-8">
        <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
            <i class="fas fa-info fa-lg"></i>
            <h3 class=" font-bold">Data Surat Perintah Kerja</h3>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Jenis Kontrak</label>
            <input type="text" name="jenis_kontrak" value="{{ $kontrak->jenis_kontrak }}" required class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor SPK</label>
            <input type="text" name="nomor_spk" value="{{ $kontrak->nomor_spk }}" required class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nilai Kontrak</label>
            <input type="number" name="nilai_kontrak" id="nilaiKontrakSPK" oninput="numberToTextFunction()" value="{{ $kontrak->nilai_kontrak }}" required class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Terbilang Nilai Kontrak</label>
            <input type="text" name="terbilang_nilai_kontrak" id="terbilangNilaiKontrakSPK" readonly value="{{ $kontrak->terbilang_nilai_kontrak }}" required class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 mb-4">
            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal Awal</label>
                <input type="date" name="tanggal_awal" value="{{ $kontrak->tanggal_awal }}" required id="tanggalAwalSPK" onchange="waktuPenyelesaian()" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
            </div>

            <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal Akhir</label>
                <input type="date" name="tanggal_akhir" value="{{ $kontrak->tanggal_akhir }}" required id="tanggalAkhirSPK" onchange="waktuPenyelesaian()" class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
            </div>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Waktu Penyelesaian</label>
            <input type="text" name="waktu_penyelesaian" value="{{ $kontrak->waktu_penyelesaian }}" required id="waktuPenyelesaianSPK" readonly class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>
    </div>

    <div class="mb-8">
        <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
            <i class="fas fa-info fa-lg"></i>
            <h3 class=" font-bold">Sistem Pembayaran</h3>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tata Cara Pembayaran</label>
            <input type="text" name="cara_pembayaran" value="{{ $kontrak->cara_pembayaran }}" required class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Uang Muka</label>
            <input type="number" name="uang_muka" value="{{ $kontrak->uang_muka }}" required class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>
    </div>

    <div class="h-10 mt-6 mb-8 rounded flex items-center bg-blue-500">
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Simpan Data Surat Perintah Kerja
        </button>
    </div>
</form>

@if (($metode == 'Jasa Konsultasi Pengawasan' || $metode == 'Jasa Konsultasi Perencanaan') && $jenis == 'non_tender')

<div id="spkLanjutan">
    <div class="mb-8">
        @include('pages.lampiran.dokumen-penagihan')
    </div>

    <div class="mb-8">
        @include('pages.lampiran.ruang-lingkup')
    </div>

    <div class="mb-8">
        @include('pages.lampiran.dokumen-tambahan')
    </div>
</div>
@endif

@if (($metode == 'Pengadaan Barang' && $jenis == 'tender'))

<div class="mb-8">
    @include('pages.lampiran.ruang-lingkup')
</div>
@endif

{{-- <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
    <i class="fas fa-circle-check fa-lg"></i>
    <h3 class=" font-bold">Validasi Kebenaran Data</h3>
</div> --}}

{{-- <div class="mb-4 flex">
    <input type="checkbox" name="cek" required class="mt-1 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
    <p class="ml-2">Data - data diatas sudah sesuai dengan ketentuan dan kebutuhan.</p>
</div> --}}

<script>

        function numberToTextFunction() {
            const input = document.getElementById("nilaiKontrakSPK").value

            if (!input) {
                document.getElementById("terbilangNilaiKontrakSPK").value = "";
                return;
            }

            const convert = numberToText.convertToText(input, {
                language: 'id'
            })

            hasil = `${convert} Rupiah`
            document.getElementById("terbilangNilaiKontrakSPK").value = hasil
        }

        function waktuPenyelesaian(){
            const tanggal_awal = document.getElementById("tanggalAwalSPK").value
            const tanggal_akhir = document.getElementById("tanggalAkhirSPK").value

            if (!tanggal_awal || !tanggal_akhir) {
                document.getElementById("waktuPenyelesaianSPK").value = "";
                return;
            }

            // Hitung selisih tanggal dalam milidetik
            const selisihMs = new Date(tanggal_akhir) - new Date(tanggal_awal);

            // Konversi selisih milidetik ke hari
            const selisihHari = Math.floor(selisihMs / (1000 * 60 * 60 * 24)) + 1;

            const hasil = `${selisihHari} Hari`
            document.getElementById("waktuPenyelesaianSPK").value = hasil
        }
</script>
