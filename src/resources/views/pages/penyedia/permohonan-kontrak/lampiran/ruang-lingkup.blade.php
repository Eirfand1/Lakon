<div class="mb-8 w-full">
    <div class="flex items-center mb-6 space-x-2 text-gray-600 dark:text-gray-300">
        <i class="fas fa-cogs fa-lg"></i>
        <h3 class="font-bold text-xl">Ruang Lingkup Pekerjaan</h3>
    </div>

    <div x-data="ruangLingkupManager()" class="space-y-4">
        <!-- Input Fields -->
        <template x-for="(input, index) in inputs" :key="index">
            <div class="flex items-center space-x-3">
                <input type="text" x-model="input.value" name="ruang_lingkup[]"
                    class="flex-1 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    placeholder="Masukkan ruang lingkup..." />
                <button type="button" @click="removeInput(index)"
                    class="px-3 py-2 text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                    x-show="inputs.length > 1" title="Hapus Ruang Lingkup">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        </template>

        <!-- Add Button -->
        <button type="button" @click="addInput()"
            class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-600 rounded-lg hover:bg-blue-100 dark:text-blue-400 dark:border-blue-400 dark:bg-blue-900/30 dark:hover:bg-blue-900/50 transition-colors">
            <i class="fas fa-plus mr-2"></i>
            Tambah Ruang Lingkup
        </button>
    </div>
</div>

<script>
    function ruangLingkupManager() {
        return {
            inputs: [{ value: '' }],
            addInput() {
                this.inputs.push({ value: '' });
            },
            removeInput(index) {
                if (this.inputs.length > 1) {
                    this.inputs.splice(index, 1);
                }
            },
        };
    }
</script>