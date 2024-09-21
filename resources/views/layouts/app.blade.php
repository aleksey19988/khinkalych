<!doctype html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-800 font-light mb-32">
<header class="container mx-auto">
    <div class="flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('profiles.index') }}">
            <button type="button"
                    class="
                    transition
                    ease-in-out
                    duration-500
                    w-36
                    h-10
                    text-xl
                    text-gray-900
                    bg-white
                    border
                    border-gray-300
                    focus:outline-none
                    hover:bg-gray-100
                    focus:ring-4
                    focus:ring-gray-100
                    font-normal
                    rounded-xl
                    dark:bg-gray-600
                    dark:text-white
                    dark:border-gray-600
                    dark:hover:bg-gray-700
                    dark:hover:border-gray-600
                    dark:focus:ring-gray-700
                    sm:w-36
                    sm:h-12
                    sm:text-2xl"
            >
                Имя
            </button>
        </a>
        <a href="{{ route('seals.create') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="/resources/media/svg/logo_light.svg" class="h-20 sm:h-30 md:h-35" alt="Flowbite Logo"/>
        </a>
    </div>
</header>
<div class="container px-4 mx-auto">
    <div class="border-line h-px bg-white"></div>
</div>
<div class="container mx-auto px-4">
    @yield('content')
</div>
<footer>
    <nav>
        <div class="
            fixed
            z-40
            w-full
            h-16
            max-w-xs
            -translate-x-1/2
            bg-white
            border
            border-gray-200
            rounded-xl
            bottom-4
            left-1/2
            dark:bg-gray-600
            dark:border-gray-600"
        >
            <div class="grid h-full max-w-xs grid-cols-3 mx-auto">
                <button data-tooltip-target="" type="button" class="
                    transition
                    ease-in-out
                    duration-500
                    inline-flex
                    flex-col
                    items-center
                    justify-center
                    group
                    rounded-xl
                    @if(str_contains(Route::currentRouteName(), 'seals') && !str_contains(Route::currentRouteName(), 'check'))
                    dark:bg-red-900
                    hover:bg-red-700
                    @endif
                    my-1
                    mx-2
                    hover:bg-gray-800"
                >
                    <a href="{{ route('seals.create') }}" class="flex w-full h-full items-center justify-center">
                        <img src="/resources/media/svg/add_icon.svg" alt="Добавление печати" class="h-8">
                    </a>
                    <span class="sr-only">Добавление печати</span>
                </button>
                <button data-tooltip-target="" type="button" class="
                    transition
                    ease-in-out
                    duration-500
                    inline-flex
                    flex-col
                    items-center
                    justify-center
                    group
                    rounded-xl
                    @if(str_contains(Route::currentRouteName(), 'profiles'))
                    dark:bg-red-900
                    hover:bg-red-700
                    @endif
                    my-1
                    mx-2
                    hover:bg-gray-800"
                >
                    <a href="{{ route('profiles.index') }}" class="flex w-full h-full items-center justify-center">
                        <img src="/resources/media/svg/profile_icon.svg" alt="Профиль" class="h-8">
                    </a>
                    <span class="sr-only">Профиль</span>
                </button>
                <button data-tooltip-target="" type="button" class="
                    transition
                    ease-in-out
                    duration-500
                    inline-flex
                    flex-col
                    items-center
                    justify-center
                    rounded-xl
                    @if(str_contains(Route::currentRouteName(), 'utilities'))
                    dark:bg-red-900
                    hover:bg-red-700
                    @endif
                    my-1
                    mx-2
                    hover:bg-gray-800"
                >
                    <a href="{{ route('utilities.index') }}" class="flex w-full h-full items-center justify-center">
                        <img src="/resources/media/svg/utilities_icon.svg" alt="Утилиты" class="h-8">
                    </a>
                    <span class="sr-only">Утилиты</span>
                </button>
            </div>
        </div>
    </nav>
</footer>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>
