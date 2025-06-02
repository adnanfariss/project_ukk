<x-layouts.app.sidebar :title="$title ?? null">
    <flux:main class="rounded-xl shadow-xl m-1 bg-stone-100 dark:bg-zinc-900">
        {{ $slot }}
    </flux:main>
</x-layouts.app.sidebar>
