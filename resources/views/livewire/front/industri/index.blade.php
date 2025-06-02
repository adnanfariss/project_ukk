<div class="container mx-auto">
    {{-- heading with button on the right --}}
    <div class="flex justify-between items-center mb-7">
        <div class="rounded-lg shadow-xl">
            <h2 class="m-2 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Daftar Industri</h2>
        </div>
        <button wire:click="create()" 
                class="bg-purple-600 hover:bg-purple-700 dark:bg-purple-700 dark:hover:bg-purple-800 text-white px-4 py-2 rounded-lg font-semibold transition duration-200 flex items-center cursor-pointer">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Industri
        </button>
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

    <div class="bg-stone-100 dark:bg-zinc-900 rounded-lg overflow-hidden">
        <!-- Cart Layout for Industri Items -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
            @forelse($industris as $index => $industri)
                <div class="flex flex-col bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700 hover:scale-105 transition-transform duration-300 cursor-pointer">
                    <div class="flex items-center p-4">
                        <div class="flex-shrink-0 h-16 w-16 rounded-full overflow-hidden bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                            @if($industri->image)
                                <img src="{{ asset('storage/logo/' . $industri->image) }}" 
                                     alt="{{ $industri->nama }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h5 class="text-lg font-bold tracking-tight text-gray-900 dark:text-white">{{ $industri->nama }}</h5>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $industri->email }}</p>
                        </div>
                    </div>
                    <div class="p-4 pt-0">
                        <div class="mb-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Alamat:</span>
                            <p class="text-sm text-gray-900 dark:text-white">{{ Str::limit($industri->alamat, 50) }}</p>
                        </div>
                        <div class="mb-2">
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Kontak:</span>
                            <p class="text-sm text-gray-900 dark:text-white">{{ $industri->kontak }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Website:</span>
                            <a href="{{ $industri->website }}" target="_blank" class="text-sm text-blue-600 dark:text-blue-400 hover:underline block truncate">
                                {{ $industri->website }}
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400 text-lg">Belum ada data industri</p>
                    <p class="text-gray-400 dark:text-gray-500 text-sm mt-2">Klik tombol "Tambah Industri" untuk menambah data</p>
                </div>
            @endforelse
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

                    <!-- Logo/Gambar Industri -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                            Logo Industri * {{ $editingId ? '(Kosongkan jika tidak ingin mengubah)' : '' }}
                        </label>
                        
                        <!-- Preview gambar lama jika edit -->
                        @if($editingId && $oldImage)
                            <div class="mb-3">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Logo saat ini:</p>
                                <img src="{{ asset('storage/logo/' . $oldImage) }}" 
                                     alt="Logo saat ini"                                
                                     class="h-20 w-20 object-cover rounded-md border dark:border-zinc-600 mb-2">
                            </div>
                        @endif
                        
                        <!-- Input upload file -->
                        <input type="file" wire:model="image" 
                               class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400">
                        
                        <!-- Preview gambar baru -->
                        @if($image)
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Preview:</p>
                                <img src="{{ $image->temporaryUrl() }}" 
                                     alt="Preview logo baru"
                                     class="h-20 w-20 object-cover rounded-md border dark:border-zinc-600">
                            </div>
                        @endif
                        
                        @error('image') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Format: JPG, PNG, SVG (Maks. 2MB)</p>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Alamat *</label>
                        <textarea wire:model="alamat" rows="3"
                            class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                            placeholder="Masukkan alamat lengkap industri"></textarea>
                        @error('alamat') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Kontak -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Kontak *</label>
                        <input type="text" wire:model="kontak" 
                            class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                            placeholder="Masukkan nomor telepon/WA">
                        @error('kontak') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Email *</label>
                        <input type="email" wire:model="email" 
                            class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                            placeholder="Masukkan email industri">
                        @error('email') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Website -->
                    <div>
                        <label class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">Website *</label>
                        <input type="url" wire:model="website" 
                            class="w-full px-3 py-2 border dark:border-zinc-600 rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-white dark:bg-zinc-800 text-gray-900 dark:text-white dark:placeholder-gray-400"
                            placeholder="Contoh: https://perusahaan.com">
                        @error('website') <span class="text-red-500 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <!-- Modal Footer -->
                    <div class="flex justify-end pt-4 border-t dark:border-zinc-700">
                        <button type="button" wire:click="closeModal()"
                                class="px-4 py-2 mr-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-zinc-700 rounded-lg hover:bg-gray-200 dark:hover:bg-zinc-600 transition duration-200">
                            Batal
                        </button>
                        <button type="submit"
                                class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:ring-4 focus:ring-purple-300 dark:bg-purple-700 dark:hover:bg-purple-800 transition duration-200 flex items-center">
                            <svg wire:loading wire:target="store" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            {{ $editingId ? 'Simpan Perubahan' : 'Tambah Industri' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>