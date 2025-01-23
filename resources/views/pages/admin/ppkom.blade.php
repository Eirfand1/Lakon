<x-app-layout>
    <div class="p-5">
        <div class="sm:flex sm:justify-between sm:items-center p-2 pb-5">
            <div class="">
                <h1 class="text-2xl text-gray-800 dark:text-gray-100 font-bold">PPKOM</h1>
            </div>
            <!-- Add Button -->
            <label for="add-modal" class="btn btn-sm px-3 text-white dark:bg-gray-100 dark:text-gray-800 ">
                <i class="fa-solid fa-square-plus"></i>
                <span>Tambah Data</span>
            </label>
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
                <table id="ppkomTable" class="table w-full rounded-lg">
                    <thead class="bg-gray-300/10 rounded-full">
                        <tr class="border-none">
                            <th class="dark:text-white">No</th>
                            <th class="dark:text-white">NIP</th>
                            <th class="dark:text-white">Nama</th>
                            <th class="dark:text-white">Pangkat</th>
                            <th class="dark:text-white">Jabatan</th>
                            <th class="dark:text-white">Alamat</th>
                            <th class="dark:text-white">No. Telp</th>
                            <th class="dark:text-white">Email</th>
                            <th class="dark:text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ppkom as $i => $p)
                            <tr class="border-gray-500/20">

                                <td>{{$i + 1}}</td>
                                <td>{{$p->nip}}</td>
                                <td>{{$p->nama}}</td>
                                <td>{{$p->pangkat}}</td>
                                <td>{{$p->jabatan}}</td>
                                <td>{{$p->alamat}}</td>
                                <td>{{$p->no_telp}}</td>
                                <td>{{$p->email}}</td>
                                <td>
                                    <label for="edit-modal" class="btn text-gray-200  btn-sm btn-warning" onclick="editPpkom({{ $p->ppkom_id }}, '{{ $p->nip }}', '{{ $p->nama }}',
                                            '{{ $p->pangkat }}', '{{ $p->jabatan }}', '{{ $p->alamat }}',
                                            '{{ $p->no_telp }}', '{{ $p->email }}')">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </label>
                                    <label for="delete-modal" class="btn text-white btn-sm btn-error"
                                        onclick="setDeleteId({{ $p->ppkom_id }})">
                                        <i class="fa-solid fa-trash"></i>
                                    </label>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Modal -->
        <input type="checkbox" id="add-modal" class="modal-toggle" />
        <div id="modal_ppkom" class="modal">
            <div class="modal-box w-10/12 max-w-2xl rounded  dark:bg-gray-800 bg-gray-100">
                <div>
                    <label for="add-modal"
                        class="btn btn-sm btn-circle font-bold mt-2 btn-ghost absolute right-2 top-2">X</label>
                </div>
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-square-plus text-xl"></i>
                    <h3 class="font-bold text-xl">FORM TAMBAH DATA PPKOM</h3>
                </div>
                <form action="{{ route('adm.ppkom.store') }}" method="POST" class="border-t border-violet-800/40 mt-4">
                    @csrf
                    <div class="form-control">
                        <label class="label">NIP</label>
                        <input type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '')" name="nip"
                            class="bg-gray-200 dark:bg-gray-700 rounded" required />
                    </div>
                    <div class="form-control">
                        <label class="label">Nama</label>
                        <input type="text" name="nama" class="bg-gray-200 dark:bg-gray-700 rounded" required />
                    </div>
                    <div class="form-control">
                        <label class="label">Pangkat</label>
                        <input type="text" name="pangkat" class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Jabatan</label>
                        <input type="text" name="jabatan" class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Alamat</label>
                        <textarea name="alamat" class="bg-gray-200 dark:bg-gray-700 rounded"></textarea>
                    </div>
                    <div class="form-control">
                        <label class="label">No. Telp</label>
                        <input type="text" name="no_telp" class="bg-gray-200 dark:bg-gray-700 rounded " />
                    </div>
                    <div class="form-control">
                        <label class="label">Email</label>
                        <input type="email" name="email" class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="modal-action">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <label for="add-modal" class="btn">Tutup</label>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        <input type="checkbox" id="edit-modal" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-10/12 max-w-2xl rounded  dark:bg-gray-800 bg-gray-100">
                <h3 class="font-bold text-lg">EDIT DATA PPKOM</h3>
                <div>
                    <label for="edit-modal"
                        class="btn btn-sm btn-circle font-bold mt-2 btn-ghost absolute right-2 top-2">X</label>
                </div>
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-control">
                        <label class="label">NIP</label>
                        <input type="number" id="edit_nip" name="nip" class="bg-gray-200 dark:bg-gray-700 rounded"
                            required />
                    </div>
                    <div class="form-control">
                        <label class="label">Nama</label>
                        <input type="text" id="edit_nama" name="nama" class="bg-gray-200 dark:bg-gray-700 rounded"
                            required />
                    </div>
                    <div class="form-control">
                        <label class="label">Pangkat</label>
                        <input type="text" id="edit_pangkat" name="pangkat"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Jabatan</label>
                        <input type="text" id="edit_jabatan" name="jabatan"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Alamat</label>
                        <textarea id="edit_alamat" name="alamat"
                            class="bg-gray-200 dark:bg-gray-700 rounded"></textarea>
                    </div>
                    <div class="form-control">
                        <label class="label">No. Telp</label>
                        <input type="text" id="edit_no_telp" name="no_telp"
                            class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
                    <div class="form-control">
                        <label class="label">Email</label>
                        <input type="email" id="edit_email" name="email" class="bg-gray-200 dark:bg-gray-700 rounded" />
                    </div>
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

    <!-- Script for PPkom Table -->
    <script>
        $(document).ready(function () {
            $('#ppkomTable').DataTable({
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

            });
            $('#dt-length-0').removeClass('px-3 py-2');
            $('#dt-length-0').addClass('select select-sm p-0 px-5 bg-white dark:bg-gray-800');
            $('<p> item</p>').appendTo('#dt-length-0 option');
            $('.dt-search').addClass('text-xs');
            $('.dt-search input').removeClass('px-3 py-2');
            $('.dt-search input').addClass('p-1 rounded w-52');
        });

        function editPpkom(ppkom_id, nip, nama, pangkat, jabatan, alamat, no_telp, email) {
            document.getElementById('editForm').action = `ppkom/${ppkom_id}`;
            document.getElementById('edit_nip').value = nip;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_pangkat').value = pangkat;
            document.getElementById('edit_jabatan').value = jabatan;
            document.getElementById('edit_alamat').value = alamat;
            document.getElementById('edit_no_telp').value = no_telp;
            document.getElementById('edit_email').value = email;
        }

        function setDeleteId(ppkom_id) {
            document.getElementById('deleteForm').action = `ppkom/${ppkom_id}`;
        }
    </script>

</x-app-layout>