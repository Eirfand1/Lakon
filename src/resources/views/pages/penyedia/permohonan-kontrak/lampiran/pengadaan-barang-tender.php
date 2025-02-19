<div>
    <!-- Ruang Lingkup Section -->
    <div class="mb-8" x-data="ruangLingkup">
        <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
            <i class="fas fa-list-ul fa-lg"></i>
            <h3 class="font-bold">RUANG LINGKUP PEKERJAAN</h3>
        </div>

        <div class="space-y-4">
            <div class="flex space-x-2">
                <textarea x-model="input"
                    class="flex-1 rounded border border-gray-700/30 dark:bg-gray-600 dark:text-gray-200 p-2"
                    placeholder="Masukkan ruang lingkup..." rows="3"></textarea>
                <button @click="tambah()"
                    class="px-3 py-1 text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                    <i class="fas fa-plus"></i>
                </button>
            </div>

            <div class="space-y-2">
                <template x-for="(item, index) in list" :key="index">
                    <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-gray-700/60 rounded-lg">
                        <span x-text="item" class="text-gray-700 dark:text-gray-200"></span>
                        <div class="flex space-x-2">
                            <button @click="edit(index)"
                                class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button @click="hapus(index)"
                                class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Rincian Belanja Section -->
    <div class="mb-8" x-data="rincianBelanja">
        <div class="flex items-center mb-4 space-x-2 text-gray-600 dark:text-gray-300">
            <i class="fas fa-calculator fa-lg"></i>
            <h3 class="font-bold">RINCIAN BELANJA</h3>
        </div>

        <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 text-left">Jenis</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 text-left">Uraian</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 text-left">Qty</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 text-left">Satuan</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 text-left">Harga (per
                            Satuan)</th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 text-left">Total Harga
                        </th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 text-left">Keterangan
                        </th>
                        <th class="px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                    <template x-for="(item, index) in list" :key="index">
                        <tr class="text-sm text-gray-700 dark:text-gray-200">
                            <td class="px-4 py-3" x-text="item.jenis"></td>
                            <td class="px-4 py-3" x-text="item.uraian"></td>
                            <td class="px-4 py-3" x-text="item.qty"></td>
                            <td class="px-4 py-3" x-text="item.satuan"></td>
                            <td class="px-4 py-3" x-text="formatRupiah(item.harga)"></td>
                            <td class="px-4 py-3" x-text="formatRupiah(item.total)"></td>
                            <td class="px-4 py-3" x-text="item.keterangan"></td>
                            <td class="px-4 py-3">
                                <button @click="hapus(index)"
                                    class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Input Form -->
        <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" x-model="input.jenis"
                class="rounded border border-gray-700/30 dark:bg-gray-600 dark:text-gray-200" placeholder="Jenis">
            <input type="text" x-model="input.uraian"
                class="rounded border border-gray-700/30 dark:bg-gray-600 dark:text-gray-200" placeholder="Uraian">
            <input type="number" x-model="input.qty"
                class="rounded border border-gray-700/30 dark:bg-gray-600 dark:text-gray-200" placeholder="Qty">
            <input type="text" x-model="input.satuan"
                class="rounded border border-gray-700/30 dark:bg-gray-600 dark:text-gray-200" placeholder="Satuan">
            <input type="number" x-model="input.harga"
                class="rounded border border-gray-700/30 dark:bg-gray-600 dark:text-gray-200"
                placeholder="Harga per satuan">
            <input type="text" x-model="input.keterangan"
                class="rounded border border-gray-700/30 dark:bg-gray-600 dark:text-gray-200" placeholder="Keterangan">
        </div>

        <div class="mt-4">
            <button @click="tambah()"
                class="inline-flex items-center px-4 py-2 text-sm text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-50 dark:text-blue-400 dark:border-blue-400 dark:hover:bg-blue-900/30">
                <i class="mr-2 fas fa-plus"></i>
                Tambah Item
            </button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('ruangLingkup', () => ({
            input: '',
            list: [],

            tambah() {
                if (this.input.trim()) {
                    this.list.push(this.input.trim());
                    this.input = '';
                }
            },

            hapus(index) {
                this.list.splice(index, 1);
            },

            edit(index) {
                this.input = this.list[index];
                this.list.splice(index, 1);
            }
        }));

        Alpine.data('rincianBelanja', () => ({
            input: {
                jenis: '',
                uraian: '',
                qty: '',
                satuan: '',
                harga: '',
                keterangan: ''
            },
            list: [],

            tambah() {
                if (this.input.jenis && this.input.uraian && this.input.qty &&
                    this.input.satuan && this.input.harga) {
                    let total = this.input.qty * this.input.harga;
                    this.list.push({ ...this.input, total });
                    this.input = {
                        jenis: '',
                        uraian: '',
                        qty: '',
                        satuan: '',
                        harga: '',
                        keterangan: ''
                    };
                }
            },

            hapus(index) {
                this.list.splice(index, 1);
            },

            formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(angka);
            }
        }));
    });
</script>