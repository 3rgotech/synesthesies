<div class="flex-1 flex flex-col items-stretch">
    @if (is_null($results))
        <div class="flex-1 flex flex-col justify-center items-stretch space-y-8 mx-auto" x-data="grapheme">
            <div class="flex flex-col items-stretch space-y-8">
                <h1 class="text-bold text-4xl text-center">
                    {{ $this->test->title }}
                </h1>
                {!! $this->test->introduction !!}
                <div class="flex flex-row items-stretch border border-gray-400 rounded-xl divide-x divide-gray-400">
                    <div class="flex-1 flex flex-col items-stretch divide-y divide-gray-400">
                        <div class="flex-1 flex justify-center items-center px-8">
                            <template x-for="(grapheme, graphemeIndex) in (`${stimulus}`.split(''))">
                                <span class="block font-display font-light text-[12rem] border-gray-600"
                                    x-html="grapheme"
                                    x-bind:style="{
                                        color: noColor ? '#000000' : selectedColor[!!distinctColors ? graphemeIndex :
                                            0],
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
                        <div class="relative flex items-center justify-center px-2 py-4">
                            <div class="flex h-6 items-center">
                                <input x-model="noColor" id="noColor" name="noColor" type="checkbox"
                                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="noColor"
                                    class="font-medium text-gray-900">{{ __('public.test.no_color') }}</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1 flex justify-center p-8" id="picker" class="p-8" x-ignore wire:ignore>
                    </div>
                </div>
            </div>
            <div class="flex justify-center">
                <button x-on:click="next" x-bind:disabled="!canAdvance"
                    class="block font-semibold rounded-l-full rounded-r-full text-white py-2 px-4"
                    x-bind:class="canAdvance ? 'cursor-pointer bg-gradient-to-r from-blue-700 to-purple-700' :
                        'cursor-not-allowed bg-gradient-to-r from-blue-300 to-purple-300'">
                    {{ __('public.test.next') }}
                </button>
            </div>

            <div class="flex-shrink-0 w-full bg-gray-200 rounded-full dark:bg-gray-700">
                <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                    x-bind:style="{ width: progress + '%', minWidth: '30px' }" x-text="progress + '%'"></div>
            </div>
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
                        noColor: false,
                        distinctColors: false,
                        distinctColorsMemory: [],
                        distinctIndex: 0,
                        canAdvance: false,
                        start: null,

                        init() {
                            this.$watch('currentIndex', () => {
                                this.updateDisplay();
                                this.noColor = false;
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
                            })
                            this.$watch('noColor', (nc) => {
                                this.canAdvance = !!nc || (this.distinctColors && this.distinctIndex === (
                                    `${this.stimulus}`.length - 1));
                            });
                            this.$watch('distinctColors', (dc) => {
                                this.canAdvance = !!nc || (this.distinctColors && this.distinctIndex === (
                                    `${this.stimulus}`.length - 1));
                            });
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
                            if (this.noColor) {
                                $wire.storeValue(null, Date.now() - this.start);
                            } else if (`${this.stimulus}`.length > 0 &&
                                this.distinctColors &&
                                this.distinctIndex < (`${this.stimulus}`.length - 1)) {
                                this.distinctIndex = this.distinctIndex + 1;
                            } else {
                                $wire.storeValue(this.selectedColor, Date.now() - this.start);
                            }
                        }
                    }
                })
            </script>
        @endscript
    @else
        <x-grapheme-color-results :test="$this->test" :results="$results" :backUrl="route('test-list')" />
    @endif
</div>
