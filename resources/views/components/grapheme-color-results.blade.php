@props(['results', 'repetitions', 'backUrl' => null])

<div class="flex-1 flex flex-col items-center py-32">
    <h1 class="text-bold text-4xl text-center mb-4">
        {{ $test->title }}
    </h1>
    <div class="flex flex-col flex-1 justify-center">
        <div class="grid grid-cols-2 gap-x-16">
            @foreach ($results->data as $grapheme => $data)
                @if (filled($grapheme))
                    <div @class([
                        'grid divide-x divide-gray-600 border border-gray-600 items-stretch' => true,
                        'grid-cols-3' => $repetitions === 2,
                        'grid-cols-4' => $repetitions === 3,
                        'grid-cols-5' => $repetitions === 4,
                        'grid-cols-6' => $repetitions === 5,
                        'grid-cols-7' => $repetitions === 6,
                        'grid-cols-8' => $repetitions === 7,
                    ])>
                        @foreach ($data['responses'] as $item)
                            {{-- @if (strlen($grapheme) > 1) --}}
                            <span class="block font-display font-semibold text-3xl text-center w-16 tracking-tighter">
                                @foreach (str_split($grapheme) as $charIndex => $char)
                                    @php
                                        if ($item !== null && !array_key_exists($charIndex, $item)) {
                                            // If $item is not null but is smaller than $charIndex, color is first index
                                            $color = $item[0];
                                        } elseif ($item === null) {
                                            // If $item is null, color is black
                                            $color = [0, 0, 0];
                                        } else {
                                            $color = $item[$charIndex];
                                        }
                                    @endphp
                                    <span class="{{ array_sum($color) > 600 ? 'bg-black' : '' }}"
                                        style="color: rgb({{ implode(',', $color) }})">
                                        {{ $char }}
                                    </span>
                                @endforeach
                            </span>
                        @endforeach

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
    <h2 class="font-bold text-3xl text-center mb-4">
        {{ __('public.test.final_score') }} {{ round($totalScore, 2) }}
    </h2>
    <h2 class="text-lg font-light text-center mb-8">
        {{ __('public.test.final_score_explanation') }}
    </h2>
    @if (filled($backUrl))
        <div class="flex justify-center">
            <a href="{{ $backUrl }}"
                class="block font-semibold rounded-l-full rounded-r-full text-white py-2 px-4 bg-gradient-to-r from-blue-700 to-purple-700">
                {{ __('public.test.back_to_list') }}
            </a>
        </div>
    @endif
</div>
