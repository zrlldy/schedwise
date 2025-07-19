<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Schedwise</title>

    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- @fluxAppearance
    @livewireStyles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->



</head>




<body
    class="w-screen h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col items-center justify-center p-5">
    {{-- <nav class="  w-full shadow-sm border rounded-xl p-4 mt-10 bg-red-600"> --}}

    <nav
        class="fixed top-0 z-50 w-[60%] bg-[#373434] dark:bg-zinc-900 flex items-center justify-between gap-4 p-4 shadow-sm border border-amber-100 rounded-2xl mt-8 text-white">
        <h1></h1>
        <h1></h1>
        <h1 class="text-center flex items-center justify-center font-bold ">Schedwise</h1>
        <div class="flex items-center justify-end gap-3">

            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#ffff] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#ffff] border border-transparent hover:border-[#ffff] dark:hover:border-[#ffff] rounded-sm text-sm leading-normal">
                        Log in
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block px-5 py-1.5 dark:text-[#121210] border-[#ffff] hover:border-[#ffff] border text-[#ffff] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>
    {{-- content for my or static page for my schedwise --}}


    @livewire('page.guest-page')

    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>
