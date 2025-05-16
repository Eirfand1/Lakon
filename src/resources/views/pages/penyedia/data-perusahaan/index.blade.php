<x-app-layout>
    <div class="m-4 rounded-xl p-6 bg-white dark:bg-gray-800">
        <h3 class="font-bold text-lg">DATA PERUSAHAAN</h3>
        <div>
            <label for="alert edit-modal"
                class="btn btn-sm btn-circle rounded-full mt-2 btn-ghost absolute right-4 shadow-none top-2">
                ✕
            </label>
        </div>
        <form id="editForm" action="{{route('penyedia.data-perusahaan.update', $penyedia->penyedia_id)}}" method="post" class="space-y-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-1">
                    <x-label>
                        NIK <span class="text-red-500">*</span>
                        <small class="block text-xs text-gray-500">Nomor Induk Kependudukan
                            Pemilik/Direktur</small>
                    </x-label>
                    <x-input type="number" name="NIK" id="edit_nik" placeholder="Nomor Induk Kependudukan"
                        value="{{$penyedia->NIK}}" required />
                </div>
                <div class="md:col-span-1">
                    <x-label>
                        Nama <span class="text-red-500">*</span>
                        <small class="block text-xs text-gray-500">Nama Pemilik/Direktur Perusahaan</small>
                    </x-label>
                    <x-input type="text" name="nama_pemilik" id="edit_nama_pemilik" value="{{$penyedia->nama_pemilik}}"
                        placeholder="Nama Pemilik/Direktur sesuai KTP" required />
                </div>
            </div>

            <div>
                <x-label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                    Alamat <span class="text-red-500">*</span>
                    <small class="block text-xs text-gray-500">Alamat Pemilik/Direktur Perusahaan</small>
                </x-label>
                <textarea name="alamat_pemilik" id="edit_alamat_pemilik"
                    class="mt-1 bg-white dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                    rows="3" placeholder="Alamat lengkap Pemilik/Direktur sesuai dengan KTP"
                    required>{{$penyedia->alamat_pemilik}}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-label>
                        Nama Perusahaan (lengkap) <span class="text-red-500">*</span>
                    </x-label>
                    <x-input type="text" name="nama_perusahaan_lengkap" id="edit_nama_perusahaan_lengkap"
                        value="{{$penyedia->nama_perusahaan_lengkap}}" placeholder="Nama Lengkap Perusahaan" required />
                </div>
                <div>
                    <x-label>
                        Nama Perusahaan (singkat) <span class="text-red-500">*</span>
                    </x-label>
                    <x-input type="text" name="nama_perusahaan_singkat" id="edit_nama_perusahaan_singkat"
                        value="{{$penyedia->nama_perusahaan_singkat}}" placeholder="Nama Singkat Perusahaan" required />
                </div>
            </div>

            <div>
                <x-label>
                    Akta Notaris <span class="text-red-500">*</span>
                </x-label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <x-input type="text" name="akta_notaris_no" id="edit_akta_notaris_no"
                        value="{{$penyedia->akta_notaris_no}}" placeholder="Nomor Akta Notaris" required />
                    <x-input type="text" name="akta_notaris_nama" id="edit_akta_notaris_nama" placeholder="Nama Notaris"
                        value="{{$penyedia->akta_notaris_nama}}" required />
                    <x-input type="date" name="akta_notaris_tanggal" id="edit_akta_notaris_tanggal"
                        value="{{$penyedia->akta_notaris_tanggal}}" placeholder="Tanggal Notaris" required />
                </div>
            </div>

            <div>
                <x-label>
                    Alamat Perusahaan <span class="text-red-500">*</span>
                </x-label>
                <textarea name="alamat_perusahaan" id="edit_alamat_perusahaan"
                    class="mt-1 bg-white dark:bg-gray-900/20 dark:border-gray-700 block w-full rounded-md border-gray-200 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                    rows="3" placeholder="Alamat lengkap perusahaan"
                    required>{{$penyedia->alamat_perusahaan}}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-label>
                        No. Telepon Perusahaan <span class="text-red-500">*</span>
                    </x-label>
                    <x-input type="number" name="kontak_hp" id="edit_kontak_hp" placeholder="No. Telp Perusahaan"
                        value="{{$penyedia->kontak_hp}}" required />
                </div>
                <div>
                    <x-label>
                        Email Perusahaan <span class="text-red-500">*</span>
                    </x-label>
                    <x-input type="email" name="kontak_email" id="edit_kontak_email" placeholder="Email Perusahaan"
                        value="{{$penyedia->kontak_email}}" required />
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <x-label>
                        NPWP Perusahaan <span class="text-red-500">*</span>
                        <small class="block text-xs text-gray-500">Nomor Pokok Wajib Pajak</small>
                    </x-label>
                    <x-input type="text" name="npwp_perusahaan" id="edit_npwp_perusahaan"
                        value="{{$penyedia->npwp_perusahaan}}" placeholder="Nomor Pokok Wajib Pajak" required />
                </div>
                <div>
                    <x-label>
                        Logo Perusahaan
                        <small class="block text-xs text-gray-500">Unggah logo perusahaan (maks. 2MB)</small>
                    </x-label>
                    <x-input type="file" name="logo_perusahaan" accept="image/png, image/jpg, image/jpeg"
                        onchange="previewLogo(event)" value="{{asset($penyedia->logo_perusahaan)}}" />

                    <img id="logoPreview" src="" class="mt-2  object-cover rounded-lg" alt="Logo Preview" width="100">
                    <script>
                        function previewLogo(event) {
                            const logoPreview = document.getElementById('logoPreview');
                            const file = event.target.files[0];

                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function (e) {
                                    logoPreview.src = e.target.result;
                                    logoPreview.classList.remove('hidden');
                                }
                                reader.readAsDataURL(file);
                            } else {
                                logoPreview.src = '';
                                logoPreview.classList.add('hidden');
                            }
                        }
                    </script>
                </div>


            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <x-label>
                        Nomor Rekening <span class="text-red-500">*</span>
                    </x-label>
                    <x-input type="text" name="rekening_norek" id="edit_rekening_norek" placeholder="Nomor Rekening"
                        value="{{$penyedia->rekening_norek}}" required />
                </div>
                <div>
                    <x-label>
                        Nama Rekening <span class="text-red-500">*</span>
                    </x-label>
                    <x-input type="text" name="rekening_nama" id="edit_rekening_nama"
                        value="{{$penyedia->rekening_nama}}" placeholder="Nama Pemilik Rekening" required />
                </div>
                <div>
                    <x-label>
                        Bank <span class="text-red-500">*</span>
                    </x-label>
                    <x-input type="text" name="rekening_bank" id="edit_rekening_bank" placeholder="Nama Bank"
                        value="{{$penyedia->rekening_bank}}" required />
                </div>
            </div>

            <div class="flex justify-end space-x-2 modal-action">
                <button type="submit"
                    class="btn bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                    </svg>
                    Simpan
                </button>
                <a class="btn text-gray-700 dark:text-white bg-white dark:bg-gray-800 border-gray-300 dark:border-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700 border rounded-md" href="/penyedia/dashboard" wire:navigate>< Kembali</a>
            </div>
        </form>
    </div>

</x-app-layout>
