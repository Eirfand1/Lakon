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
    });
</script>