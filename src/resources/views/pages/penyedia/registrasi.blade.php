<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Registration - LAKON PDK Kabupaten Cilacap</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">

    <header class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-sm shadow-sm z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <img src="https://2.bp.blogspot.com/-aEgbm1FL1mw/WVcXNvQWIwI/AAAAAAAALIw/IXb0Fh3SR807o3iRvs9Ed16PL7xom57sQCLcBGAs/s1600/Logo-Kabupaten-Cilacap.png"
                    alt="" width="32" height="32">
                <!-- Navigation -->
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="/" class="text-gray-800 hover:text-blue-600">Beranda</a></li>
                        <li><a href="https://lpse.cilacapkab.go.id" target="_blank"
                                class="text-gray-800 hover:text-blue-600">LPSE Cilacap</a></li>
                        <li><a href="/path-to-pdf/MANUAL_BOOK_PENGGUNA_web.pdf" target="_blank"
                                class="text-gray-800 hover:text-blue-600">SOP</a></li>
                    </ul>
                </nav>

                <!-- Login Button -->
                <a href="/login"
                    class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">
                    <i class='bx bx-log-in-circle mr-1'></i> Masuk
                </a>
            </div>
        </div>
    </header>
    <div class="container mx-auto px-4 py-8 pt-24">
        <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="flex justify-between border-b flex-wrap mb-6">
                    <img src="{{asset('images/logo-lakon.png')}}" alt="" class="mb-4" width="200">
                    <h1 class="text-2xl font-bold text-black">REGISTRASI PERUSAHAAN</h1>
                </div>
                @if (session('success'))
                    <div role="alert" class="alert alert-success text-white bg-green-700/70 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{session('success')}} Silahkan klik <a href="/login"
                                class="text-blue-900 font-bold border-b border-blue-800">Login/Masuk</a></span>
                    </div>
                    <script>
                        Toastify({
                            text: "{{ session('success') }}",
                            duration: 2000,
                            gravity: "top", // `top` or `bottom`
                            position: "center", // `left`, `center` or `right`
                            style: {
                                background: "linear-gradient(to right, #00b09b, #96c93d)", // Hijau untuk sukses
                            },
                        }).showToast();
                    </script>

                @endif
                <!-- error message -->

                @if (session('error'))

                    <div role="alert" class="alert text-white alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{session('error')}}</span>
                    </div>
                    <script>
                        Toastify({
                            text: "{{ session('error') }}",
                            duration: 2000,
                            gravity: "top",
                            position: "center",
                            style: {
                                background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                            },
                        }).showToast();
                    </script>

                @endif

                <form action="{{route('registrasi.store')}}" method="POST" enctype="multipart/form-data"
                      class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">
                                NIK <span class="text-red-500">*</span>
                                <small class="block text-xs text-gray-500">Nomor Induk Kependudukan
                                    Pemilik/Direktur</small>
                            </label>
                            <input type="number" name="NIK" value="{{ old('NIK') }}" class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-blue-200
                            @error('NIK') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nomor Induk Kependudukan">
                            @error('NIK')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Nama <span class="text-red-500">*</span>
                                <small class="block text-xs text-gray-500">Nama Wakil Sah Perusahaan</small>
                            </label>
                            <input type="text" name="nama_pemilik" value="{{ old('nama_pemilik') }}" class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-blue-200
                            @error('nama_pemilik') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nama Pemilik/Direktur sesuai KTP" />
                            @error('nama_pemilik')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="md:col-span-1">
                            <label class="block te.xt-sm font-medium text-gray-700">
                                Jabatan <span class="text-red-500">*</span>
                                <small class="block text-xs text-gray-500">Jabatan Wakil Sah</small>
                            </label>
                            <input type="text" name="jabatan" value="{{ old('jabatan') }}" class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-blue-200
                            @error('jabatan') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Jabatan Wakil Sah Perusahaan" />
                            @error('jabatan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Alamat <span class="text-red-500">*</span>
                            <small class="block text-xs text-gray-500">Alamat Pemilik/Direktur Perusahaan</small>
                        </label>
                        <textarea name="alamat_pemilik" class="mt-1 block w-full rounded-md shadow-sm focus:ring focus:ring-blue-200
                       @error('alamat_pemilik') border-red-500 @else border-gray-300 @enderror" rows="3"
                            placeholder="Alamat lengkap Pemilik/Direktur sesuai dengan KTP">{{ old('alamat_pemilik') }}</textarea>
                        @error('alamat_pemilik')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Perusahaan (lengkap) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_perusahaan_lengkap" value="{{old('nama_perusahaan_lengkap')}}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('nama_perusahaan_lengkap') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nama Lengkap Perusahaan" required>
                            @error('nama_perusahaan_lengkap')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Perusahaan (singkat) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_perusahaan_singkat" value="{{old('nama_perusahaan_singkat')}}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('nama_perusahaan_singkat') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nama Singkat Perusahaan" required>
                            @error('nama_perusahaan_singkat')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Akta Notaris <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <input type="text" name="akta_notaris_no" value="{{old('akta_notaris_no')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('akta_notaris_no') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="Nomor Akta Notaris" required>
                                @error('akta_notaris_no')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <input type="text" name="akta_notaris_nama" value="{{old('akta_notaris_nama')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('akta_notaris_nama') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="Nama Notaris" required>
                                @error('akta_notaris_nama')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <input type="date" name="akta_notaris_tanggal" value="{{old('akta_notaris_tanggal')}}"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('akta_notaris_tanggal') border-red-500 @else border-gray-300 @enderror"
                                    placeholder="Tanggal Notaris" required>
                                @error('akta_notaris_tanggal')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Alamat Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alamat_perusahaan" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                            @error('alamat_perusahaan') border-red-500 @else border-gray-300 @enderror" rows="3"
                            placeholder="Alamat lengkap perusahaan" required>{{old('alamat_perusahaan')}}</textarea>
                        @error('alamat_perusahaan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                No. Telepon Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="kontak_hp" value="{{old('kontak_hp')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('kontak_hp') border-red-500 @else border-gray-300 @enderror"
                                placeholder="No. Telp Perusahaan" required>
                            @error('kontak_hp')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Email Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="kontak_email" value="{{old('kontak_email')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('kontak_email') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Email Perusahaan" required>
                            @error('kontak_email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                NPWP Perusahaan <span class="text-red-500">*</span>
                                <small class="block text-xs text-gray-500">Nomor Pokok Wajib Pajak</small>
                            </label>
                            <input type="text" name="npwp_perusahaan" value="{{old('npwp_perusahaan')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('npwp_perusahaan') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nomor Pokok Wajib Pajak" required id="npwp_perusahaan">
                            @error('npwp_perusahaan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Logo Perusahaan
                                <small class="block text-xs text-gray-500">Unggah logo perusahaan (maks. 2MB)</small>
                            </label>
                            <input type="file" name="logo_perusahaan" accept="image/png, image/jpg, image/jpeg" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 border p-1  file:rounded-md rounded-md file:border-0
                                file:text-sm file:font-medium
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100
                                @error('logo_perusahaan') border-red-500 @else border-gray-300 @enderror"
                                value="{{old('logo_perusahaan')}}">
                            @error('logo_perusahaan')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nomor Rekening <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="rekening_norek" value="{{old('rekening_norek')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('rekening_norek') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nomor Rekening" required>
                            @error('rekening_norek')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Nama Rekening <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="rekening_nama" value="{{old('rekening_nama')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('rekening_nama') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nama Pemilik Rekening" required>
                            @error('rekening_nama')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Bank <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="rekening_bank" value="{{old('rekening_bank')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('rekening_bank') border-red-500 @else border-gray-300 @enderror"
                                placeholder="Nama Bank" required>
                            @error('rekening_bank')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="border-t pt-5 flex flex-col gap-2">
                        <h2 class="font-bold">Registrasi akun</h2>
                        <div>
                            <label for="name">
                                username <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" required placeholder="Nama" value="{{old('name')}}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('name') border-red-500 @else border-gray-300 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email">
                                email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" required placeholder="Email" value="{{old('email')}}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('email') border-red-500 @else border-gray-300 @enderror">

                            @error('email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password">
                                password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password" required placeholder="Password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('password') border-red-500 @else border-gray-300 @enderror">
                            @error('password')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation">
                                Konfirmasi password <span class="text-red-500">*</span>
                            </label>
                            <input type="password" name="password_confirmation" required
                                placeholder="Konfirmasi Password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200
                                @error('password_confirmation') border-red-500 @else border-gray-300 @enderror">

                            @error('password_confirmation')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Pernyataan <span class="text-red-500">*</span>
                        </label>
                        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-md mb-4">
                            <p class="text-sm text-yellow-800">
                                Dengan ini saya menyatakan bahwa data yang saya sampaikan adalah benar sesuai dengan
                                fakta yang ada, dan apabila dikemudian hari data perusahaan yang saya sampaikan tidak
                                benar, maka saya bersedia untuk diproses secara hukum sesuai dengan ketentuan
                                Undang-Undang yang berlaku.
                            </p>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" name="konfirmasi_pernyataan"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                            <label class="ml-2 block text-sm text-gray-900">
                                Saya setuju dengan pernyataan di atas
                            </label>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-4">
                        <a href="/login"
                            class="btn bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Sudah Memiliki Akun
                        </a>
                        <button type="submit"
                            class="btn bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                            </svg>
                            Registrasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <footer class="text-center mt-6 text-gray-600">
            <p>
                <strong>eKONTRAK</strong> © 2022
                <a href="#" class="text-blue-500 hover:underline">
                    Dinas Pendidikan Dan Kebudayaan
                </a>
                Kabupaten Cilacap. All Rights Reserved
            </p>
        </footer>
    </div>
</body>

</html>

<script>
    const input = document.getElementById('npwp_perusahaan');

    input.addEventListener('input', function (e) {
        const cursorPos = input.selectionStart;
        const oldValue = input.value;

        // Hapus semua non-digit
        let numbers = oldValue.replace(/\D/g, '');

        // Batasi panjang NPWP
        if (numbers.length > 15) numbers = numbers.slice(0, 15);

        // Format: 12.345.678.9-012.345
        let parts = [];
        if (numbers.length > 0) parts.push(numbers.slice(0, 2));
        if (numbers.length >= 3) parts.push(numbers.slice(2, 5));
        if (numbers.length >= 6) parts.push(numbers.slice(5, 8));
        if (numbers.length >= 9) parts.push(numbers.slice(8, 9));
        if (numbers.length >= 10) parts.push(numbers.slice(9, 12));
        if (numbers.length >= 13) parts.push(numbers.slice(12, 15));

        let formatted = '';
        if (numbers.length <= 2) {
            formatted = parts[0];
        } else if (numbers.length <= 5) {
            formatted = `${parts[0]}.${parts[1]}`;
        } else if (numbers.length <= 8) {
            formatted = `${parts[0]}.${parts[1]}.${parts[2]}`;
        } else if (numbers.length <= 9) {
            formatted = `${parts[0]}.${parts[1]}.${parts[2]}.${parts[3]}`;
        } else if (numbers.length <= 12) {
            formatted = `${parts[0]}.${parts[1]}.${parts[2]}.${parts[3]}-${parts[4]}`;
        } else {
            formatted = `${parts[0]}.${parts[1]}.${parts[2]}.${parts[3]}-${parts[4]}.${parts[5]}`;
        }

        // Set ulang value
        input.value = formatted || '';
    });
    </script>
