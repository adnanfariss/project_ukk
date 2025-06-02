<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magangku - Portal Data Siswa PKL</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('img/logomagangku.png') }}">
</head>
<body class="bg-gray-50">
    <!-- Hero Section with Background Image -->
<section class="relative min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('img/background.jpg') }}');">
        <!-- Blue Overlay -->
        {{-- <div class="absolute inset-0 bg-blue-500 bg-opacity-80"></div> --}}
        
        <!-- Content -->
        <div class="relative z-10 h-full">
            <!-- Navigation -->
            <nav class="flex items-center justify-between p-6 lg:px-8">
                <!-- Logo -->
                <div class="flex lg:flex-1">
                    <a href="{{ route('home') }}" class="bg-white px-4 py-2 rounded-lg shadow-md">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 2L3 7v11h4v-6h6v6h4V7l-7-5z"/>
                                </svg>
                            </div>
                            <span class="text-blue-600 font-bold text-xl">MagangKu</span>
                        </div>
                    </a>
                </div>

                <!-- Auth Buttons -->
                <div class="flex lg:flex-1 lg:justify-end space-x-4">
                    @auth
                        <!-- Jika Sudah Login -->
                        <a href="{{ url('/dashboard') }}"
                        class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition-colors shadow-md">
                            Dashboard
                        </a>
                    @else
                        <!-- Jika Belum Login -->
                        <a href="{{ route('login') }}" class="text-white font-semibold hover:text-blue-200 transition-colors pt-2">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-2 rounded-full font-semibold hover:bg-blue-50 transition-colors shadow-md">
                            Register
                        </a>
                    @endauth
                </div>
            </nav>

            <!-- Hero Content Container -->
            <div class="relative h-[calc(100vh-120px)] px-6 lg:px-8">
                <!-- Left Content -->
                <div class="absolute top-0 left-6 lg:left-8 max-w-2xl mt-15">
                    <!-- Judul Utama -->
                    <h1 class="text-white font-bold mb-6">
                        <span class="text-4xl lg:text-5xl pl-2">Selamat datang</span><br>
                        <span class="block text-7xl lg:text-8xl mt-2">di Portal Data<br>Siswa PKL</span>
                    </h1>

                    <!-- Deskripsi Bawah -->
                    <p class="text-white text-lg font-bold lg:text-2xl mb-8 w-full">
                        Memudahkan pelacakan, evaluasi, dan pengelolaan data siswa selama praktik kerja lapangan.
                    </p>
                </div>
                
                <!-- Right Content - Building Image -->
                <div class="absolute bottom-0 right-6 lg:right-8">
                    <a class="block">
                        <img src="{{ asset('img/gedung.png') }}" alt="Modern Building" class="w-[600px] lg:w-[734px] h-auto max-h-[539px] object-contain hover:scale-105 transition-transform duration-300">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="bg-gradient-to-b from-blue-50 to-white py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Praktek Kerja Lapangan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    PKL yang di laksanakan oleh siswa-siswi dari SMKN 2 Depok
                </p>
            </div>

            <!-- Services Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Jaringan Komputer Dasar -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 hover:scale-105 transition-transform duration-300 hover:scale-105 transition-transform duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor" class="size-70">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Jaringan Komputer Dasar</h3>
                        <p class="text-gray-600 text-sm">Mempelajari fundamental jaringan komputer dan infrastruktur IT</p>
                    </div>
                </div>

                <!-- Sistem Komputer -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition-transform duration-300 hover:scale-105 transition-transform duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor" class="size-70">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Sistem Komputer</h3>
                        <p class="text-gray-600 text-sm">Memahami arsitektur dan komponen sistem komputer modern</p>
                    </div>
                </div>

                <!-- Pemrograman Dasar -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 hover:scale-105 transition-transform duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor" class="size-70">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Pemrograman Dasar</h3>
                        <p class="text-gray-600 text-sm">Belajar konsep fundamental pemrograman dan algoritma</p>
                    </div>
                </div>

                <!-- Infrastructure as a Service (IaaS) -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 hover:scale-105 transition-transform duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor" class="size-70">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Infrastructure as a Service (IaaS)</h3>
                        <p class="text-gray-600 text-sm">Mengelola infrastruktur cloud dan virtualisasi</p>
                    </div>
                </div>

                <!-- Platform as a Service (PaaS) -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 hover:scale-105 transition-transform duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor" class="size-70">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Platform as a Service (PaaS)</h3>
                        <p class="text-gray-600 text-sm">Pengembangan aplikasi menggunakan platform cloud</p>
                    </div>
                </div>

                <!-- Software as a Service (SaaS) -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 hover:scale-105 transition-transform duration-300 hover:scale-105 transition-transform duration-300 hover:scale-105 transition-transform duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor" class="size-70">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Software as a Service (SaaS)</h3>
                        <p class="text-gray-600 text-sm">Implementasi dan pengelolaan aplikasi berbasis cloud</p>
                    </div>
                </div>

                <!-- Internet of Things (IoT) -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 hover:scale-105 transition-transform duration-300 hover:scale-105 transition-transform duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor" class="size-70">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Internet of Things (IoT)</h3>
                        <p class="text-gray-600 text-sm">Pengembangan sistem IoT dan sensor networks</p>
                    </div>
                </div>

                <!-- Sistem Keamanan Jaringan -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 hover:scale-105 transition-transform duration-300 hover:scale-105 transition-transform duration-300">
                    <div class="aspect-w-16 aspect-h-9">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="0.8" stroke="currentColor" class="size-70">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-gray-900 mb-2">Sistem Keamanan Jaringan</h3>
                        <p class="text-gray-600 text-sm">Implementasi keamanan cyber dan network security</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <div class="w-8 h-8 bg-blue-600 rounded flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2L3 7v11h4v-6h6v6h4V7l-7-5z"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-xl">MagangKu</span>
                </div>
                <p class="text-gray-400 mb-4">Portal Data Siswa PKL - Memudahkan pengelolaan praktik kerja lapangan</p>
                <p class="text-gray-500 text-sm">&copy; 2024 Magangku. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>