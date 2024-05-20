<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

</head>

<body class="font-sans text-gray-900 antialiased w-screen min-h-screen bg-slate-100">
    <div class="fixed inset-x-0 z-max bg-slate-100">
        <nav
            class="flex flex-col md:flex-row items-stretch md:items-center justify-center md:justify-between flex-wrap p-3 lg:px-0 container mx-auto space-y-2 md:space-y-0">
            <div class="flex justify-center items-center">
                <a href="{{ route('home') }}"
                    class="bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-purple-700 font-bold text-lg md:ml-2">
                    {{ config('app.name') }}
                </a>
            </div>
            <div class="flex-grow flex items-center w-auto text-center shadow-3xl">
                <ul class="flex justify-between md:justify-end flex-1 items-center">
                    @unless (Route::current()->getName() === 'test-list')
                        <li class="md:mr-3">
                            <a class="inline-block text-gray-500 no-underline hover:text-indigo-500 py-2 px-4"
                                href="{{ route('test-list') }}">
                                {{ __('public.test_list') }}
                            </a>
                        </li>
                    @endunless
                    <li class="md:mr-3">
                        <a class="inline-block bg-gradient-to-r from-blue-700 to-purple-700 font-semibold rounded-l-full rounded-r-full text-white py-2 px-4"
                            href="{{ route('logout') }}">
                            {{ __('public.logout') }}
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    {{ $slot }}

    <footer class="md:fixed md:bottom-0 md:inset-x-0 text-center py-2 px-4 bg-slate-100">
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
