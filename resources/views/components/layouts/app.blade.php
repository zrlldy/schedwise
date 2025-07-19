<x-layouts.app.sidebar :title="$title ?? null" class="bg-amber-50">
    <flux:main>

        {{-- this is the one that holds everything  --}}








        
        {{-- this is the main page  --}}
        {{ $slot }}

    </flux:main>
</x-layouts.app.sidebar>
