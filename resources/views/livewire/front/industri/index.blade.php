<div class="container mx-auto">
            {{-- heading --}}
    <div class=" rounded-lg shadow-xl mb-7">
        <h2 class="m-2 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Daftar Industri</h2>
    </div>

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
        <div class="bg-gradient-to-r from-purple-600 to-purple-800 dark:from-purple-700 dark:to-purple-900 px-6 py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl font-bold text-white"></h2>
                <button wire:click="create()" 
                        class="bg-white dark:bg-zinc-800 text-purple-600 dark:text-purple-400 px-4 py-2 rounded-lg font-semibold hover:bg-purple-50 dark:hover:bg-zinc-700 transition duration-200 flex items-center cursor-pointer">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Industri
                </button>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-b dark:border-zinc-700">
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <input wire:model.live="search" 
                            type="text" 
                            placeholder="Cari nama industri, bidang usaha, atau email..." 
                            class="pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 rounded-lg focus:ring-purple-500 focus:border-purple-500 w-80">
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

        <!-- Table - Mobile First Responsive Design -->
        <div class="block lg:hidden">
            <!-- Mobile Card Layout -->
            <div class="px-4 py-4 space-y-4">
                @forelse($industris as $index => $industri)
                    <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-4 border dark:border-zinc-700">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center">
                                <div class="h-10 w-10 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-3">
                                    <span class="text-purple-600 dark:text-purple-400 font-semibold text-sm">
                                        {{ substr($industri->nama, 0, 1) }}
                                    </span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $industri->nama }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $industri->email }}</div>
                                </div>
                            </div>
                            <div class="flex space-x-2">
                                <button wire:click="edit({{ $industri->id }})" 
                                        class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <button wire:click="delete({{ $industri->id }})" 
                                        wire:confirm="Apakah Anda yakin ingin menghapus data industri ini?"
                                        class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors duration-200">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1-1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Bidang Usaha:</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200">
                                    {{ $industri->bidang_usaha }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Alamat:</span>
                                <span class="text-sm text-gray-900 dark:text-white text-right max-w-48 truncate">{{ $industri->alamat }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Kontak:</span>
                                <span class="text-sm text-gray-900 dark:text-white">{{ $industri->kontak }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-500 dark:text-gray-400">Website:</span>
                                <a href="{{ $industri->website }}" target="_blank" class="text-sm text-blue-600 dark:text-blue-400 hover:underline truncate max-w-32">
                                    {{ $industri->website }}
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada data industri</p>
                        <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Klik tombol "Tambah Industri" untuk menambah data</p>
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
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Industri</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Bidang Usaha</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Alamat</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kontak</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Website</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-700">
                    @forelse($industris as $index => $industri)
                        <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors duration-200">
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $industris->firstItem() + $index }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-8 w-8">
                                        <div class="h-8 w-8 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                                            <span class="text-purple-600 dark:text-purple-400 font-semibold text-xs">
                                                {{ substr($industri->nama, 0, 1) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ Str::limit($industri->nama, 20) }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($industri->email, 25) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200">
                                    {{ Str::limit($industri->bidang_usaha, 15) }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                <div title="{{ $industri->alamat }}">
                                    {{ Str::limit($industri->alamat, 30) }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                                {{ $industri->kontak }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm">
                                <a href="{{ $industri->website }}" target="_blank" 
                                   class="text-blue-600 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 hover:underline"
                                   title="{{ $industri->website }}">
                                    {{ Str::limit($industri->website, 20) }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada data industri</p>
                                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Klik tombol "Tambah Industri" untuk menambah data</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-t dark:border-zinc-700">
            {{ $industris->links() }}
        </div>
    </div>

    <!-- Modal -->
    @if($isOpen)
        <div class="fixed inset-0 bg-black/30 overflow-y-auto h-full w-full z-50">
            <div class="relative top-10 mx-auto p-5 border dark:border-zinc-700 w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white dark:bg-zinc-900">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-4 border-b dark:border-zinc-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $editingId ? 'Edit Data Industri' : 'Tambah Data Industri' }}
                    </h3>
                    <button wire:click="closeModal()" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 cursor-pointer">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Body -->
                <form wire:submit.prevent="store" class="mt-4 space-y-4">
                    <!-- Nama Industri -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Nama Industri *</label>
                        <input type="text" wire:model="nama" 
                            class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                            placeholder="Masukkan nama industri">
                        @error('nama') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Bidang Usaha -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Bidang Usaha *</label>
                        <input type="text" wire:model="bidangUsaha" 
                            class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                            placeholder="Contoh: Teknologi Informasi, Manufaktur, dll">
                        @error('bidangUsaha') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Alamat *</label>
                        <textarea wire:model="alamat" rows="3"
                            class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                            placeholder="Masukkan alamat lengkap industri"></textarea>
                        @error('alamat') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Kontak dan Email dalam satu baris -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Kontak -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Kontak *</label>
                            <input type="text" wire:model="kontak" 
                                class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                                placeholder="Nomor telepon/WA">
                            @error('kontak') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email *</label>
                            <input type="email" wire:model="email" 
                                class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                                placeholder="email@contoh.com">
                            @error('email') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Website -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Website</label>
                        <input type="url" wire:model="website" 
                            class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                            placeholder="https://www.contoh.com">
                        @error('website') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end space-x-2 pt-4 border-t dark:border-zinc-700">
                        <button type="button" wire:click="closeModal()" 
                                class="px-4 cursor-pointer py-2 bg-gray-500 dark:bg-gray-600 text-white rounded-lg hover:bg-gray-600 dark:hover:bg-gray-700 transition duration-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 cursor-pointer py-2 bg-purple-600 dark:bg-purple-700 text-white rounded-lg hover:bg-purple-700 dark:hover:bg-purple-800 transition duration-200">
                            {{ $editingId ? 'Update' : 'Simpan' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>