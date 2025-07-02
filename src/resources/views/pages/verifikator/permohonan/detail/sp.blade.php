<div class="w-full h-10 mb-8 rounded flex items-center bg-blue-500">
    <h1 class="font-bold text-gray-100 ml-4">Surat Pesanan / Surat Perintah Mulai Kerja</h1>
</div>

<form action="sp/{{ $kontrak->kontrak_id }}" method="POST">
@csrf
    <div class="mb-8">

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Nomor SP</label>
            <x-input type="text" name="nomor_sp" value="{{ $noSpmk }}" readonly></x-input>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">Tanggal SP</label>
            <x-input type="date" name="tgl_sp" value="{{ $kontrak->tgl_sp }}" id="tanggalAwalSPK" ></x-input>
        </div>

        <div class="p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg mb-4">
            <label class="block text-sm font-semibold text-blue-900 dark:text-blue-300">ID Paket</label>
            <div x-data="idPaketManager({{ json_encode($kontrak) }})" x-init="initIdPaket({{ json_encode($id_paket) }})" id="" class="space-y-2">
                <template x-for="(paket, index) in idPaket" :key="index">
                    <div class="flex items-center gap-2 mt-2">
                        <div class="flex gap-4 w-full">
                            <div class="w-full">
                                <x-input
                                    type="text"
                                    name="id_paket[]"
                                    x-model="paket.idPaket"
                                    placeholder="ID Paket"
                                ></x-input>
                            </div>
                        </div>
                        <!-- Tombol Hapus di samping kanan, hanya tampil jika idPaket > 1 -->
                        <div class="flex justify-end gap-4" x-show="idPaket.length > 1">
                            <div class="w-1/10 flex justify-end">
                                <button
                                    type="button"
                                    @click="removeIdPaketRow(index)"
                                    class="btn btn-error text-white px-4 py-0 space-x-0"
                                >
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
                <div class="flex gap-4">
                    <button type="button" @click="addIdPaketRow" class="btn bg-blue-500 px-4 mt-2 text-white">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="h-10 mt-6 mb-8 rounded-md flex items-center bg-green-500">
        <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white  py-2 px-4 rounded-md">
            <i class="fa-solid fa-check"></i>
            Simpan Data Surat Perintah Kerja
        </button>
    </div>
</form>

<script>
    function idPaketManager(kontrak) {
        return {
            idPaket: [],

            addIdPaketRow() {
                this.idPaket.push({
                    idPaket: '',
                });
            },

            removeIdPaketRow(index) {
                if (this.idPaket.length > 1) {
                    this.idPaket.splice(index, 1);
                }
            },

            initIdPaket(id_paket) {
                if (!Array.isArray(id_paket)) return;
                this.idPaket = [];

                id_paket.forEach(item => {
                    this.idPaket.push({
                        idPaket: item.id_paket,
                    });
                });

                if (this.idPaket.length === 0) {
                    this.addIdPaketRow();
                }
            }
        };
    }
</script>
