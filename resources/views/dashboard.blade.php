<x-layouts.app :title="__('Dashboard')">
    <!-- Main Content -->
    <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 dark:from-blue-700 dark:to-indigo-800 rounded-lg shadow-sm p-6 text-white">
                <h2 class="text-2xl font-bold mb-2">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h2>
                <p class="text-blue-100 dark:text-blue-200">
                    Dashboard <strong>MagangKu</strong> - Portal DataSiswa PKL
                </p>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1: Persentase Siswa Lapor PKL -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow rounded-lg border border-gray-200 dark:border-zinc-700">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                    Siswa Sudah Lapor PKL
                                </dt>
                                <dd class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $persenSiswaLapor }}%
                                </dd>
                                <dd class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $siswaLaporPkl }} dari {{ $totalSiswa }} siswa
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Persentase Siswa Sedang PKL -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow rounded-lg border border-gray-200 dark:border-zinc-700">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                    Siswa Sedang PKL
                                </dt>
                                <dd class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $persenSiswaProses }}%
                                </dd>
                                <dd class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $siswaProsesPkl }} dari {{ $totalSiswa }} siswa
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Total Industri -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow rounded-lg border border-gray-200 dark:border-zinc-700">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                    Total Industri
                                </dt>
                                <dd class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $totalIndustri }}
                                </dd>
                                <dd class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $industriAktif }} industri aktif
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Total Siswa -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow rounded-lg border border-gray-200 dark:border-zinc-700">
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-md flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4 w-0 flex-1">
                            <dl>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400 truncate">
                                    Total Siswa
                                </dt>
                                <dd class="text-2xl font-bold text-gray-900 dark:text-white">
                                    {{ $totalSiswa }}
                                </dd>
                                <dd class="text-sm text-gray-500 dark:text-gray-400">
                                    Siswa terdaftar
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Pie Chart -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow rounded-lg border border-gray-200 dark:border-zinc-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-zinc-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        Distribusi Status PKL Siswa
                    </h3>
                </div>
                <div class="p-6">
                    <div class="relative h-64">
                        <canvas id="pklChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Summary Stats -->
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow rounded-lg border border-gray-200 dark:border-zinc-700">
                <div class="px-6 py-4 border-b border-gray-200 dark:border-zinc-700">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        Ringkasan Statistik
                    </h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Siswa Sudah Lapor PKL</span>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $persenSiswaLapor }}%</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Siswa Sedang PKL</span>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $persenSiswaProses }}%</span>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Siswa Belum PKL</span>
                            <div class="flex items-center">
                                <div class="w-3 h-3 bg-red-500 rounded-full mr-2"></div>
                                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ round((($totalSiswa - $siswaLaporPkl) / max($totalSiswa, 1)) * 100, 1) }}%</span>
                            </div>
                        </div>
                        <hr class="border-gray-200 dark:border-zinc-700">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Industri Aktif</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $industriAktif }}/{{ $totalIndustri }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Chart configuration
        const ctx = document.getElementById('pklChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode($chartData['labels']) !!},
                datasets: [{
                    data: {!! json_encode($chartData['data']) !!},
                    backgroundColor: {!! json_encode($chartData['colors']) !!},
                    borderWidth: 2,
                    borderColor: document.documentElement.classList.contains('dark') ? '#374151' : '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            color: document.documentElement.classList.contains('dark') ? '#e5e7eb' : '#374151'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = ((context.parsed / total) * 100).toFixed(1);
                                return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                            }
                        }
                    }
                }
            }
        });

        // Update chart colors when dark mode changes
        document.addEventListener('alpine:init', () => {
            Alpine.watch('darkMode', (value) => {
                setTimeout(() => {
                    chart.options.plugins.legend.labels.color = value ? '#e5e7eb' : '#374151';
                    chart.data.datasets[0].borderColor = value ? '#374151' : '#ffffff';
                    chart.update();
                }, 100);
            });
        });
    </script>
</x-layouts.app>
