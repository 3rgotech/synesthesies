<div @class([
    'flex-1 flex flex-col justify-start items-stretch mx-auto w-full' => true,
    'sm:max-h-[50vh]' => filled($backUrl),
])>
    <div @class([
        'flex-1 flex flex-col justify-center items-stretch overflow-y-scroll' => true,
        'w-3/4 mx-auto' => filled($backUrl),
    ])>
        @foreach ($test->questions as $index => $question)
            <div @class([
                'flex justify-between items-center space-x-4 transition ease-in-out delay-150 py-1' => true,
                'border-b border-gray-200' => true,
                'border-t border-gray-200' => $loop->first,
            ])>
                <span
                    class="flex-shrink-0 inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-sm font-bold text-gray-600 ring-1 ring-inset ring-gray-500">
                    {{ $index + 1 }}
                </span>
                <span class="text-center whitespace-normal block font-semibold leading-6 text-gray-900 dark:text-white">
                    {{ $question->question }}
                </span>
                <div
                    class="whitespace-nowrap rounded bg-white px-2 py-1 text-xs font-semibold text-gray-600 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                    {{ $test->scale[$resultsData[$question->id]] }}
                </div>
            </div>
        @endforeach
    </div>
    @if (!is_null($score))
        <h2 class="font-bold text-3xl text-center mb-4 flex items-center space-x-4">
            <span class="underline">
                {{ __('public.test.final_score') }}
            </span>
            @if (is_numeric($score))
                <span>
                    {{ round($score, 2) }}
                </span>
            @elseif(is_array($score))
                <ul class="list-disc">
                    @foreach ($score as $criteria => $criteriaScore)
                        <li>{{ __('public.test.score_criteria.' . $criteria) }} : {{ round($criteriaScore, 2) }}</li>
                    @endforeach
                </ul>
            @endif
    @endif
    </h2>
    @if (filled($backUrl))
        @if (!is_null($test->score_explanation))
            <h2 class="text-lg font-light text-center mb-8">
                {{ __('public.test.final_score_explanation') }}
            </h2>
        @endif
        <div class="flex justify-center">
            <a href="{{ $backUrl }}"
                class="block font-semibold rounded-l-full rounded-r-full text-white py-2 px-4 bg-gradient-to-r from-blue-700 to-purple-700">
                {{ __('public.test.back_to_list') }}
            </a>
        </div>
    @endif
</div>
