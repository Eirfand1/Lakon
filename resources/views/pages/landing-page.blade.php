<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAKON PDK Kabupaten Cilacap</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Jost:300,400,500,600,700|Poppins:300,400,500,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>
<body class="font-[Poppins]">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-sm shadow-sm z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <img src="https://2.bp.blogspot.com/-aEgbm1FL1mw/WVcXNvQWIwI/AAAAAAAALIw/IXb0Fh3SR807o3iRvs9Ed16PL7xom57sQCLcBGAs/s1600/Logo-Kabupaten-Cilacap.png" alt="" width="32" height="32">
                <!-- Navigation -->
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="/" class="text-gray-800 hover:text-blue-600">Beranda</a></li>
                        <li><a href="https://lpse.cilacapkab.go.id" target="_blank" class="text-gray-800 hover:text-blue-600">LPSE Cilacap</a></li>
                        <li><a href="/path-to-pdf/MANUAL_BOOK_PENGGUNA_web.pdf" target="_blank" class="text-gray-800 hover:text-blue-600">SOP</a></li>
                    </ul>
                </nav>

                <!-- Login Button -->
                <a href="/login" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">
                    <i class='bx bx-log-in-circle mr-1'></i> Masuk
                </a>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="pt-24 bg-cover bg-center bg-no-repeat bg-[url({{asset('images/laut.jpg')}})] pb-12 text-white">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-5xl font-bold leading-tight bg-black/50 inline-block p-4">
                        PELAKSANAAN KEGIATAN YANG AMAN DAN TRANSPARAN.
                    </h1>
                    <a href="/registrasi" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition-colors">
                        Belum memiliki akun? Ayo Daftarkan Perusahaan Anda!
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Verification Check Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto space-y-4 mb-12">
                <h2 class="text-3xl font-bold text-gray-800">CEK VERIFIKASI PERUSAHAAN</h2>
                <p class="text-gray-600">Cek status verifikasi Perusahaan anda dengan memasukkan <i>NPWP</i>.</p>
            </div>

            <div class="max-w-xl mx-auto">
                <form class="space-y-6">
                    <div>
                        <label class="block text-gray-700 mb-2">
                            NPWP <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="Masukkan NPWP Perusahaan Anda lengkap beserta tanda (-) dan titik(.) .">
                    </div>
                    <button type="button"
                            class="w-full bg-red-600 text-white py-3 rounded-lg font-medium hover:bg-red-700 transition-colors">
                        CEK STATUS
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center space-y-4">
                <div>
                    <strong>LAKON PDK</strong> © 2022
                    <a href="https://pdk.cilacapkab.go.id" class="text-blue-400 hover:text-blue-300">
                        Dinas Pendidikan Dan Kebudayaan
                    </a>
                    Kabupaten Cilacap. All Rights Reserved
                </div>
                <div class="text-gray-400">
                    Version 1.10.2022.01 Beta
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="fixed bottom-4 right-4 bg-blue-600 text-white p-3 rounded-full shadow-lg hover:bg-blue-700 transition-colors hidden">
        <i class='bx bx-up-arrow-alt text-xl'></i>
    </button>
</body>
</html>
