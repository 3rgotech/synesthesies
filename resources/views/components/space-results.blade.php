@props(['results', 'backUrl' => null])

<div @class([
    'flex-1 flex flex-col items-center' => true,
    'py-32' => filled($backUrl),
])>
    @if (filled($backUrl))
        <h1 class="text-bold text-4xl text-center mb-4">
            {{ $test->title }}
        </h1>
    @endif
    <div class="flex flex-col flex-1 justify-center">
        <div class="grid grid-cols-2 gap-x-16">
            @foreach ($results->data as $grapheme => $data)
                @if (filled($grapheme))
                    <div class="grid grid-cols-2 divide-x divide-gray-600 border border-gray-600 items-stretch">
                        <span class="block font-display font-semibold text-3xl text-center px-2">
                            {{ $grapheme }}
                        </span>

                        <span class="flex items-center justify-center text-xl">
                            @if (is_null($data['score']))
                                &oslash;
                            @else
                                {{ round($data['score'], 2) }}
                            @endif
                        </span>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <h2 class="font-bold text-3xl text-center my-4">
        {{ __('public.test.final_score') }} {{ round($totalScore, 2) }}
    </h2>
    @if (filled($backUrl))
        <h2 class="text-lg font-light text-center mb-8">
            {{ __('public.test.final_score_explanation') }}
        </h2>
        <div class="flex justify-center">
            <a href="{{ $backUrl }}"
                class="block font-semibold rounded-l-full rounded-r-full text-white py-2 px-4 bg-gradient-to-r from-blue-700 to-purple-700">
                {{ __('public.test.back_to_list') }}
            </a>
        </div>
    @endif
</div>
