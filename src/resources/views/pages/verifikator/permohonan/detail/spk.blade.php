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
            <input type="text" name="jenis_kontrak" value="{{ $kontrak->jenis_kontrak }}" required readonly class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor SPK</label>
            <input type="text" name="nomor_spk" value="{{ $kontrak->nomor_spk }}" required readonly class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nilai Kontrak</label>
            <div x-data="detailKontrak({{ json_encode($kontrak) }})" class="space-y-2">
                <div class="flex gap-4">
                    <input type="text" id="nilaiKontrakSPK" value="{{ $kontrak->nilai_kontrak }}" required class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
                    <button type="button" @click="addDetailRow" class="btn btn-primary mt-2">Detail</button>
                </div>

                <template x-for="(detail, index) in details" :key="index">
                    <div class="flex items-center gap-2 mt-2">
                        <div class="flex gap-4 w-full">
                            <!-- Kolom Detail (50%) -->
                            <div class="w-4/5">
                                <input
                                    type="text"
                                    name="detail[]"
                                    x-model="detail.namaDetail"
                                    placeholder="Detail"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md"
                                >
                            </div>
                            <!-- Kolom Nilai (50%) -->
                            <div class="w-4/5">
                                <input
                                    type="text"
                                    name="nilai[]"
                                    x-model="detail.nilaiDetail"
                                    placeholder="Nilai"
                                    @input="updateNilaiKontrak"
                                    class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md"
                                >
                            </div>
                        </div>
                        <!-- Tombol Hapus di bawah tombol Detail -->
                        <div class="flex justify-end gap-4">
                            <div class="w-1/10 flex justify-end">
                                <button
                                    type="button"
                                    @click="removeDetailRow(index)"
                                    class="btn btn-error"
                                >
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <input type="hidden" name="nilai_kontrak" id="nilaiKontrakSPKHidden" value="{{ $kontrak->nilai_kontrak }}">
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
            <select name="uang_muka" id="uangMukaSPK" required class="mt-1 block w-full dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 rounded-md">
                <option value="" {{ $kontrak->uang_muka == false ? 'selected' : '' }}>Pilih Uang Muka</option>
                <option value="Terdapat Uang Muka" {{ $kontrak->uang_muka == "Terdapat Uang Muka" ? 'selected' : '' }}>Ada Uang Muka</option>
                <option value="Tidak Ada Uang Muka" {{ $kontrak->uang_muka == "Tidak Ada Uang Muka" ? 'selected' : '' }}>Tidak Ada Uang Muka</option>
            </select>
        </div>
    </div>

    <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
        <i class="fas fa-circle-check fa-lg"></i>
        <h3 class=" font-bold">Validasi Kebenaran Data</h3>
    </div>

    <div class="mb-4 flex">
        <input type="checkbox" name="cek" required class="mt-1 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600">
        <p class="ml-2">Data - data diatas sudah sesuai dengan ketentuan dan kebutuhan.</p>
    </div>

    <div class="h-10 mt-6 mb-8 rounded flex items-center bg-blue-500">
        <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Simpan Data Surat Perintah Kerja
        </button>
    </div>
</form>

<script>
        function numberToTextFunction(input, too_long) {
            let terbilang_input = document.getElementById("terbilangNilaiKontrakSPK")
            if (!input || input === 0) {
                terbilang_input.value = "";
                return;
            }

            if (too_long) {
                terbilang_input.value = "Nilai kontrak terlalu besar";
                terbilang_input.classList.add("text-red-600", "dark:text-red-600");
                return;
            }else{
                terbilang_input.classList.remove("text-red-600", "dark:text-red-600");
            }

            const convert = numberToText.convertToText(input, {
                language: 'id'
            })

            hasil = `${convert} Rupiah`
            terbilang_input.value = hasil
        }


        // Fungsi untuk memformat input uang dengan Rp. dan separator ribuan
        function formatUang(event) {
            const input = event.target;
            let value = input.value.replace(/[^0-9]/g, '');
            let too_long = false;

            document.getElementById("nilaiKontrakSPKHidden").value = value

            if (value.length > 15) {
                too_long = true;
                input.classList.add("text-red-600", "dark:text-red-600");
            }else{
                input.classList.remove("text-red-600", "dark:text-red-600");
            }

            numberToTextFunction(value, too_long);

            // Jika input kosong, set ke Rp. 0
            if (value === "") {
                input.value = "Rp. 0";
                return;
            }

            // Ubah string angka ke number
            let numberValue = parseInt(value, 10);

            // Format angka dengan separator ribuan
            let formattedValue = numberValue.toLocaleString('id-ID');

            // Tambahkan "Rp." di depan
            input.value = `Rp. ${formattedValue}`;
        }

        // Tambahkan event listener ke input uang
        document.getElementById('nilaiKontrakSPK').addEventListener('input', formatUang);

        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('nilaiKontrakSPK');
            formatUang({ target: input });
        });


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


        function detailKontrak(kontrak) {
            return {
                nilaiKontrak: kontrak.nilai_kontrak || '',
                details: [],

                addDetailRow() {
                    this.details.push({
                        namaDetail: '',
                        nilaiDetail: ''
                    });
                    document.getElementById("nilaiKontrakSPK").readOnly = true
                },

                removeDetailRow(index) {
                    this.details.splice(index, 1);
                    if (this.details.length === 0) {
                        document.getElementById("nilaiKontrakSPK").readOnly = false
                    }
                    this.updateNilaiKontrak();
                },

                updateNilaiKontrak() {
                    let total = 0;
                    this.details.forEach(detail => {
                        total += parseFloat(detail.nilaiDetail);
                    });
                    const input = document.getElementById("nilaiKontrakSPK");
                    input.value = total;

                    const event = new Event('input', {
                        bubbles: true,
                        cancelable: true,
                    });
                    input.dispatchEvent(event);
                }
            }
        }


</script>
