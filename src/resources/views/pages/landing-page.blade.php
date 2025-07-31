<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SEO Improvements -->
    <title>LAKON PDK Kabupaten Cilacap | Portal Pelayanan Dinas Pendidikan dan Kebudayaan</title>
    <meta name="description"
        content="Portal resmi LAKON PDK Kabupaten Cilacap untuk pelaksanaan kegiatan yang aman dan transparan. Cek status verifikasi perusahaan dan akses layanan pendidikan.">
    <meta name="keywords"
        content="LAKON PDK, Cilacap, Dinas Pendidikan, Kebudayaan, verifikasi perusahaan, LPSE, Kabupaten Cilacap">
    <meta name="author" content="Dinas Pendidikan dan Kebudayaan Kabupaten Cilacap">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Tags -->
    <meta property="og:title" content="LAKON PDK Kabupaten Cilacap">
    <meta property="og:description"
        content="Portal resmi untuk pelaksanaan kegiatan yang aman dan transparan pada Dinas Pendidikan dan Kebudayaan Kabupaten Cilacap">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://pdk.cilacapkab.go.id">
    <meta property="og:image"
        content="https://2.bp.blogspot.com/-aEgbm1FL1mw/WVcXNvQWIwI/AAAAAAAALIw/IXb0Fh3SR807o3iRvs9Ed16PL7xom57sQCLcBGAs/s1600/Logo-Kabupaten-Cilacap.png">

    <!-- Favicon -->
    <link rel="icon"
        href="{{asset('images/Logo-Cilacap.png')}}"
        type="image/png">

    <!-- External CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                        'heading': ['Jost', 'sans-serif'],
                    },
                    animation: {
                        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'spin-slow': 'spin 3s linear infinite',
                        'bounce-slow': 'bounce 2s infinite',
                    }
                }
            }
        }
    </script>

    <!-- Font -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Jost:300,400,500,600,700|Poppins:300,400,500,600,700"
        rel="stylesheet">

    <!-- Icons -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <style>
        /* Loading Animation */
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        .loader {
            position: relative;
            width: 120px;
            height: 120px;
        }

        .loader-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: auto;
            height: 60px;
            z-index: 2;
        }

        .loader-circle {
            width: 120px;
            height: 120px;
            border: 4px solid transparent;
            border-top-color: #2563eb;
            border-radius: 50%;
            animation: spin 1.5s linear infinite;
        }

        .loader-inner-circle {
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border: 4px solid transparent;
            border-top-color: #60a5fa;
            border-radius: 50%;
            animation: spin 1s linear infinite reverse;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Smooth scroll behavior */
        html {
            scroll-behavior: smooth;
        }

        /* Hero section background overlay */
        .hero-overlay {
            background: linear-gradient(to right, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.4));
        }

        /* Custom animations */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #2563eb;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body class="font-sans text-gray-800 antialiased">
    <!-- Loading Screen -->
    <div class="loader-container" id="loader">
        <div class="loader">
            <img src="{{asset('images/Logo-Cilacap.png')}}"
                alt="Logo Kabupaten Cilacap" class="loader-logo">
            <div class="loader-circle"></div>
            <div class="loader-inner-circle"></div>
        </div>
    </div>

    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-sm shadow-md z-50 transition-all duration-300"
        id="header">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16 md:h-20">
                <!-- Logo and Title -->
                <a href="/" class="flex items-center space-x-3">
                    <img src="{{asset('images/Logo-Cilacap.png')}}"
                        alt="Logo Kabupaten Cilacap" class="w-auto h-9">
                    <div class="hidden md:block">
                        <h1 class="text-lg font-bold text-gray-800">LAKON PDK</h1>
                        <p class="text-xs text-gray-600">Kabupaten Cilacap</p>
                    </div>
                </a>

                <!-- Navigation -->
                <nav class="hidden md:block">
                    <ul class="flex space-x-8">
                        <li><a href="/"
                                class="text-gray-800 hover:text-primary-600 font-medium transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-primary-600 after:transition-all hover:after:w-full">Beranda</a>
                        </li>
                        <li><a href="https://lpse.cilacapkab.go.id" target="_blank"
                                class="text-gray-800 hover:text-primary-600 font-medium transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-primary-600 after:transition-all hover:after:w-full">LPSE
                                Cilacap</a></li>
                        <li><a href="/path-to-pdf/MANUAL_BOOK_PENGGUNA_web.pdf" target="_blank"
                                class="text-gray-800 hover:text-primary-600 font-medium transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-0.5 after:w-0 after:bg-primary-600 after:transition-all hover:after:w-full">SOP</a>
                        </li>
                    </ul>
                </nav>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-800 focus:outline-none" id="mobile-menu-button">
                    <i class='bx bx-menu text-2xl'></i>
                </button>

                <!-- Login Button -->
                <a href="/login"
                    class="hidden md:flex items-center bg-primary-600 text-white px-6 py-2 rounded-full hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg">
                    <i class='bx bx-log-in-circle mr-2'></i> Masuk
                </a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="md:hidden bg-white shadow-md absolute w-full left-0 top-16 z-20 hidden" id="mobile-menu">
            <nav class="container mx-auto px-4 py-4">
                <ul class="space-y-4">
                    <li><a href="/" class="block text-gray-800 hover:text-primary-600 py-2">Beranda</a></li>
                    <li><a href="https://lpse.cilacapkab.go.id" target="_blank"
                            class="block text-gray-800 hover:text-primary-600 py-2">LPSE Cilacap</a></li>
                    <li><a href="/path-to-pdf/MANUAL_BOOK_PENGGUNA_web.pdf" target="_blank"
                            class="block text-gray-800 hover:text-primary-600 py-2">SOP</a></li>
                    <li class="pt-2">
                        <a href="/login"
                            class="flex items-center justify-center bg-primary-600 text-white px-6 py-2 rounded-full hover:bg-primary-700 transition-colors">
                            <i class='bx bx-log-in-circle mr-2'></i> Masuk
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-32 bg-cover bg-center bg-no-repeat min-h-[80vh] flex items-center text-white"
        style="background-image: url('{{ asset('images/clp.jpg') }}')">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-block px-4 py-1 bg-primary-600 rounded-full text-sm font-semibold">Dinas
                        Pendidikan Dan Kebudayaan</div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight">
                        PELAKSANAAN KEGIATAN YANG <span class="text-primary-400">AMAN DAN TRANSPARAN.</span>
                    </h1>
                    <p class="text-lg text-gray-200 max-w-xl">
                        Portal resmi untuk pelaksanaan kegiatan pada Dinas Pendidikan dan Kebudayaan Kabupaten Cilacap
                        yang menjamin transparansi dan keamanan.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="/login"
                            class="inline-flex items-center justify-center bg-primary-600 text-white px-8 py-3 rounded-full font-medium hover:bg-primary-700 transition-colors shadow-lg">
                            <i class='bx bx-log-in-circle mr-2'></i> Masuk
                        </a>
                        <a href="/registrasi"
                            class="inline-flex items-center justify-center bg-white text-primary-700 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition-colors">
                            <i class='bx bx-user-plus mr-2'></i> Daftarkan Perusahaan
                        </a>
                    </div>
                </div>
                <div class="hidden md:block" data-aos="fade-left" data-aos-duration="1000">
                    <div class="relative">
                        <div class="absolute -inset-4 bg-primary-600/20 rounded-lg blur-xl animate-pulse-slow"></div>
                        <div
                            class="relative bg-white/10 backdrop-blur-sm p-6 rounded-lg border border-white/20 shadow-xl">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <div class="text-sm">Portal LAKON PDK</div>
                            </div>
                            <div class="space-y-4">
                                <div class="h-8 bg-white/20 rounded"></div>
                                <div class="grid grid-cols-3 gap-2">
                                    <div class="col-span-2 h-24 bg-white/20 rounded"></div>
                                    <div class="h-24 bg-white/20 rounded"></div>
                                </div>
                                <div class="h-32 bg-white/20 rounded"></div>
                                <div class="flex justify-end">
                                    <div class="h-10 w-32 bg-primary-500/50 rounded-full"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1"
                    d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,149.3C1248,139,1344,117,1392,106.7L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
                </path>
            </svg>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-sm font-semibold text-primary-600 uppercase tracking-wider">Fitur Utama</h2>
                <h3 class="mt-2 text-3xl leading-8 font-bold tracking-tight text-gray-900 sm:text-4xl">Layanan Yang Kami
                    Sediakan</h3>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 mx-auto">
                    LAKON PDK menyediakan berbagai layanan untuk memudahkan pelaksanaan kegiatan di lingkungan Dinas
                    Pendidikan dan Kebudayaan Kabupaten Cilacap.
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow"
                    data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <i class='bx bx-check-shield text-2xl text-primary-600'></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Verifikasi Perusahaan</h3>
                    <p class="text-gray-600">Cek status verifikasi perusahaan Anda dengan mudah menggunakan NPWP secara
                        cepat dan akurat.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow"
                    data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <i class='bx bx-file text-2xl text-primary-600'></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pendaftaran Online</h3>
                    <p class="text-gray-600">Daftarkan perusahaan Anda secara online tanpa harus datang ke kantor kami.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-6 rounded-xl shadow-md border border-gray-100 hover:shadow-lg transition-shadow"
                    data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mb-4">
                        <i class='bx bx-search-alt text-2xl text-primary-600'></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Transparansi Informasi</h3>
                    <p class="text-gray-600">Akses semua informasi terkait pelaksanaan kegiatan secara transparan dan
                        akuntabel.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Verification Check Section -->
    <section id="verifikasi" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center max-w-2xl mx-auto space-y-4 mb-12" data-aos="fade-up">
                <span
                    class="px-4 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">Verifikasi</span>
                <h2 class="text-3xl font-bold text-gray-800">CEK VERIFIKASI PERUSAHAAN</h2>
                <p class="text-gray-600">Cek status verifikasi Perusahaan anda dengan memasukkan <i>NPWP</i> pada form
                    di bawah ini.</p>
            </div>

            <div class="max-w-xl mx-auto bg-white p-8 rounded-2xl shadow-lg border border-gray-100" data-aos="fade-up"
                data-aos-delay="100">
                <form class="space-y-6">
                    <div>
                        <label class="block text-gray-700 font-medium mb-2">
                            NPWP <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-id-card text-gray-400'></i>
                            </div>
                            <input type="text"
                                class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-3 focus:ring-2 focus:ring-primary-500 focus:border-primary-500 transition-all"
                                placeholder="Masukkan NPWP Perusahaan Anda (dengan tanda - dan .)">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Contoh format: 12.345.678.9-012.345</p>
                    </div>
                    <button type="button"
                        class="w-full bg-primary-600 text-white py-3 rounded-lg font-medium hover:bg-primary-700 transition-colors flex items-center justify-center space-x-2 shadow-md hover:shadow-lg">
                        <i class='bx bx-search'></i>
                        <span>CEK STATUS</span>
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-primary-600">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-8 items-center">
                <div class="text-white space-y-6" data-aos="fade-right">
                    <h2 class="text-3xl font-bold">Belum memiliki akun?</h2>
                    <p class="text-primary-100 text-lg">Daftarkan perusahaan Anda sekarang untuk dapat mengakses layanan
                        LAKON PDK Kabupaten Cilacap.</p>
                    <a href="/registrasi"
                        class="inline-flex items-center bg-white text-primary-700 px-8 py-3 rounded-full font-medium hover:bg-gray-100 transition-colors shadow-md">
                        <i class='bx bx-user-plus mr-2'></i> Daftar Sekarang
                    </a>
                </div>
                <div class="hidden md:block" data-aos="fade-left">
                    <img src="/api/placeholder/600/400" alt="Illustration"
                        class="w-full h-auto rounded-lg shadow-lg floating">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white">
        <div class="container mx-auto px-4 py-12">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="{{asset('images/Logo-Cilacap.png')}}"
                            alt="Logo Kabupaten Cilacap" class="w-auto h-10">
                        <div>
                            <h3 class="font-bold text-lg">LAKON PDK</h3>
                            <p class="text-sm text-gray-400">Kabupaten Cilacap</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-4">
                        Portal resmi untuk pelaksanaan kegiatan yang aman dan transparan pada Dinas Pendidikan dan
                        Kebudayaan Kabupaten Cilacap.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class='bx bxl-facebook text-xl'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class='bx bxl-twitter text-xl'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class='bx bxl-instagram text-xl'></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class='bx bxl-youtube text-xl'></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4">Link Terkait</h3>
                    <ul class="space-y-2">
                        <li>
                            <a href="https://lpse.cilacapkab.go.id" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors flex items-center">
                                <i class='bx bx-chevron-right'></i> LPSE Cilacap
                            </a>
                        </li>
                        <li>
                            <a href="https://cilacapkab.go.id" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors flex items-center">
                                <i class='bx bx-chevron-right'></i> Pemkab Cilacap
                            </a>
                        </li>
                        <li>
                            <a href="https://pdk.cilacapkab.go.id" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors flex items-center">
                                <i class='bx bx-chevron-right'></i> Dinas PDK Cilacap
                            </a>
                        </li>
                        <li>
                            <a href="/path-to-pdf/MANUAL_BOOK_PENGGUNA_web.pdf" target="_blank"
                                class="text-gray-400 hover:text-white transition-colors flex items-center">
                                <i class='bx bx-chevron-right'></i> Manual Book
                            </a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="font-bold text-lg mb-4">Hubungi Kami</h3>
                    <ul class="space-y-3">
                        <li class="flex items-start space-x-3">
                            <i class='bx bx-map text-xl text-primary-400 mt-1'></i>
                            <span class="text-gray-400">Jl. Kalimantan No. 51 Cilacap, Jawa Tengah Indonesia</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class='bx bx-phone text-xl text-primary-400 mt-1'></i>
                            <span class="text-gray-400">(0282) 123456</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <i class='bx bx-envelope text-xl text-primary-400 mt-1'></i>
                            <span class="text-gray-400">info@pdk.cilacapkab.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 mt-8 border-t border-gray-700 text-center">
                <div>
                    <strong>LAKON PDK</strong> © 2024
                    <a href="https://pdk.cilacapkab.go.id" class="text-primary-400 hover:text-primary-300">
                        Dinas Pendidikan Dan Kebudayaan
                    </a>
                    Kabupaten Cilacap. All Rights Reserved
                </div>
                <div class="text-gray-400 mt-2">
                    Version 1.0.2025.01 Beta
                </div>
                <div class="text-xs text-gray-500 mt-2">
                    <p>Website ini dioptimalkan untuk browser terbaru. Gunakan Chrome, Firefox, Safari, atau Edge untuk
                        pengalaman terbaik.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button
        class="fixed bottom-4 right-4 bg-primary-600 text-white p-3 px-4 rounded-full shadow-lg hover:bg-primary-700 transition-colors opacity-0 invisible"
        id="back-to-top">
        <i class='bx bx-up-arrow-alt text-xl'></i>
    </button>

    <!-- JavaScript -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS animation
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                once: true
            });

            // Loading animation
            const loader = document.getElementById('loader');
            if (loader) {
                setTimeout(function () {
                    loader.style.opacity = '0';
                    setTimeout(function () {
                        loader.style.display = 'none';
                    }, 500);
                }, 1500); // Wait 1.5 seconds before hiding loader
            }

            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                });
            }

            const backToTopButton = document.getElementById('back-to-top');

            if (backToTopButton) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 300) {
                        backToTopButton.classList.add('opacity-100', 'visible');
                        backToTopButton.classList.remove('opacity-0', 'invisible');
                    } else {
                        backToTopButton.classList.add('opacity-0', 'invisible');
                        backToTopButton.classList.remove('opacity-100', 'visible');
                    }
                });

                backToTopButton.addEventListener('click', function () {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            const header = document.getElementById('header');

            if (header) {
                window.addEventListener('scroll', function () {
                    if (window.scrollY > 50) {
                        header.classList.add('py-2');
                        header.classList.add('shadow-md');
                    } else {
                        header.classList.remove('py-2');
                        header.classList.remove('shadow-md');
                    }
                });
            }

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();

                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;

                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth'
                        });

                        // Close mobile menu if open
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                    }
                });
            });

            const npwpInput = document.querySelector('input[placeholder*="NPWP"]');
            if (npwpInput) {
                npwpInput.addEventListener('input', function (e) {
                    let value = e.target.value.replace(/[^\d]/g, '');
                    if (value.length > 15) value = value.substring(0, 15);

                    if (value.length > 0) {
                        let formatted = value.substring(0, 2);
                        if (value.length > 2) formatted += '.' + value.substring(2, 5);
                        if (value.length > 5) formatted += '.' + value.substring(5, 8);
                        if (value.length > 8) formatted += '.' + value.substring(8, 9);
                        if (value.length > 9) formatted += '-' + value.substring(9, 12);
                        if (value.length > 12) formatted += '.' + value.substring(12, 15);

                        e.target.value = formatted;
                    }
                });
            }

            const structuredData = {
                "@context": "https://schema.org",
                "@type": "GovernmentOrganization",
                "name": "LAKON PDK Kabupaten Cilacap",
                "url": "https://pdk.cilacapkab.go.id",
                "logo": "https://2.bp.blogspot.com/-aEgbm1FL1mw/WVcXNvQWIwI/AAAAAAAALIw/IXb0Fh3SR807o3iRvs9Ed16PL7xom57sQCLcBGAs/s1600/Logo-Kabupaten-Cilacap.png",
                "description": "Portal resmi untuk pelaksanaan kegiatan yang aman dan transparan pada Dinas Pendidikan dan Kebudayaan Kabupaten Cilacap.",
                "address": {
                    "@type": "PostalAddress",
                    "streetAddress": "Jl. Kalimantan No. 51",
                    "addressLocality": "Cilacap",
                    "addressRegion": "Jawa Tengah",
                    "postalCode": "53223",
                    "addressCountry": "ID"
                },
                "contactPoint": {
                    "@type": "ContactPoint",
                    "telephone": "+62-282-123456",
                    "contactType": "customer service",
                    "email": "info@pdk.cilacapkab.go.id"
                }
            };

            const scriptTag = document.createElement('script');
            scriptTag.type = 'application/ld+json';
            scriptTag.text = JSON.stringify(structuredData);
            document.head.appendChild(scriptTag);
        });
    </script>
</body>
</html>
