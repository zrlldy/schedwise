<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">

    <div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10 ">
        <div class="bg-gray-600 w-full text-center max-w-[80%] rounded-2xl p-4">
            <heade class="font-bold text-2xl text-white"> Schedwise</header>
        </div>




        <div class="flex flex-row    w-[80%] justify-between ">
            <div class="flex flex-col  justify-center  ">
                <div class="font-bold text-3xl">Welcome to Schedwise!</div>
                <div class="text-gray-500 text-start">Your Timetabling Scheduling System</div>
            </div>
            <div class="flex w-full max-w-sm flex-col gap-2   ">
                <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>


                    {{-- <span class="flex h-9 w-9 mb-1 items-center justify-center rounded-md">
                    <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                </span> --}}
                    <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                </a>

                {{ $slot }}
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
