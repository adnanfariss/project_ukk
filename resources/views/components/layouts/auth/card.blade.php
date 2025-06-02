<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
        <link rel="icon" type="image/png" href="{{ asset('img/logomagangku.png') }}">
    </head>
    <body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900" style="background-image: url('{{ asset('img/background.jpg') }}');">
        <div class="bg-muted flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
            <div class="flex w-full max-w-md flex-col gap-6">
                <div class="flex lg:flex-1 justify-center">
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

            <div class="flex flex-col gap-6">
                <div class="rounded-xl border border-gray-200 bg-white text-gray-800 shadow-sm  dark:bg-gray-900">
                    <div class="px-10 py-8">{{ $slot }}</div>
                </div>
            </div>
        </div>
        @fluxScripts
    </body>
</html>
