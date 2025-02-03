<x-app-layout>
    <div class="p-5">
        <div class="sm:flex sm:justify-between sm:items-center p-2 pb-5">
            <div class="">
                <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">PENYEDIA</h1>
            </div>
        </div>

        <!-- Success Message -->

        @if (session('success'))

            <script>
                Toastify({
                    escapeMarkup: false,
                    text: '<i class="fas fa-check-circle mr-2"></i>' + "{{ session('success') }}",
                    duration: 3000,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    style: {
                        background: "linear-gradient(135deg, #2ecc71, #27ae60)",
                        fontWeight: "600",
                        textTransform: "uppercase",
                        padding: "12px 20px",
                    },
                }).showToast();
            </script>

        @endif
        <!-- error message -->

        @if (session('error'))
            <script>
                Toastify({
                    escapeMarkup: false,
                    text: '<i class="fas fa-exclamation-circle mr-3" style="font-size:20px;"></i>' + "{{ session('error') }}",
                    duration: 3000,
                    gravity: "top",
                    position: "center",
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                        fontWeight: "600",
                        textTransform: "uppercase",
                        padding: "12px 20px",
                    },
                }).showToast();
            </script>
        @endif

        {{-- table --}}
        <livewire:penyedia-table />
        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-10/12 max-w-3xl rounded dark:bg-gray-800 bg-gray-50">
                <h3 class="font-bold text-lg">EDIT DATA PENYEDIA</h3>
                <div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle font-bold mt-2 btn-ghost absolute right-2 top-2">X</label>
                </div>
                <form id="editForm" method="POST" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                NIK <span class="text-red-500">*</span>
                                <small class="block text-xs text-gray-500">Nomor Induk Kependudukan
                                    Pemilik/Direktur</small>
                            </label>
                            <input type="number" name="NIK" id="edit_nik"
                                class="mt-1 block bg-white dark:bg-gray-50/10 dark:border-gray-600 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nomor Induk Kependudukan" required>
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                Nama <span class="text-red-500">*</span>
                                <small class="block text-xs text-gray-500">Nama Pemilik/Direktur Perusahaan</small>
                            </label>
                            <input type="text" name="nama_pemilik" id="edit_nama_pemilik"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nama Pemilik/Direktur sesuai KTP" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                            Alamat <span class="text-red-500">*</span>
                            <small class="block text-xs text-gray-500">Alamat Pemilik/Direktur Perusahaan</small>
                        </label>
                        <textarea name="alamat_pemilik" id="edit_alamat_pemilik"
                            class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            rows="3" placeholder="Alamat lengkap Pemilik/Direktur sesuai dengan KTP"
                            required></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                Nama Perusahaan (lengkap) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_perusahaan_lengkap" id="edit_nama_perusahaan_lengkap"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nama Lengkap Perusahaan" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                Nama Perusahaan (singkat) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_perusahaan_singkat" id="edit_nama_perusahaan_singkat"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nama Singkat Perusahaan" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                            Akta Notaris <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <input type="text" name="akta_notaris_no" id="edit_akta_notaris_no"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nomor Akta Notaris" required>
                            <input type="text" name="akta_notaris_nama" id="edit_akta_notaris_nama"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nama Notaris" required>
                            <input type="date" name="akta_notaris_tanggal" id="edit_akta_notaris_tanggal"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Tanggal Notaris" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                            Alamat Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alamat_perusahaan" id="edit_alamat_perusahaan"
                            class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            rows="3" placeholder="Alamat lengkap perusahaan" required></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                No. Telepon Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="kontak_hp" id="edit_kontak_hp"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="No. Telp Perusahaan" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                Email Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="kontak_email" id="edit_kontak_email"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Email Perusahaan" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                NPWP Perusahaan <span class="text-red-500">*</span>
                                <small class="block text-xs text-gray-500">Nomor Pokok Wajib Pajak</small>
                            </label>
                            <input type="text" name="npwp_perusahaan" id="edit_npwp_perusahaan"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nomor Pokok Wajib Pajak" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                Logo Perusahaan
                                <small class="block text-xs text-gray-500">Unggah logo perusahaan (maks. 2MB)</small>
                            </label>
                            <input type="file" name="logo_perusahaan" accept="image/png, image/jpg, image/jpeg" class="mt-1 block w-full text-sm text-gray-500
                                                                  file:mr-4 border p-1 bg-white dark:bg-gray-50/10 
                                                                  dark:border-gray-600 file:rounded-md rounded-md 
                                                                  file:border-0 file:text-sm file:font-medium
                                                                  file:bg-blue-50 file:text-blue-700
                                                                  hover:file:bg-blue-100"
                                onchange="previewLogo(event)">

                            <img id="logoPreview" src="" class="mt-2  object-cover rounded-lg"
                                alt="Logo Preview" width="100">
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
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                Nomor Rekening <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="rekening_norek" id="edit_rekening_norek"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nomor Rekening" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                Nama Rekening <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="rekening_nama" id="edit_rekening_nama"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nama Pemilik Rekening" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                                Bank <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="rekening_bank" id="edit_rekening_bank"
                                class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                                placeholder="Nama Bank" required>
                        </div>
                    </div>

                    <h1 class="border-y border-gray-300 dark:border-gray-700 font-bold py-2">AKUN</h1>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-100">
                            Status <span class="text-red-500">*</span>
                            <small class="block text-xs text-gray-500">Pilih status perusahaan</small>
                        </label>
                        <select name="status" id="edit_status"
                            class="mt-1 bg-white dark:bg-gray-50/10 dark:border-gray-600 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200"
                            required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="biasa">Biasa</option>
                            <option value="konsultan">Konsultan</option>
                        </select>
                    </div>

                    <div class="flex justify-end space-x-4 modal-action">
                        <button type="submit"
                            class="btn bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                            </svg>
                            Simpan
                        </button>
                        <label for="edit-modal" class="btn">Tutup</label>
                    </div>
                </form>
            </div>
        </div>


        <!-- Delete Modal -->
        <input type="checkbox" id="delete-modal" class="modal-toggle" />
        <div class="modal modal-top">
            <div
                class="modal-box w-auto mt-5 mx-auto rounded-lg dark:text-white text-gray-800 bg-gray-100 dark:bg-gray-800">
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
    </div>

    <!-- Script for penyedia Table -->
    <script>

        function editPenyedia(penyedia_id, nik, nama_pemilik,
            alamat_pemilik, nama_perusahaan_lengkap,
            nama_perusahaan_singkat, akta_notaris_no, akta_notaris_nama,
            akta_notaris_tanggal, alamat_perusahaan, kontak_hp,
            kontak_email, rekening_norek, rekening_nama, rekening_bank, npwp_perusahaan, logo_perusahaan
        ) {
            document.getElementById('editForm').action = `penyedia/${penyedia_id}`;
            document.getElementById('edit_nik').value = nik;
            document.getElementById('edit_nama_pemilik').value = nama_pemilik;
            document.getElementById('edit_alamat_pemilik').textContent = alamat_pemilik;
            document.getElementById('edit_nama_perusahaan_lengkap').value = nama_perusahaan_lengkap;
            document.getElementById('edit_nama_perusahaan_singkat').value = nama_perusahaan_singkat;
            document.getElementById('edit_akta_notaris_no').value = akta_notaris_no;
            document.getElementById('edit_akta_notaris_nama').value = akta_notaris_nama;
            document.getElementById('edit_akta_notaris_tanggal').value = akta_notaris_tanggal;
            document.getElementById('edit_alamat_perusahaan').textContent = alamat_perusahaan;
            document.getElementById('edit_kontak_hp').value = kontak_hp;
            document.getElementById('edit_kontak_email').value = kontak_email;
            document.getElementById('edit_rekening_norek').value = rekening_norek;
            document.getElementById('edit_rekening_nama').value = rekening_nama;
            document.getElementById('edit_rekening_bank').value = rekening_bank;
            document.getElementById('edit_npwp_perusahaan').value = npwp_perusahaan;

            const logoBefore = document.getElementById('logoPreview');
            logoBefore.src = `${logo_perusahaan ? `{{ asset('') }}${logo_perusahaan}` : '{{ asset('images/default-logo.png') }}'}`;
        }

        function setDeleteId(penyedia_id) {
            document.getElementById('deleteForm').action = `penyedia/${penyedia_id}`;
        }
    </script>

</x-app-layout>