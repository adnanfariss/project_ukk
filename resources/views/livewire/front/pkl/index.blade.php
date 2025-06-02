<div>
        {{-- heading --}}
        <div class="rounded-lg shadow-xl my-1">
            <h2 class="m-2 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Data Praktik Kerja Lapangan (PKL)</h2>
        </div>
        
        {{-- content --}}
        {{-- Card --}}
        <div class="container mx-auto py-6">
            <!-- Flash Messages -->
            @if (session()->has('success'))
                <div class="bg-green-100 dark:bg-green-800 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-200 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="bg-red-100 dark:bg-red-800 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 px-4 py-3 rounded mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white dark:bg-zinc-900 shadow-lg rounded-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 dark:from-blue-700 dark:to-blue-900 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-2xl font-bold text-white"> </h2>
                        @if($siswa_login && !$siswa_login->status_lapor_pkl)
                            <button wire:click="create()" 
                                    class="bg-white dark:bg-zinc-800 text-blue-600 dark:text-blue-400 px-4 py-2 rounded-lg font-semibold hover:bg-blue-50 dark:hover:bg-zinc-700 transition duration-200 flex items-center cursor-pointer">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Tambah PKL
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Search and Filter -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-b dark:border-zinc-700">
                    <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <input wire:model.live="search" 
                                    type="text" 
                                    placeholder="Cari nama siswa, industri, atau divisi..." 
                                    class="pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-80">
                                <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
                            <select wire:model.live="rowPerPage" class="border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white rounded px-3 py-1 text-sm">
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Status Info untuk Siswa Login -->
                @if($siswa_login)
                    <div class="px-6 py-3 bg-blue-50 dark:bg-blue-900/30 border-b dark:border-zinc-700">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                @if($siswa_login->status_lapor_pkl)
                                    <div class="flex items-center text-green-600 dark:text-green-400">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-semibold">Status: Sudah Lapor PKL</span>
                                    </div>
                                @else
                                    <div class="flex items-center text-orange-600 dark:text-orange-400">
                                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="font-semibold">Status: Belum Lapor PKL</span>
                                    </div>
                                @endif
                            </div>
                            <div class="ml-4 text-sm text-gray-600 dark:text-gray-400">
                                Login sebagai: <span class="font-semibold text-gray-900 dark:text-white">{{ $siswa_login->nama }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Table - Mobile First Responsive Design -->
                <div class="block lg:hidden">
                    <!-- Mobile Card Layout -->
                    <div class="px-4 py-4 space-y-4">
                        @forelse($pkls as $index => $pkl)
                            <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-4 border dark:border-zinc-700">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                                            <span class="text-blue-600 dark:text-blue-400 font-semibold text-sm">
                                                {{ substr($pkl->siswa->nama, 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $pkl->siswa->nama }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $pkl->siswa->email }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Industri:</span>
                                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $pkl->industri->nama }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Divisi:</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                            {{ $pkl->bidang_usaha }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Guru:</span>
                                        <span class="text-sm text-gray-900 dark:text-white">{{ $pkl->guru->nama }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Periode:</span>
                                        <div class="text-right">
                                            <div class="text-xs text-green-600 dark:text-green-400">{{ \Carbon\Carbon::parse($pkl->mulai)->format('d M Y') }}</div>
                                            <div class="text-xs text-red-600 dark:text-red-400">{{ \Carbon\Carbon::parse($pkl->selesai)->format('d M Y') }}</div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Durasi:</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                            {{ $pkl->lama_hari }} hari
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada data PKL</p>
                                @if($siswa_login && !$siswa_login->status_lapor_pkl)
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Klik tombol "Tambah PKL" untuk menambah data</p>
                                @endif
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Desktop Table Layout -->
                <div class="hidden lg:block">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
                        <thead class="bg-gray-50 dark:bg-zinc-800">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Siswa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Industri</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Divisi</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Guru</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Periode</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Durasi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-700">
                            @forelse($pkls as $index => $pkl)
                                <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors duration-200">
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ $pkls->firstItem() + $index }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <div class="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                                    <span class="text-blue-600 dark:text-blue-400 font-semibold text-xs">
                                                        {{ substr($pkl->siswa->nama, 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-3">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($pkl->siswa->nama, 15) }}</div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($pkl->siswa->email, 20) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($pkl->industri->nama, 20) }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($pkl->industri->alamat ?? '-', 25) }}</div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                            {{ Str::limit($pkl->bidang_usaha, 15) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        {{ Str::limit($pkl->guru->nama, 15) }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                        <div class="flex flex-col">
                                            <span class="text-green-600 dark:text-green-400 font-medium text-xs">{{ \Carbon\Carbon::parse($pkl->mulai)->format('d M Y') }}</span>
                                            <span class="text-gray-400 dark:text-gray-500 text-xs">s/d</span>
                                            <span class="text-red-600 dark:text-red-400 font-medium text-xs">{{ \Carbon\Carbon::parse($pkl->selesai)->format('d M Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                            {{ $pkl->lama_hari }} hari
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                            <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada data PKL</p>
                                            @if($siswa_login && !$siswa_login->status_lapor_pkl)
                                                <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Klik tombol "Tambah PKL" untuk menambah data</p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-t dark:border-zinc-700">
                    {{ $pkls->links() }}
                </div>
            </div>

            <!-- Modal -->
            @if($isOpen)
                <div class="fixed inset-0 bg-black/80 overflow-y-auto h-full w-full z-50">
                    <div class="relative top-20 mx-auto p-5 border dark:border-zinc-700 w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-zinc-900">
                        <!-- Modal Header -->
                        <div class="flex items-center justify-between pb-4 border-b dark:border-zinc-700">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tambah Data PKL</h3>
                            <button wire:click="closeModal()" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 cursor-pointer">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <form wire:submit.prevent="store" class="mt-4">
                            @if($siswa_login)
                                <!-- Siswa (Read-only) -->
                                <div class="mb-4">
                                    <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nama Siswa</label>
                                    <div class="bg-gray-100 dark:bg-zinc-800 px-3 py-2 rounded border dark:border-zinc-600">
                                        <span class="text-gray-700 dark:text-gray-300">{{ $siswa_login->nama }}</span>
                                    </div>
                                    <input type="hidden" wire:model="siswaId">
                                </div>
                            @endif

                            <!-- Industri -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Industri *</label>
                                <select wire:model="industriId" class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">
                                    <option value="">Pilih Industri</option>
                                    @foreach($industris as $industri)
                                        <option value="{{ $industri->id }}">{{ $industri->nama }}</option>
                                    @endforeach
                                </select>
                                @error('industriId') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Bidang Usaha -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Divisi *</label>
                                <input type="text" wire:model="bidangUsaha" 
                                    class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                                    placeholder="Contoh: Produksi, Front end, Databases, dll">
                                @error('bidangUsaha') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Guru Pembimbing -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Guru Pembimbing *</label>
                                <select wire:model="guruId" class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">
                                    <option value="">Pilih Guru Pembimbing</option>
                                    @foreach($gurus as $guru)
                                        <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                    @endforeach
                                </select>
                                @error('guruId') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tanggal Mulai -->
                            <div class="mb-4">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Tanggal Mulai *</label>
                                <input type="date" wire:model="mulai" 
                                    class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">
                                @error('mulai') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Tanggal Selesai -->
                            <div class="mb-6">
                                <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Tanggal Selesai *</label>
                                <input type="date" wire:model="selesai" 
                                    class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white">
                                @error('selesai') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <!-- Modal Footer -->
                            <div class="flex items-center justify-end space-x-3 pt-4 border-t dark:border-zinc-700">
                                <button type="button" wire:click="closeModal()" 
                                        class="px-4 py-2 cursor-pointer bg-gray-300 dark:bg-zinc-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-400 dark:hover:bg-zinc-600 transition-colors duration-200">
                                    Batal
                                </button>
                                <button type="submit" 
                                        class="px-4 py-2 cursor-pointer bg-blue-600 dark:bg-blue-700 text-white rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors duration-200">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
        {{-- ./Card --}}
</div>