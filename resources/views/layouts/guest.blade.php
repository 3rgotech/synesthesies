<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="w-screen min-h-screen">
        <div class="lg:fixed w-full">
            <nav class="flex items-center justify-center lg:justify-between flex-wrap p-6 lg:px-0 container mx-auto"
                x-data="{ isOpen: false }" @keydown.escape="isOpen = false" @click.away="isOpen = false">
                <div class="flex items-center">
                    <a href="{{ route('home') }}"
                        class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-500 font-bold text-lg">{{ config('app.name') }}</a>
                </div>
                <button @click="isOpen = !isOpen" type="button"
                    class="ml-auto block lg:hidden px-2 text-primary-500 hover:text-primary-500 focus:outline-none focus:text-primary-500"
                    :class="{ 'transition transform-180': isOpen }" aria-label="Menu">
                    <x-fas-bars class="h-6 w-6" x-show="!isOpen" />
                    <x-fas-xmark class="h-6 w-6" x-show="isOpen" />
                </button>
                <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto text-center hidden"
                    :class="{ 'block shadow-3xl': isOpen, 'hidden': !isOpen }" x-show.transition="true">
                    <ul class="pt-6 lg:pt-0 list-reset lg:flex justify-end flex-1 items-center">
                        <li class="nav__item mr-3">
                            <a @click="isOpen = false"
                                class="text-ml inline-block text-gray-500 no-underline hover:text-indigo-500 py-2 px-4"
                                href="{{ route('home') }}">
                                {{ __('public.home') }}
                            </a>
                        </li>
                        <li class="nav__item mr-3">
                            <a @click="isOpen = false"
                                class="text-ml inline-block text-gray-500 no-underline hover:text-indigo-500 py-2 px-4"
                                href="#">
                                Menu Two
                            </a>
                        </li>
                        <li class="nav__item mr-3">
                            <a @click="isOpen = false"
                                class="text-ml inline-block text-gray-500 no-underline hover:text-indigo-500 py-2 px-4"
                                href="#">
                                Menu Three
                            </a>
                        </li>
                        <li class="nav__item mr-3">
                            <a @click="isOpen = false"
                                class="text-ml inline-block text-gray-500 no-underline hover:text-indigo-500 py-2 px-4"
                                href="/blog">
                                Blog
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        {{ $slot }}

        <footer class="fixed bottom-0 text-center w-full py-4">
            <small class="text-gray-500">
                Copyright &copy; CERPPS - Université Toulouse 2 Jean Jaurès 2023-{{ date('Y') }}
                &middot;
                <a href="{{ route('legal') }}">{{ __('public.legal') }}</a>
                &middot;
                <a href="{{ route('privacy') }}">{{ __('public.privacy') }}</a>
            </small>
        </footer>
    </div>
</body>

</html>
