<div class="bg-white dark:bg-zinc-900 shadow-lg rounded-lg overflow-hidden">
            <div class="rounded-lg shadow-xl my-1">
            <h2 class="mx-2 mb-7 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Data Guru</h2>
        </div>

    <!-- Header -->
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 dark:from-emerald-700 dark:to-emerald-900 px-6 py-7 rounded-t-lg">
        <div class="flex justify-between items-center">
        </div>
    </div>

    <!-- Search and Filter -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-b dark:border-zinc-700">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input wire:model.live="search" 
                        type="text" 
                        placeholder="Cari berdasarkan nama, NIP, atau email..." 
                        class="pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 rounded-lg focus:ring-emerald-500 focus:border-emerald-500 w-80">
                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <label class="text-sm text-gray-600 dark:text-gray-400">Tampilkan:</label>
                <select wire:model.live="perPage" class="border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white rounded px-3 py-1 text-sm">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Desktop Table Layout -->
    <div class="hidden lg:block">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-zinc-700">
            <thead class="bg-gray-50 dark:bg-zinc-800">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">No</th>
                    <th wire:click="sortBy('nama')" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:text-gray-700 dark:hover:text-gray-300">
                        <span class="flex items-center">
                            Nama
                            @if($sortField === 'nama')
                                @if($sortDirection === 'asc')
                                    <i class="fas fa-sort-up ml-1"></i>
                                @else
                                    <i class="fas fa-sort-down ml-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </span>
                    </th>
                    <th wire:click="sortBy('nip')" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:text-gray-700 dark:hover:text-gray-300">
                        <span class="flex items-center">
                            NIP
                            @if($sortField === 'nip')
                                @if($sortDirection === 'asc')
                                    <i class="fas fa-sort-up ml-1"></i>
                                @else
                                    <i class="fas fa-sort-down ml-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </span>
                    </th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Gender</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Alamat</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kontak</th>
                    <th wire:click="sortBy('email')" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:text-gray-700 dark:hover:text-gray-300">
                        <span class="flex items-center">
                            Email
                            @if($sortField === 'email')
                                @if($sortDirection === 'asc')
                                    <i class="fas fa-sort-up ml-1"></i>
                                @else
                                    <i class="fas fa-sort-down ml-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse($gurus as $index => $guru)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors duration-200">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $gurus->firstItem() + $index }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center">
                                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold text-xs">
                                            {{ substr($guru->nama, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $guru->nama }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Guru</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $guru->nip }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($guru->gender == 'L')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200">
                                    <i class="fas fa-mars mr-1"></i>
                                    Laki-laki
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-200">
                                    <i class="fas fa-venus mr-1"></i>
                                    Perempuan
                                </span>
                            @endif
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            <div class="max-w-xs truncate">{{ $guru->alamat ?: '-' }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $guru->kontak ?: '-' }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $guru->email ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ada data guru yang ditemukan</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile Card Layout -->
    <div class="lg:hidden">
        <div class="p-4 space-y-4">
            @forelse($gurus as $guru)
                <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-4 border dark:border-zinc-700">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-emerald-100 dark:bg-emerald-900 flex items-center justify-center mr-3">
                            <span class="text-emerald-600 dark:text-emerald-400 font-semibold">{{ substr($guru->nama, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white">{{ $guru->nama }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $guru->nip }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div>
                            <span class="text-gray-500 dark:text-gray-400">Gender:</span>
                            <span class="ml-1 text-gray-900 dark:text-white">
                                {{ $guru->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-500 dark:text-gray-400">Kontak:</span>
                            <span class="ml-1 text-gray-900 dark:text-white">{{ $guru->kontak ?: '-' }}</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-500 dark:text-gray-400">Email:</span>
                            <span class="ml-1 text-gray-900 dark:text-white">{{ $guru->email ?: '-' }}</span>
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-500 dark:text-gray-400">Alamat:</span>
                            <span class="ml-1 text-gray-900 dark:text-white">{{ $guru->alamat ?: '-' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-user-tie fa-3x text-gray-400 dark:text-gray-600 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada data guru yang ditemukan</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-t dark:border-zinc-700">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan {{ $gurus->firstItem() ?? 0 }} sampai {{ $gurus->lastItem() ?? 0 }} 
                dari {{ $gurus->total() }} hasil
            </div>
            <div>
                {{ $gurus->links() }}
            </div>
        </div>
    </div>
</div>