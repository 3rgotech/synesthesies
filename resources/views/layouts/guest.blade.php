<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css'])
    @livewireStyles

</head>

<body class="font-sans text-gray-900 antialiased w-screen min-h-screen bg-slate-100">
    <div class="fixed inset-x-0 z-max bg-slate-100">
        <nav class="flex items-center justify-center md:justify-between flex-wrap p-3 lg:px-0 container mx-auto">
            <div class="flex items-center">
                <a href="{{ route('home') }}"
                    class="bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-purple-500 font-bold text-lg">
                    {{ config('app.name') }}
                </a>
            </div>
            <div class="flex-grow flex items-center w-auto text-center shadow-3xl">
                <ul class="flex justify-end flex-1 items-center">
                    @unless (Route::current()->getName() === 'home')
                        <li class="md:mr-3">
                            <a class="inline-block text-gray-500 no-underline hover:text-indigo-500 py-2 px-4"
                                href="{{ route('home') }}">
                                {{ __('public.home') }}
                            </a>
                        </li>
                    @endunless
                    @unless (Route::current()->getName() === 'login')
                        <li class="md:mr-3">
                            <a class="inline-block bg-gradient-to-r from-blue-500 to-purple-500 font-semibold rounded-l-full rounded-r-full text-white py-2 px-4"
                                href="{{ route('home') }}">
                                {{ __('public.login') }}
                            </a>
                        </li>
                    @endunless
                </ul>
            </div>
        </nav>
    </div>
    {{ $slot }}

    <footer class="md:fixed md:bottom-0 md:inset-x-0 text-center py-2 px-4">
        <small class="text-gray-500">
            Copyright &copy; CERPPS - Université Toulouse 2 Jean Jaurès 2023-{{ date('Y') }}
            &middot;
            <a href="{{ route('legal') }}">{{ __('public.legal') }}</a>
            &middot;
            <a href="{{ route('privacy') }}">{{ __('public.privacy') }}</a>
        </small>
    </footer>
    @livewireScripts
</body>

</html>
