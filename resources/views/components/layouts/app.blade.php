<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main class="rounded-xl shadow-xl m-1 bg-gray-50 dark:bg-zinc-900">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
