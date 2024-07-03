<div class="flex-1 flex flex-col items-stretch">
    @if (is_null($results))
        <div class="flex-1 flex flex-col justify-center items-stretch space-y-8 mx-auto" x-data="grapheme">
            <div class="flex flex-col items-stretch space-y-8">
                <h1 class="text-bold text-4xl text-center">
                    {{ $this->test->title }}
                </h1>
                {!! $this->test->introduction !!}
                <div class="flex flex-col items-stretch border border-gray-400 rounded-xl divide-y divide-gray-400">
                    <div class="flex items-stretch divide-x divide-gray-400">
                        <div class="flex-1 flex flex-col items-stretch divide-y divide-gray-400">
                            <div class="flex-1 flex flex-col justify-center items-center px-8">
                                <span class="block font-display font-light text-xl border-gray-600"
                                    x-bind:style="{ color: noColor ? '#000000' : selectedColor }">
                                    <x-fas-file-audio class="h-24 w-24" />
                                    <span class="sr-only" x-html="stimulus.label"></span>
                                </span>
                                <audio controls preload x-ref="audio">
                                    {{-- <source src="http://synesthesies.test/storage/4/a_pascal.wav" type="audio/x-wav"> --}}
                                    <source x-bind:src="stimulus.file" x-bind:type="stimulus.type">
                                    Votre navigateur ne supporte pas la lecture de fichiers audio
                                </audio>
                            </div>
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
                        <div id="picker" class="flex-1 flex justify-center p-8" x-ignore wire:ignore>
                        </div>
                    </div>
                    <div class="flex flex-col items-stretch divide-gray-400">
                        <div class="text-center text-sm font-semibold text-gray-900 px-2 pt-2">
                            {{ __('public.test.evolutive_perception_audio') }}
                        </div>
                        <div class="flex flex-row items-stretch justify-evenly flex-wrap">
                            <div class="relative flex items-center justify-center px-2 py-2">
                                <div class="flex h-6 items-center">
                                    <input x-model="evolutive" id="dynamic" name="evolutive" type="radio"
                                        value="dynamic"
                                        class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="dynamic"
                                        class="font-light text-gray-900">{{ __('public.test.evolutive_dynamic') }}</label>
                                </div>
                            </div>
                            <div class="relative flex items-center justify-center px-2 py-2">
                                <div class="flex h-6 items-center">
                                    <input x-model="evolutive" id="static" name="evolutive" type="radio"
                                        value="static"
                                        class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="static"
                                        class="font-light text-gray-900">{{ __('public.test.evolutive_static') }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col items-stretch divide-gray-400">
                        <div class="text-center text-sm font-semibold text-gray-900 px-2 pt-2">
                            {{ __('public.test.shape_perception_audio') }}
                        </div>
                        <div class="flex flex-row items-stretch justify-evenly flex-wrap">
                            @foreach (__('public.test.shape') as $key => $label)
                                <div class="relative flex items-center justify-center px-2 py-2">
                                    <div class="flex h-6 items-center">
                                        <input x-model="shape" id="{{ $key }}" name="shape" type="radio"
                                            value="{{ $key }}"
                                            class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                    </div>
                                    <div class="ml-3 text-sm leading-6">
                                        <label for="{{ $key }}"
                                            class="font-light text-gray-900">{{ $label }}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
                        selectedColor: null,
                        shape: null,
                        evolutive: null,
                        noColor: false,
                        canAdvance: false,
                        start: null,

                        init() {
                            this.$watch('currentIndex', () => {
                                this.updateDisplay();
                                this.noColor = false;
                                this.canAdvance = false;
                                this.selectedColor = '#000000';
                                this.shape = null;
                                this.evolutive = null;
                                this.$nextTick(() => {
                                    this.$refs.audio.load();
                                })
                            });
                            this.picker = new window.iro.ColorPicker('#picker', {
                                borderWidth: 1,
                                borderColor: 'rgb(156,163,175)',
                                wheelAngle: Math.floor(Math.random() * 360),
                            });
                            this.picker.on('input:change', (c) => {
                                this.selectedColor = c.hexString;
                                this.checkCanAdvance();
                            })
                            this.$watch('noColor', () => {
                                this.checkCanAdvance();
                            });
                            this.$watch('shape', () => {
                                this.checkCanAdvance();
                            });
                            this.$watch('evolutive', () => {
                                this.checkCanAdvance();
                            });
                            this.updateDisplay();
                            this.$refs.audio.load();
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
                        checkCanAdvance() {
                            this.canAdvance = (!!this.noColor || this.selectedColor !== null) && this.shape !== null &&
                                this.evolutive !== null;
                        },
                        next() {
                            if (this.noColor) {
                                $wire.storeValue(null, Date.now() - this.start, this.evolutive, this.shape);
                            } else {
                                $wire.storeValue(this.selectedColor, Date.now() - this.start, this.evolutive, this.shape);
                            }
                        }
                    }
                })
            </script>
        @endscript
    @else
        <x-audio-color-results :test="$this->test" :results="$results" :backUrl="route('test-list')" />
    @endif
</div>
