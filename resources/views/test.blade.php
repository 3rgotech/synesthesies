<x-app-layout>
    <div
        class="relative container mx-auto min-h-screen px-2 lg:px-8 xl:px-16 py-24 sm:py-16 flex flex-col justify-center items-stretch">
        @if (filled($testComponent))
            <livewire:dynamic-component :is="$testComponent" :testId="$testId" />
        @else
            <div class="border-l-4 border-red-400 bg-red-50 px-4 py-8 max-w-lg mx-auto">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <x-fas-circle-xmark class="h-5 w-5 text-red-400" />
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">
                            {{ __('public.test.unsupported') }}
                        </p>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
