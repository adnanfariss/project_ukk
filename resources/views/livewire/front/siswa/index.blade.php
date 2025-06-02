<div>
        <div class="rounded-lg shadow-xl my-1">
            <h2 class="mx-2 mb-7 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl dark:text-white">Data Siswa</h2>
        </div>

    <div class="bg-white dark:bg-zinc-900 shadow-lg rounded-lg overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-yellow-600 to-yellow-800 dark:from-yellow-700 dark:to-yellow-900 px-6 py-4">
        <div class="flex justify-between items-center py-4">

        </div>
    </div>

    <!-- Search and Filter -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-b dark:border-zinc-700">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input wire:model.live="search" 
                        type="text" 
                        placeholder="Cari berdasarkan nama, NIS, atau email..." 
                        class="pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 dark:bg-zinc-700 dark:text-white dark:placeholder-gray-400 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-80">
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
                    <th wire:click="sortBy('nis')" class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:text-gray-700 dark:hover:text-gray-300">
                        <span class="flex items-center">
                            NIS
                            @if($sortField === 'nis')
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
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status PKL</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-zinc-900 divide-y divide-gray-200 dark:divide-zinc-700">
                @forelse($siswas as $index => $siswa)
                    <tr class="hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors duration-200">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">
                            {{ $siswas->firstItem() + $index }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                                        <span class="text-blue-600 dark:text-blue-400 font-semibold text-xs">
                                            {{ substr($siswa->nama, 0, 1) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $siswa->nama }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">Siswa</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $siswa->nis }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($siswa->gender == 'L')
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
                            <div class="max-w-xs truncate">{{ $siswa->alamat ?: '-' }}</div>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $siswa->kontak ?: '-' }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $siswa->email ?: '-' }}</td>
                        <td class="px-4 py-4 whitespace-nowrap">
                            @if($siswa->status_lapor_pkl)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                    <i class="fas fa-check-circle mr-1"></i>
                                    Sudah Lapor
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200">
                                    <i class="fas fa-clock mr-1"></i>
                                    Belum Lapor
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <svg class="w-12 h-12 text-gray-400 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z"></path>
                                </svg>
                                <p class="text-gray-500 dark:text-gray-400 text-lg">Tidak ada data siswa yang ditemukan</p>
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
            @forelse($siswas as $siswa)
                <div class="bg-gray-50 dark:bg-zinc-800 rounded-lg p-4 border dark:border-zinc-700">
                    <div class="flex items-center mb-3">
                        <div class="h-10 w-10 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                            <span class="text-blue-600 dark:text-blue-400 font-semibold">{{ substr($siswa->nama, 0, 1) }}</span>
                        </div>
                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white">{{ $siswa->nama }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $siswa->nis }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-sm">
                        <div>
                            <span class="text-gray-500 dark:text-gray-400">Gender:</span>
                            <span class="ml-1 text-gray-900 dark:text-white">
                                {{ $siswa->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>
                        <div>
                            <span class="text-gray-500 dark:text-gray-400">Status PKL:</span>
                            @if($siswa->status_lapor_pkl)
                                <span class="ml-1 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                    Sudah Lapor
                                </span>
                            @else
                                <span class="ml-1 inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-200">
                                    Belum Lapor
                                </span>
                            @endif
                        </div>
                        <div class="col-span-2">
                            <span class="text-gray-500 dark:text-gray-400">Email:</span>
                            <span class="ml-1 text-gray-900 dark:text-white">{{ $siswa->email ?: '-' }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <i class="fas fa-user-graduate fa-3x text-gray-400 dark:text-gray-600 mb-4"></i>
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada data siswa yang ditemukan</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    <div class="px-6 py-4 bg-gray-50 dark:bg-zinc-800 border-t dark:border-zinc-700">
        <div class="flex items-center justify-between">
            <div class="text-sm text-gray-500 dark:text-gray-400">
                Menampilkan {{ $siswas->firstItem() ?? 0 }} sampai {{ $siswas->lastItem() ?? 0 }} 
                dari {{ $siswas->total() }} hasil
            </div>
            <div>
                {{ $siswas->links() }}
            </div>
        </div>
    </div>
</div>
</div>