<x-guest-layout>
    <div
        class="relative container mx-auto h-screen flex flex-col justify-center items-center lg:w-1/2 space-y-6 md:space-y-16">
        <h1 class="text-3xl md:text-7xl">
            <strong class="bg-clip-text text-transparent bg-gradient-to-r from-blue-700 to-purple-700">
                {{ config('app.name') }}
            </strong>
        </h1>
        <div
            class="text-base md:text-lg prose max-w-none prose-headings:text-gray-900 prose-a:text-blue-500 prose-strong:text-gray-900 px-2 text-justify">
            {!! $texts['main'] !!}
        </div>
        <div class="flex flex-col md:flex-row justify-center items-stretch space-y-4 md:space-y-0 md:space-x-12">
            <div class="flex justify-center">
                <img src="ut2j_logo.png" class="h-16 md:h-24" alt="Université Toulouse 2 Jean Jaurès"
                    title="Université Toulouse 2 Jean Jaurès">
            </div>
            <div class="flex justify-center">
                <img src="cerpps_logo.png" class="h-16 md:h-24" alt="Laboratoire CERPPS" title="Laboratoire CERPPS">
            </div>
            <div class="flex justify-center">
                <img src="anr_logo.png" class="h-16 md:h-24" alt="Projet Financé par l'ANR"
                    title="Projet Financé par l'ANR">
            </div>
        </div>
        <div class="absolute bottom-0 inset-x-0 flex justify-center pb-2 md:pb-16">
            <a href="#details" class="rounded-full border border-gray-500 p-2 md:animate-bounce">
                <x-fas-angles-down class="h-4 w-4 md:h-8 md:w-8 text-gray-500" />
            </a>
        </div>
    </div>
    <div class="container mx-auto md:min-h-screen flex flex-col justify-center items-center lg:w-2/3 space-y-8 py-16"
        id="details">
        @foreach ($texts['blocks'] as $block)
            <h2 class="text-xl md:text-4xl w-full text-center">
                <strong class="text-blue-500">
                    {{ $block['title'] }}
                </strong>
            </h2>
            <div
                class="text-base !w-full prose max-w-none prose-headings:text-blue-500 prose-headings:text-center prose-headings:text-lg prose-headings:md:text-3xl prose-a:text-blue-500 prose-strong:text-gray-900 text-justify px-2">
                {!! $block['text'] !!}
            </div>
        @endforeach
        <div
            class="w-full flex flex-col md:flex-row items-center border-t border-b border-blue-500 py-8 px-8 md:px-16 lg:px-32 space-y-8 md:space-y-0 md:space-x-32">
            <h3 class="flex-1 text-base md:text-xl text-blue-500 font-bold text-justify">
                {{ $texts['consent'] }}
            </h3>
            <a class="inline-block bg-gradient-to-r from-blue-700 to-purple-700 font-bold text-lg rounded-l-full rounded-r-full text-white py-2 px-4"
                href="{{ route('qualification') }}">
                {{ __('public.start_test') }}
            </a>
        </div>
    </div>
</x-guest-layout>
