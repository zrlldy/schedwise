<div >
    <div class="flex h-dvh w-full flex-1 flex-col gap-4 rounded-xl mt-20">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
               <flux:callout icon="clock">
    <flux:callout.heading>Upcoming test</flux:callout.heading>

    <flux:callout.text>
        Our servers will be undergoing scheduled maintenance this Sunday from 2 AM - 5 AM UTC. Some services may be temporarily unavailable.
        <flux:callout.link href="#">Learn more</flux:callout.link>
    </flux:callout.text>
</flux:callout>
            </div>


{{-- graphs --}}

            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}

                this more like a notif of how many numbers
            </div>




{{-- graphs --}}
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                this is the graph
            </div>
        </div>

        {{-- table --}}
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
  

            @php

    $users = [
        ['id' => 1, 'name' => 'John Doe', 'city' => ['name' => 'New York']],
        ['id' => 2, 'name' => 'Jane Smith', 'city' => ['name' => 'Los Angeles']],
        ['id' => 3, 'name' => 'Alice Johnson', 'city' => ['name' => 'Chicago']],
        ['id' => 4, 'name' => 'Bob Brown', 'city' => ['name' => 'Houston']],
    ];
 
    $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Nice Name'],
        ['key' => 'city.name', 'label' => 'City'] # <---- nested attributes
    ];
@endphp
 
{{-- You can use any `$wire.METHOD` on `@row-click` --}}
<x-mary-table :headers="$headers" :rows="$users" striped  />
            {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}

        </div>





        {{-- basta end ni siya --}}
    </div>


</div>
