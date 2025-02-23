<x-app-layout>
    <div class="p-5">
        <div class="mb-4 flex flex-wrap justify-between items-center">
            <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">SEKOLAH</h1>
            <div class="flex flex-wrap sm:w-auto w-full sm:mx-0 mx-4 gap-2">
                <div class="sm:w-auto w-full">
                    <a href="{{ url('admin/sekolah/import-sekolah') }}" wire:navigate
                        class="btn w-full btn-success btn-sm rounded text-white">
                        <i class="fa-solid fa-file-import"></i>
                        <span>
                            Import Excel
                        </span>
                    </a>
                </div>
                <label for="add-sekolah"
                    class="btn sm:w-auto w-full rounded btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                    <i class="fa-solid fa-square-plus"></i>
                    <span>Tambah Data</span>
                </label>
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
        <livewire:sekolah-table />

        <!-- Tambah Sekolah -->
        <input type="checkbox" id="add-sekolah" class="modal-toggle" />
        <div id="modal_matriks" class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-square-plus text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Tambah Sekolah</h3>
                    </div>
                    <label for="add-sekolah"  onclick="mapInputDelete()"
                        class="btn btn-sm btn-circle rounded-full shadow-none btn-ghost hover:bg-gray-200 dark:hover:bg-gray-700">
                        ✕
                    </label>
                </div>

                <form action="{{ route('admin.sekolah.store') }}" method="POST" class="space-y-2 ">
                    @csrf
                    <div class="space-y-2">
                        <!-- NPSN & Nama Sekolah -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label>NPSN</x-label>
                                <x-input type="text" id="npsn" name="npsn"  required />
                            </div>
                            <div>
                                <x-label>Nama Sekolah</x-label>
                                <x-input type="text" id="nama_sekolah" name="nama_sekolah"  required />
                            </div>
                        </div>

                        <!-- Jenjang & Status -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label>Jenjang</x-label>
                                <select name="jenjang" id="jenjang" class="w-full h-10 px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700
                            focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                            dark:bg-gray-900/20 dark:text-gray-200">
                                    <option value="">Pilih Jenjang</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="SMK">SMK</option>
                                </select>
                            </div>
                            <div>
                                <x-label >Status</x-label>
                                <select name="status" id="status" class="w-full px-3 py-2 h-10 rounded-md border border-gray-200 dark:border-gray-700
                            focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                            dark:bg-gray-900/20 dark:text-gray-200">
                                    <option value="">Pilih Status</option>
                                    <option value="NEGERI">Negeri</option>
                                    <option value="SWASTA">Swasta</option>
                                </select>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium dark:text-gray-300 mb-2">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="w-full px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700
                        focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                        dark:bg-gray-900/20 dark:text-gray-200" required></textarea>
                        </div>

                        <!-- Desa & Kecamatan -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label>Desa</x-label>
                                <x-input type="text" id="desa" name="desa"  required />
                            </div>
                            <div>
                                <x-label>Kecamatan</x-label>
                                <x-input type="text" id="kecamatan" name="kecamatan"  required />
                            </div>
                        </div>

                        <!-- Koordinat -->
                        <div>
                            <x-label>Koordinat</x-label>
                            <x-input type="text" id="koordinat" name="koordinat"/>
                        </div>
                        <!-- Map -->
                        <div id="map" class="w-full h-96"></div>
                    </div>

                    <div class="flex justify-end gap-3 mt-8 pt-4 border-t dark:border-gray-700">
                        <button type="submit"
                            class="px-4 btn py-2 bg-blue-600 text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                            Tambah
                        </button>
                        <label for="add-sekolah"  onclick="mapInputDelete()"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Tutup
                        </label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Sekolah -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal modal-top px-3">
            <div class="modal-box max-w-[52rem] mx-auto m-4 rounded-lg shadow-xl h-max dark:bg-gray-800 bg-white">
                <div class="flex justify-between items-center border-b pb-3 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-pen-to-square text-2xl text-primary"></i>
                        <h3 class="font-bold text-xl dark:text-gray-200">Edit Sekolah</h3>
                    </div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle btn-ghost rounded-full shadow-none hover:bg-gray-200 dark:hover:bg-gray-700">✕</label>
                </div>

                <form id="editForm" method="POST" class="pt-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-2">
                        <!-- NPSN & Nama Sekolah -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label>NPSN</x-label>
                                <x-input type="text" id="edit_npsn" name="npsn" required />
                            </div>
                            <div>
                                <x-label>Nama Sekolah</x-label>
                                <x-input type="text" id="namaSekolah" name="nama_sekolah" required />
                            </div>
                        </div>

                        <!-- Jenjang & Status -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label >Jenjang</x-label>
                                <select name="jenjang" id="edit_jenjang" class="w-full px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700
                            focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                            dark:bg-gray-900/20 h-10 dark:text-gray-200">
                                    <option value="">Pilih Jenjang</option>
                                    <option value="SD">SD</option>
                                    <option value="SMP">SMP</option>
                                    <option value="SMA">SMA</option>
                                    <option value="SMK">SMK</option>
                                </select>
                            </div>
                            <div>
                                <x-label>Status</x-label>
                                <select name="status" id="edit_status" class="w-full px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700
                            focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                            dark:bg-gray-900/20 h-10 dark:text-gray-200">
                                    <option value="">Pilih Status</option>
                                    <option value="NEGERI">Negeri</option>
                                    <option value="SWASTA">Swasta</option>
                                </select>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium dark:text-gray-300 mb-2">Alamat</label>
                            <textarea name="alamat" id="edit_alamat" rows="3" class="w-full px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700
                        focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                        dark:bg-gray-900/20 dark:text-gray-200" required></textarea>
                        </div>

                        <!-- Desa & Kecamatan -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <x-label>Desa</x-label>
                                <x-input type="text" id="edit_desa" name="desa" required />
                            </div>
                            <div>
                                <x-label >Kecamatan</x-label>
                                <x-input type="text" id="edit_kecamatan" name="kecamatan"  required />
                            </div>
                        </div>

                        <!-- Koordinat -->
                        <div>
                            <x-label class="block text-sm font-medium dark:text-gray-300 mb-2">Koordinat</x-label>
                            <x-input type="text" id="edit_koordinat" name="koordinat" class="w-full px-3 py-2 rounded-md border border-gray-200 dark:border-gray-700
                        focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent
                        dark:bg-gray-900/20 dark:text-gray-200"/>
                        </div>
                        <!-- Map -->
                        <div id="edit_map" class="w-full h-96"></div>
                    </div>

                    <div class="flex justify-end gap-3 mt-8 pt-4 border-t dark:border-gray-700">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 btn text-white rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                            Update
                        </button>
                        <label for="edit-modal"
                            class="px-4 btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                            Tutup
                        </label>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete Sekolah --}}
    <input type="checkbox" id="delete-sekolah" class="modal-toggle" />
    <div class="modal modal-top px-3">
        <div
            class="modal-box w-auto mt-3 mx-auto rounded-lg dark:text-white text-gray-800 bg-white dark:bg-gray-800">
            <h3 class="font-bold text-lg">Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus data ini?</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-action">
                        <x-danger-button type="submit">
                            <i class="fa-solid fa-trash"></i>
                            <span>Hapus</span>
                        </x-danger-button>
                        <label for="delete-sekolah" class="btn bg-white text-black dark:bg-gray-800 dark:text-white py-2 border border-gray-300 dark:border-gray-600 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Batal</label>
                </div>
            </form>
        </div>
    </div>

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Script for Sekolah -->
    <script>
        function setDeleteId(sekolah_id) {
            document.getElementById('deleteForm').action = `sekolah/${sekolah_id}`;
        }

        const maps = {};

        function handleEdit(data) {

            console.log(data)
            try {
                const sekolah = JSON.parse(data);
                console.log(sekolah);


                // Set values for regular inputs
                document.getElementById('edit_npsn').value = sekolah.npsn;
                document.getElementById('namaSekolah').value = sekolah.nama_sekolah;
                document.getElementById('edit_alamat').value = sekolah.alamat;
                document.getElementById('edit_desa').value = sekolah.desa;
                document.getElementById('edit_kecamatan').value = sekolah.kecamatan;
                document.getElementById('edit_koordinat').value = sekolah.koordinat;


                // Set posisi marker jika ada data koordinat
                if (sekolah.koordinat) {
                    const [lat, lng] = sekolah.koordinat.split(',').map(parseFloat);
                    if (!isNaN(lat) && !isNaN(lng)) {
                        const latLng = L.latLng(lat, lng);
                        if (maps['edit_map'].marker) {
                            maps['edit_map'].marker.setLatLng(latLng);
                        } else {
                            maps['edit_map'].marker = L.marker(latLng, { draggable: true }).addTo(maps['edit_map'].map);
                            maps['edit_map'].marker.on('dragend', function (event) {
                                const updatedLatLng = maps['edit_map'].marker.getLatLng();
                                const updatedKoordinat = `${updatedLatLng.lat.toFixed(13)},${updatedLatLng.lng.toFixed(13)}`;
                                document.getElementById('edit_koordinat').value = updatedKoordinat;
                            });
                        }
                        maps['edit_map'].map.setView(latLng, maps['edit_map'].map.getZoom());
                    }
                }

                const jenjangSelect = document.getElementById('edit_jenjang');
                Array.from(jenjangSelect.options).forEach(option => {
                    if (option.value == sekolah.jenjang) {
                        option.setAttribute("selected", true);
                    }
                });

                const statusSelect = document.getElementById('edit_status');
                Array.from(statusSelect.options).forEach(option => {
                    if (option.value == sekolah.status) {
                        option.setAttribute("selected", true);
                    }
                });

                document.getElementById('editForm').action = `sekolah/${sekolah.sekolah_id}`;

            } catch (error) {
                console.error('Error parsing or setting data:', error);
            }
        }


        function inisialisasiMap(mapId, inputId) {
            const map = L.map(mapId).setView([-7.7278427548606, 109.0095072984696], 10); //alun alun cilacap
            maps[mapId] = { map, marker: null };

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            map.on('click', function (event) {
                const latLng = event.latlng;
                const marker = maps[mapId].marker;

                if (!marker) {
                    maps[mapId].marker = L.marker(latLng, { draggable: true }).addTo(map);
                    maps[mapId].marker.on('dragend', function (event) {
                        const newLatLng = maps[mapId].marker.getLatLng();
                        const koordinat = `${newLatLng.lat.toFixed(13)},${newLatLng.lng.toFixed(13)}`;
                        document.getElementById(inputId).value = koordinat;
                    });
                } else {
                    marker.setLatLng(latLng);
                }

                document.getElementById(inputId).value = `${latLng.lat.toFixed(13)},${latLng.lng.toFixed(13)}`;
            });

            document.getElementById(inputId).addEventListener('input', function() {
                updateMarkerFromInput(map, maps[mapId].marker, inputId);
            });
        }

        function updateMarkerFromInput(map, marker, inputId) {
            const koordinat = document.getElementById(inputId).value;
            const [lat, lng] = koordinat.split(',').map(parseFloat);

            if (!isNaN(lat) && !isNaN(lng)) {
                const newLatLng = L.latLng(lat, lng);

                if (!marker) {
                    maps[mapId].marker = L.marker(newLatLng, { draggable: true }).addTo(map);
                    maps[mapId].marker.on('dragend', function (event) {
                        const updatedLatLng = maps[mapId].marker.getLatLng();
                        const updatedKoordinat = `${updatedLatLng.lat.toFixed(13)},${updatedLatLng.lng.toFixed(13)}`;
                        document.getElementById(inputId).value = updatedKoordinat;
                    });
                } else {
                    marker.setLatLng(newLatLng);
                }

                map.setView(newLatLng, map.getZoom());
            }
        }

        function mapInputDelete() {
            document.getElementById('koordinat').value = '';
            if (maps['map'] && maps['map'].marker) {
                maps['map'].map.removeLayer(maps['map'].marker);
                maps['map'].marker = null;
            }
        }

        // Inisialisasi peta
        inisialisasiMap('map', 'koordinat');
        inisialisasiMap('edit_map', 'edit_koordinat');
    </script>
</x-app-layout>
