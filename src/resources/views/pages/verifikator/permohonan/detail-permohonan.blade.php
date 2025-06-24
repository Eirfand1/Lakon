{{-- @dd($kontrak->penyedia) --}}
<x-app-layout>

<div class="p-4">
    <h2 class="text-2xl font-bold mb-4">
        <i class="fa fa-calendar-o mr-2"></i> DETAIL PERMOHONAN KONTRAK
    </h2>
    <div class="border-b border-gray-300 my-4"></div>

    @php
    $jenis = $kontrak->paketPekerjaan->jenis_pengadaan;
    $metode = $kontrak->paketPekerjaan->metode_pemilihan;
    @endphp

    <div
    x-data=
    "{
        tab: (function() {
            // Get the URL parameter if it exists
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = urlParams.get('tab');

            // If there's a tab parameter in the URL, use it
            if (tabParam) {
                sessionStorage.setItem('activeTab', tabParam);
                return tabParam;
            }

            // If we're coming from another page (different URL)
            if (document.referrer !== '' && new URL(document.referrer).pathname !== window.location.pathname) {
                // Reset to tab1
                sessionStorage.setItem('activeTab', 'tab1');
                return 'tab1';
            }

            // Otherwise use the stored value or default to tab1
            return sessionStorage.getItem('activeTab') || 'tab1';
        })(),
        setTab(newTab) {
            this.tab = newTab;
            sessionStorage.setItem('activeTab', newTab);
        }
    }"
    class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 p-4">
        <div class="flex space-x-4 mb-4">
            <button
                :class="{
                    'bg-blue-500 text-white': tab === 'tab1',
                    'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200': tab !== 'tab1'
                }"
                class="px-4 py-2 rounded border border-blue-500 transition-colors duration-200"
                @click="setTab('tab1')"
            >
                Data Dasar
                <i class="fa-regular {{ $kontrak->data_dasar_done ? 'fa-circle-check text-green-500' : 'fa-circle-xmark text-red-500' }}"></i>
            </button>
            <button
                :class="{
                    'bg-blue-500 text-white': tab === 'tab2',
                    'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200': tab !== 'tab2'
                }"
                class="px-4 py-2 rounded border border-blue-500 transition-colors duration-200"
                @click="setTab('tab2')"
            >
                SPK
                <i class="fa-regular {{ $kontrak->spk_done ? 'fa-circle-check text-green-500' : 'fa-circle-xmark text-red-500' }}"></i>
            </button>

            {{-- @if ($jenis == 'tender' && ($metode == 'Jasa Konsultasi Pengawasan' || $metode == 'Jasa Konsultasi Perencanaan')) --}}
            <button
                :class="{
                    'bg-blue-500 text-white': tab === 'tab3',
                    'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200': tab !== 'tab3'
                }"
                class="px-4 py-2 rounded border border-blue-500 transition-colors duration-200"
                @click="setTab('tab3')"
            >
                Lampiran
                <i class="fa-regular {{ $kontrak->lampiran_done ? 'fa-circle-check text-green-500' : 'fa-circle-xmark text-red-500' }}"></i>
            </button>
            {{-- @endif --}}

            {{-- @if ($metode == 'Pengadaan Barang') --}}
            <button
                :class="{
                    'bg-blue-500 text-white': tab === 'tab4',
                    'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200': tab !== 'tab4'
                }"
                class="px-4 py-2 rounded border border-blue-500 transition-colors duration-200"
                @click="setTab('tab4')"
            >
                SPP
                <i class="fa-regular {{ $kontrak->spp_done ? 'fa-circle-check text-green-500' : 'fa-circle-xmark text-red-500' }}"></i>
            </button>
            {{-- @endif --}}

            {{-- @if ($jenis == 'non_tender' && ($metode == 'Jasa Konsultasi Pengawasan' || $metode == 'Jasa Konsultasi Perencanaan')) --}}
            {{-- <button
                :class="{
                    'bg-blue-500 text-white': tab === 'tab5',
                    'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200': tab !== 'tab5'
                }"
                class="px-4 py-2 rounded border border-blue-500 transition-colors duration-200"
                @click="setTab('tab5')"
            >
                SSKK
                <i class="fa-regular {{ $kontrak->sskk_done ? 'fa-circle-check text-green-500' : 'fa-circle-xmark text-red-500' }}"></i>
            </button> --}}
            {{-- @endif --}}

            <button
                :class="{
                    'bg-blue-500 text-white': tab === 'tab6',
                    'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200': tab !== 'tab6'
                }"
                class="px-4 py-2 rounded border border-blue-500 transition-colors duration-200"
                @click="setTab('tab6')"
            >
                SP/SPMK
                <i class="fa-regular {{ $kontrak->sp_done ? 'fa-circle-check text-green-500' : 'fa-circle-xmark text-red-500' }}"></i>
            </button>

            <button
                :class="{
                    'bg-blue-500 text-white': tab === 'tab7',
                    'bg-gray-200 text-gray-800 dark:bg-gray-700 dark:text-gray-200': tab !== 'tab7'
                }"
                class="px-4 py-2 rounded border border-blue-500 transition-colors duration-200"
                @click="setTab('tab7')"
            >
                Verifikasi
                <i class="fa-regular {{ $kontrak->is_verified ? 'fa-circle-check text-green-500' : 'fa-circle-xmark text-red-500' }}"></i>
            </button>
        </div>


        {{-- data dasar --}}
        <div x-show="tab === 'tab1'" class="mt-4">
            @include('pages.verifikator.permohonan.detail.data-dasar')
        </div>
        {{-- spk --}}
        <div x-show="tab === 'tab2'" class="mt-4">
            @include('pages.verifikator.permohonan.detail.spk')
        </div>
        {{-- lampiran --}}
        {{-- @if ($jenis == 'tender' && ($metode == 'Jasa Konsultasi Pengawasan' || $metode == 'Jasa Konsultasi Perencanaan')) --}}
        <div x-show="tab === 'tab3'" class="mt-4">
            @include('pages.verifikator.permohonan.detail.lampiran')
        </div>
        {{-- @endif --}}
        {{-- spp --}}
        {{-- @if ($metode == 'Pengadaan Barang') --}}
        <div x-show="tab === 'tab4'" class="mt-4">
            @include('pages.verifikator.permohonan.detail.spp')
        </div>
        {{-- @endif --}}
        {{-- sskk --}}
        {{-- @if ($jenis == 'non_tender' && ($metode == 'Jasa Konsultasi Pengawasan' || $metode == 'Jasa Konsultasi Perencanaan')) --}}
        {{-- <div x-show="tab === 'tab5'" class="mt-4">
            @include('pages.verifikator.permohonan.detail.sskk')
        </div> --}}
        {{-- @endif --}}
        {{-- verifikasi --}}
        <div x-show="tab === 'tab6'" class="mt-4">
            @include('pages.verifikator.permohonan.detail.sp')
        </div>
        <div x-show="tab === 'tab7'" class="mt-4">
            @include('pages.verifikator.permohonan.detail.verifikasi')
        </div>
    </div>

</div>

<!-- Delete -->
<input type="checkbox" id="delete-modal" class="modal-toggle" />
<div class="modal modal-top px-3">
    <div
        class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
        <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-action">
                <button type="submit" class="btn btn-error">
                    <i class="fa-solid fa-trash"></i>
                    <span>Hapus</span>
                </button>
                <label for="delete-modal" class="btn">Batal</label>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
