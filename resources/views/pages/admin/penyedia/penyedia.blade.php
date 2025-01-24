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
                    text: "{{ session('success') }}",
                    duration: 2000,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    style: {
                        background: "linear-gradient(to right, #00b09b, #96c93d)", // Hijau untuk sukses
                    },
                }).showToast();
            </script>

        @endif
        <!-- error message -->

        @if (session('error'))
            <script>
                Toastify({
                    text: "{{ session('error') }}",
                    duration: 2000,
                    gravity: "top",
                    position: "right",
                    style: {
                        background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                    },
                }).showToast();
            </script>
        @endif

        <!-- Table -->
        <div class="bg-white dark:bg-gray-800 rounded-lg">
            <div class="p-3 overflow-x-auto">
                <div id="filter-container" class="mb-4"></div>
                <table id="penyediaTable" class="table w-full rounded-lg">
                    <thead class="bg-gray-300/10 rounded-full">
                        <tr class="border-none">
                            <th class="dark:text-white">No</th>
                            <th class="dark:text-white">Nama Perusahaan</th>
                            <th class="dark:text-white">Kontak</th>
                            <th class="dark:text-white">Alamat</th>
                            <th class="dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penyedia as $i => $p)
                            <tr class="border-gray-500/20">

                                <td>{{$i + 1}}</td>
                                <td>{{$p->nama_perusahaan_lengkap}}</td>
                                <td>{{$p->kontak_hp}} / {{$p->kontak_email}}</td>
                                <td>{{$p->alamat_perusahaan}}</td>
                                <td>
                                    <label for="edit-modal" class="btn text-gray-200 btn-sm btn-warning" onclick="editPenyedia(
                                       {{ $p->penyedia_id }},
                                        `{{ $p->NIK }}`,
                                        `{{ $p->nama_pemilik }}`,
                                        `{{ $p->alamat_pemilik ?? '' }}`,
                                        `{{ $p->nama_perusahaan_lengkap ?? '' }}`,
                                        `{{ $p->nama_perusahaan_singkat ?? '' }}`,
                                        `{{ $p->akta_notaris_no ?? '' }}`,
                                        `{{ $p->akta_notaris_nama ?? '' }}`,
                                        `{{ $p->akta_notaris_tanggal ?? '' }}`,
                                        `{{ $p->alamat_perusahaan ?? '' }}`,
                                        '{{ $p->kontak_hp ?? '' }}',
                                        '{{ $p->kontak_email ?? '' }}',
                                        '{{ $p->rekening_norek ?? '' }}',
                                        '{{ $p->rekening_nama ?? '' }}',
                                        '{{ $p->rekening_bank ?? '' }}',
                                        '{{ $p->npwp_perusahaan ?? '' }}'

                                    )">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </label> 

                                    <label for="delete-modal" class="btn text-white btn-sm btn-error"
                                        onclick="setDeleteId({{ $p->penyedia_id }})">
                                        <i class="fa-solid fa-trash"></i>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-10/12 max-w-3xl rounded dark:bg-gray-800 bg-gray-100">
                <h3 class="font-bold text-lg">EDIT DATA PENYEDIA</h3>
                <div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle font-bold mt-2 btn-ghost absolute right-2 top-2">X</label>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <!-- NIK -->
                    <div class="form-control">
                        <label class="label">NIK</label>
                        <input type="text" id="edit_nik" name="NIK" class="bg-gray-200 dark:bg-gray-700 rounded"
                            required />
                    </div>
                    <!-- Nama Pemilik -->
                    <div class="form-control">
                        <label class="label">Nama Pemilik</label>
                        <input type="text" id="edit_nama_pemilik" name="nama_pemilik"
                            class="bg-gray-200 dark:bg-gray-700 rounded" required />
                    </div>
                    <!-- Alamat Pemilik -->
                    <div class="form-control">
                        <label class="label">Alamat Pemilik</label>
                        <textarea id="edit_alamat_pemilik" name="alamat_pemilik"
                            class="bg-gray-200 dark:bg-gray-700 rounded"></textarea>
                    </div>
                    <!-- Nama Perusahaan Lengkap -->
                    <div class="form-control">
                        <label class="label">Nama Perusahaan Lengkap</label>
                        <input type="text" id="edit_nama_perusahaan_lengkap" name="nama_perusahaan_lengkap"
                            class="bg-gray-200 dark:bg-gray-700 rounded" required />
                    </div>
                    <!-- Nama Perusahaan Singkat -->
                    <div class="form-control">
                        <label class="label">Nama Perusahaan Singkat</label>
                        <input type="text" id="edit_nama_perusahaan_singkat" name="nama_perusahaan_singkat"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <!-- Akta Notaris -->
                    <div class="form-control">
                        <label class="label">Akta Notaris No</label>
                        <input type="text" id="edit_akta_notaris_no" name="akta_notaris_no"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Akta Notaris Nama</label>
                        <input type="text" id="edit_akta_notaris_nama" name="akta_notaris_nama"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Akta Notaris Tanggal</label>
                        <input type="date" id="edit_akta_notaris_tanggal" name="akta_notaris_tanggal"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <!-- Alamat Perusahaan -->
                    <div class="form-control">
                        <label class="label">Alamat Perusahaan</label>
                        <textarea id="edit_alamat_perusahaan" name="alamat_perusahaan"
                            class="bg-gray-200 dark:bg-gray-700 rounded"></textarea>
                    </div>
                    <!-- Kontak -->
                    <div class="form-control">
                        <label class="label">Kontak HP</label>
                        <input type="text" id="edit_kontak_hp" name="kontak_hp"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Kontak Email</label>
                        <input type="email" id="edit_kontak_email" name="kontak_email"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <!-- Rekening -->
                    <div class="form-control">
                        <label class="label">No Rekening</label>
                        <input type="text" id="edit_rekening_norek" name="rekening_norek"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Nama Rekening</label>
                        <input type="text" id="edit_rekening_nama" name="rekening_nama"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Bank</label>
                        <input type="text" id="edit_rekening_bank" name="rekening_bank"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <!-- NPWP -->
                    <div class="form-control">
                        <label class="label">NPWP Perusahaan</label>
                        <input type="text" id="edit_npwp_perusahaan" name="npwp_perusahaan"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>

                    <div class="form-control">
                        <label class="label">Logo Perusahaan</label>
                        <input type="file" id="logo_perusahaan" name="logo_perusahaan"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <!-- Modal Action -->
                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Update</button>
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
        $(document).ready(function () {
            var table = $('#penyediaTable').DataTable({
            responsive: true,
            language: {
                lengthMenu: '_MENU_',
                search: "",
                searchPlaceholder: "search.."
            },
            layout: {
                topEnd: 'pageLength',
                topStart: 'search'
            },
            dom: '<"flex justify-between items-center mb-4"<"text-gray-600 dark:text-gray-400"f><"flex space-x-4"l>>' +
                '<"overflow-auto"t>' +
                '<"flex justify-between items-center mt-4"<"text-gray-600 dark:text-gray-400"i><"pagination-container"p>>',
            initComplete: function () {
                this.api().columns([1, 2, 3]).every(function () {
                    var column = this;
                    var select = $('<br class="mb-2"/><select class="select select-sm text-xs bg-white dark:bg-gray-100/20 w-full"><option value=""></option></select>')
                        .appendTo($(column.header()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );

                            column
                                .search(val ? '^' + val + '$' : '', true, false)
                                .draw();
                        });

                    column.data().unique().sort().each(function (d, j) {
                        select.append('<option value="' + d + '">' + d + '</option>')
                    });
                });
            }
        });

            $('#dt-length-0').removeClass('px-3 py-2');
            $('#dt-length-0').addClass('select select-sm p-0 px-5 bg-white dark:bg-gray-800');
            $('<p> item</p>').appendTo('#dt-length-0 option');
            $('.dt-search').addClass('text-xs');
            $('.dt-search input').removeClass('px-3 py-2');
            $('.dt-search input').addClass('p-1 rounded w-52');
        });


        function editPenyedia(penyedia_id, nik, nama_pemilik, 
                            alamat_pemilik, nama_perusahaan_lengkap, 
                            nama_perusahaan_singkat, akta_notaris_no, akta_notaris_nama, 
                            akta_notaris_tanggal, alamat_perusahaan, kontak_hp,
                            kontak_email, rekening_norek, rekening_nama, rekening_bank, npwp_perusahaan
        ){
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
            // document.getElementById('logo_perusahaan').value = logo_perusahaan;
        }

        function setDeleteId(penyedia_id) {
            document.getElementById('deleteForm').action = `penyedia/${penyedia_id}`;
        }
    </script>

</x-app-layout>