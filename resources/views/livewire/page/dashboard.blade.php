<div>
    <div class=" bg-orange-200 rounded-lg p-4 text-center font-bold max-w-[70%] mx-auto w-full mb-10">

        <header class="text-2xl font-bold">Dashboard</header>

    </div>
    <div class="flex h-dvh w-full flex-1 flex-col gap-8 rounded-xl ">

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div
                class="flex items-center justify-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="stats bg-base-100 border-base-300 ">
                    <div class="stat">
                        <div class="stat-title">Schedule Conflicts</div>
                        <div class="stat-value text-red-400">+1</div>
                        <div class="stat-actions">
                            <button class="btn btn-xs btn-success">Go to</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- graphs --}}

            <div
                class=" flex justify-center items-center relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
                <div class="stats bg-base-100 border-base-300 ">
                    <div class="stat">
                        <div class="stat-title">Subject Added</div>
                        <div class="stat-value text-green-400">+20</div>
                        <div class="stat-actions">
                            <button class="btn btn-xs btn-success">Go to</button>
                        </div>
                    </div>
                </div>
            </div>




            {{-- graphs --}}
            <div
                class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 flex items-center justify-center">
                <div class="m-4 "><x-mary-progress-radial value="50"
                        class="bg-primary text-primary-content border-4 border-primary" />
                </div>
            </div>
        </div>

        {{-- table --}}
        <div
            class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">


            {{-- @php

                $users = [
                    ['id' => 1, 'name' => 'John Doe', 'city' => ['name' => 'New York']],
                    ['id' => 2, 'name' => 'Jane Smith', 'city' => ['name' => 'Los Angeles']],
                    ['id' => 3, 'name' => 'Alice Johnson', 'city' => ['name' => 'Chicago']],
                    ['id' => 4, 'name' => 'Bob Brown', 'city' => ['name' => 'Houston']],
                ];

                $headers = [
                    ['key' => 'id', 'label' => '#'],
                    ['key' => 'name', 'label' => 'Nice Name'],
                    ['key' => 'city.name', 'label' => 'City'], # <---- nested attributes
                ];
            @endphp

            {{-- You can use any `$wire.METHOD` on `@row-click` --}}
            {{-- <x-mary-table :headers="$headers" :rows="$users" striped /> --}}
            {{-- <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" /> --}}
            <div class="p-4">
                <div class="mb-4">
                    <flux:heading size="xl">Recent Updates</flux:heading>

                    <flux:text class="mt-2">This information will be displayed publicly.</flux:text>
                </div>

                <div>
                    <flux:callout class="mb-4">
                        <flux:callout.heading icon="newspaper">Policy update</flux:callout.heading>
                        <flux:callout.text>We've updated our Terms of Service and Privacy Policy. Please review them to
                            stay
                            informed.</flux:callout.text>
                    </flux:callout>
                </div>

                <div class="mb-4">
                    <flux:callout>
                        <flux:callout.heading icon="newspaper">Policy update</flux:callout.heading>
                        <flux:callout.text>We've updated our Terms of Service and Privacy Policy. Please review them to
                            stay
                            informed.</flux:callout.text>
                    </flux:callout>
                </div>

            </div>


        </div>





        {{-- basta end ni siya --}}
    </div>


</div>
