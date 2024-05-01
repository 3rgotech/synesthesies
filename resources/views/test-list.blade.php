<x-app-layout>
    <div class="relative container mx-auto min-h-screen px-2 py-24 sm:py-16 flex flex-col justify-center items-stretch">
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ __('public.list.synesthesies') }}
            </h2>
            <p class="my-3 text-lg leading-8 text-gray-600">
                {{ __('public.list.synesthesies_description') }}
            </p>
        </div>
        <ul role="list" class="flex flex-wrap justify-center gap-6 px-4">
            @forelse ($tests as $test)
                <li
                    class="basis-full sm:basis-4/12 md:basis-3/12 lg:basis-2/12 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                    <div class="flex flex-1 flex-col p-4">
                        <div
                            class="mx-auto h-32 w-32 flex-shrink-0 rounded-full bg-slate-300 text-gray-700 flex items-center justify-center">
                            @svg($test['icon'], 'size-16')
                        </div>
                        <h3 class="mt-6 text-sm font-medium text-gray-900">
                            {{ $test['title'] }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ $test['description'] }}
                        </p>
                        <div class="mt-3 text-xs">
                            {{ __('public.test.duration') }}
                            <span
                                class="inline-flex items-center rounded-full bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-600/20">
                                {{ $test['duration'] }}
                            </span>
                        </div>
                        </dl>
                    </div>
                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="flex w-0 flex-1">
                                <a href="{{ route('test', ['test' => $test['id']]) }}"
                                    class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                    @if ($test['user_has_completed'])
                                        <x-fas-check class="h-5 w-5 text-green-400" />
                                        {{ __('public.test.check_result') }}
                                    @else
                                        <x-fas-arrow-right class="h-5 w-5 text-gray-400" />
                                        {{ __('public.test.perform_test') }}
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <div class="relative block w-3/4 rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
                    <x-fas-folder-open class="mx-auto h-12 w-12 text-gray-400" />
                    <span class="mt-2 block text-sm font-semibold text-gray-700">
                        {{ __('public.list.empty') }}
                    </span>
                </div>
            @endforelse
        </ul>
        <div class="mx-auto max-w-2xl text-center mt-4">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                {{ __('public.list.likert') }}
            </h2>
            <p class="my-3 text-lg leading-8 text-gray-600">
                {{ __('public.list.likert_description') }}
            </p>
        </div>
        <ul role="list" class="flex flex-wrap justify-center gap-6 px-4">
            @forelse ($likert_tests as $test)
                <li
                    class="basis-full sm:basis-4/12 md:basis-3/12 lg:basis-2/12 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                    <div class="flex flex-1 flex-col p-4">
                        <div
                            class="mx-auto h-32 w-32 flex-shrink-0 rounded-full bg-slate-300 text-gray-700 flex items-center justify-center">
                            @svg($test['icon'], 'size-16')
                        </div>
                        <h3 class="mt-6 text-sm font-medium text-gray-900">
                            {{ $test['title'] }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ $test['description'] }}
                        </p>
                        <div class="mt-3 text-xs">
                            {{ __('public.test.duration') }}
                            <span
                                class="inline-flex items-center rounded-full bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700 ring-1 ring-inset ring-slate-600/20">
                                {{ $test['duration'] }}
                            </span>
                        </div>
                        </dl>
                    </div>
                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="flex w-0 flex-1">
                                <a href="{{ route('test-likert', ['test' => $test['id']]) }}"
                                    class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                    @if ($test['user_has_completed'])
                                        <x-fas-check class="h-5 w-5 text-green-400" />
                                        {{ __('public.test.check_result') }}
                                    @else
                                        <x-fas-arrow-right class="h-5 w-5 text-gray-400" />
                                        {{ __('public.test.perform_test') }}
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @empty
                <div class="relative block w-3/4 rounded-lg border-2 border-dashed border-gray-300 p-12 text-center">
                    <x-fas-folder-open class="mx-auto h-12 w-12 text-gray-400" />
                    <span class="mt-2 block text-sm font-semibold text-gray-700">
                        {{ __('public.list.empty') }}
                    </span>
                </div>
            @endforelse
        </ul>
    </div>
</x-app-layout>
