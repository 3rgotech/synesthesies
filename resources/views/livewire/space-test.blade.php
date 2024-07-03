<div class="flex-1 flex flex-col items-stretch">
    @if (is_null($results))
        <div class="flex-1 flex flex-col justify-center items-stretch space-y-8 mx-auto" x-data="space">
            <div class="flex flex-col items-center space-y-8">
                <h1 class="text-bold text-4xl text-center">
                    {{ $this->test->title }}
                </h1>
                {!! $this->test->introduction !!}
                <div class="flex-1 border border-gray-400 rounded-xl h-[400px] w-[800px]" id="stage" x-ignore
                    wire:ignore></div>
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
                Alpine.data('space', () => {
                    return {
                        results: $wire.$entangle('results'),
                        currentIndex: $wire.$entangle('currentIndex'),
                        allStimuli: $wire.$entangle('allStimuli'),
                        stimulus: $wire.$entangle('stimulus'),
                        totalStimuli: $wire.$entangle('totalStimuli'),
                        initialSetup: $wire.$entangle('initialSetup'),
                        initialSetupLocal: null,
                        progress: 0,
                        canAdvance: false,
                        start: null,
                        coordinates: null,

                        stage: null,
                        itemLayer: null,

                        init() {
                            this.$watch('currentIndex', () => {
                                this.updateDisplay();
                                this.setupKonva([this.stimulus])
                                this.canAdvance = false;
                                this.coordinates = null;
                                this.$nextTick(() => {});
                            });
                            this.$watch('initialSetup', (v) => {
                                if (v !== null) {
                                    this.updateDisplay();
                                    this.setupKonva([this.stimulus]);
                                    this.canAdvance = false;
                                    this.$nextTick(() => {});
                                }
                            })
                            this.setupKonva(this.allStimuli);
                            this.updateDisplay();
                        },
                        setupKonva(items) {
                            if (this.stage !== null) {
                                this.itemLayer.find('Text').forEach((item) => item.destroy());
                            } else {
                                this.stage = new window.Konva.Stage({
                                    container: 'stage',
                                    width: 800,
                                    height: 400
                                });
                                const crossLayer = new window.Konva.Layer();
                                const size = 20;
                                const leftX = this.stage.width() * 0.25;
                                const leftY = this.stage.height() * 0.5;
                                const rightX = this.stage.width() * 0.75;
                                const rightY = this.stage.height() * 0.5;

                                crossLayer.add(
                                    new window.Konva.Line({
                                        points: [leftX - size, leftY, leftX + size, leftY, leftX, leftY, leftX,
                                            leftY -
                                            size, leftX, leftY + size
                                        ],
                                        stroke: 'black',
                                        strokeWidth: 2,
                                        lineCap: 'round',
                                        lineJoin: 'round',
                                    })
                                );
                                crossLayer.add(
                                    new window.Konva.Line({
                                        points: [rightX - size, rightY, rightX + size, rightY, rightX, rightY,
                                            rightX,
                                            rightY - size, rightX, rightY + size
                                        ],
                                        stroke: 'black',
                                        strokeWidth: 2,
                                        lineCap: 'round',
                                        lineJoin: 'round',
                                    })
                                );
                                this.stage.add(crossLayer);
                                this.itemLayer = new window.Konva.Layer();
                                this.stage.add(this.itemLayer);
                            }
                            // 18 items per column
                            const columns = Math.ceil(items.length / 18);
                            items.forEach((item, index) => {
                                const text = new Konva.Text({
                                    x: this.stage.width() * (0.95 - (columns - Math.floor(index / 18)) *
                                        0.05),
                                    y: ((index % 18) + 1) * 20,
                                    text: item,
                                    fontSize: 20,
                                    fontFamily: 'Nunito Sans',
                                    fill: 'black',
                                    draggable: true,
                                });
                                text.on('dragend', (e) => {
                                    this.onDrop(item, {
                                        x: e.target.attrs.x,
                                        y: e.target.attrs.y
                                    });
                                })
                                this.itemLayer.add(text);
                            });
                        },

                        updateDisplay() {
                            const initialIndex = this.initialSetup === null ? 0 : 1;
                            this.progress = Math.round(
                                Math.min(100, ((initialIndex + this.currentIndex) / (this.totalStimuli + 1)) * 100)
                            );
                            this.start = Date.now();
                        },

                        onDrop(stimulus, coordinates) {
                            if (this.initialSetup === null) {
                                if (this.initialSetupLocal === null) {
                                    this.initialSetupLocal = {};
                                }
                                this.initialSetupLocal[stimulus] = coordinates;
                                if (Object.entries(this.initialSetupLocal).length === this.allStimuli.length) {
                                    this.canAdvance = true;
                                }
                            } else {
                                this.coordinates = coordinates;
                                this.canAdvance = true;
                            }
                        },

                        next() {
                            if (this.initialSetupLocal !== null) {
                                $wire.storeInitialSetup(this.initialSetupLocal, Date.now() - this.start);
                                this.initialSetupLocal = null;
                            } else {
                                $wire.storeValue(this.coordinates, Date.now() - this.start);
                            }
                        }
                    }
                })
            </script>
        @endscript
    @else
        <x-space-results :test="$this->test" :results="$results" :backUrl="route('test-list')" />
    @endif
</div>
