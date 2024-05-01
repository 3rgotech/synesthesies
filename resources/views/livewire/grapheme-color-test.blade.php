<div class="flex-1 flex flex-col items-stretch">
    <div class="flex-1 flex flex-col justify-center items-stretch space-y-8 mx-auto" x-data="grapheme"
        x-bind:class="!!results && 'hidden'">
        <div class="flex flex-col items-stretch">
            <h1 class="text-bold text-4xl text-center">
                {{ $this->test->title }}
            </h1>
            <div class="flex flex-row items-stretch border border-gray-400 rounded-xl divide-x divide-gray-400">
                <div class="flex flex-col items-stretch divide-y divide-gray-400">
                    <div class="flex-1 flex justify-center items-center px-8">
                        <template x-for="(grapheme, graphemeIndex) in (`${stimulus}`.split(''))">
                            <span class="block font-display font-light text-[12rem] border-gray-600" x-html="grapheme"
                                x-bind:style="{
                                    color: selectedColor[!!distinctColors ? graphemeIndex : 0],
                                    borderWidth: !!distinctColors ? (
                                        graphemeIndex === distinctIndex ? '1px' : 0) : 0
                                }">
                            </span>
                        </template>
                    </div>
                    <template x-if="`${stimulus}`.length > 1">
                        <div class="relative flex items-center justify-center px-2 py-4">
                            <div class="flex h-6 items-center">
                                <input x-model="distinctColors" id="distinctColors" name="distinctColors"
                                    type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="distinctColors"
                                    class="font-medium text-gray-900">{{ __('public.test.distinct_colors') }}</label>
                            </div>
                        </div>
                    </template>
                </div>
                <div id="picker" class="p-8" x-ignore wire:ignore>
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <button x-on:click="next" x-bind:disabled="!canAdvance"
                class="block font-semibold rounded-l-full rounded-r-full text-white py-2 px-4"
                x-bind:class="canAdvance ? 'bg-gradient-to-r from-blue-700 to-purple-700' :
                    'cursor-not-allowed bg-gradient-to-r from-blue-300 to-purple-300'">
                {{ __('public.test.next') }}
            </button>
        </div>

        <div class="flex-shrink-0 w-full bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                x-bind:style="{ width: progress + '%', minWidth: '30px' }" x-text="progress + '%'"></div>
        </div>
    </div>
    @if (filled($results))
        <div class="flex-1 flex flex-col items-center py-32" x-bind:class="(results ?? []).length === 0 && 'hidden'">
            <h1 class="text-bold text-4xl text-center mb-4">
                {{ $this->test->title }}
            </h1>
            <div class="flex flex-col flex-1 justify-center">
                <div class="grid grid-cols-2 gap-x-16">
                    @foreach ($results as $grapheme => $data)
                        @if (filled($grapheme))
                            <div class="grid grid-cols-4 divide-x divide-gray-600 border border-gray-600 items-stretch">
                                @foreach ($data['responses'] as $item)
                                    <span
                                        class="block font-display font-semibold text-3xl text-center w-16 {{ array_sum($item) > 600 ? 'bg-black' : '' }}"
                                        style="color: rgb({{ implode(',', $item) }})">
                                        {{ $grapheme }}
                                    </span>
                                @endforeach

                                <span class="flex items-center justify-center text-xl">
                                    {{ round($data['score'], 2) }}
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
            <div class="flex justify-center">
                <a href="{{ route('test-list') }}"
                    class="block font-semibold rounded-l-full rounded-r-full text-white py-2 px-4 bg-gradient-to-r from-blue-700 to-purple-700">
                    {{ __('public.test.back_to_list') }}
                </a>
            </div>

        </div>
    @endif
</div>
@script
    <script>
        Alpine.data('grapheme', () => {
            return {
                results: $wire.$entangle('results'),
                currentIndex: $wire.$entangle('currentIndex'),
                stimulus: $wire.$entangle('stimulus'),
                totalStimuli: $wire.$entangle('totalStimuli'),
                progress: 0,
                picker: null,
                selectedColor: [],
                distinctColors: false,
                distinctIndex: 0,
                canAdvance: false,
                start: null,

                init() {
                    this.$watch('currentIndex', () => {
                        this.updateDisplay();
                        this.distinctColors = false;
                        this.distinctIndex = 0;
                        this.canAdvance = false;
                        this.selectedColor = ['#000000'];
                        this.$nextTick(() => {})
                    });
                    this.picker = new window.iro.ColorPicker('#picker', {
                        borderWidth: 1,
                        borderColor: 'rgb(156,163,175)',
                        wheelAngle: Math.floor(Math.random() * 360),
                    });
                    this.picker.on('input:change', (c) => {
                        this.canAdvance = true;
                        this.selectedColor[this.distinctIndex] = c.hexString;
                        console.log(this.selectedColor);
                    })
                    this.updateDisplay();
                },
                updateDisplay() {
                    this.progress = Math.round(Math.min(100, (this.currentIndex / this.totalStimuli) *
                        100));
                    this.picker.setOptions({
                        wheelAngle: Math.floor(Math.random() * 360)
                    });
                    this.picker.reset();
                    this.start = Date.now();
                },
                showPicker() {

                },
                next() {
                    if (`${this.stimulus}`.length > 0 &&
                        this.distinctColors &&
                        this.distinctIndex < (`${this.stimulus}`.length - 1)) {
                        this.distinctIndex = this.distinctIndex + 1;
                    } else {
                        $wire.storeValue(this.picker.color.hexString, Date.now() - this.start);
                    }
                }
            }
        })
    </script>
@endscript
