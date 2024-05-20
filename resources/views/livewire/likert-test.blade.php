<div class="flex-1 flex flex-col items-stretch sm:max-h-[80vh]">
    <div class="flex flex-col items-stretch">
        <div class="lg:w-2/3 lg:mx-auto my-3 text-lg leading-8 text-gray-600 flex flex-col items-stretch space-y-4">
            <h1 class="text-bold text-4xl text-center">
                {{ $this->test->title }}
            </h1>
            {!! $this->test->introduction !!}
        </div>
    </div>
    <div class="flex-1 flex flex-col justify-start items-stretch mx-auto w-full sm:max-h-[50vh]" x-data="likert">
        @if (blank($results))
            <div
                class="flex-1 flex flex-col justify-start items-stretch mx-auto w-full overflow-y-scroll border-t border-b border-gray-200">
                <template x-for="(question, questionIndex) in questions">
                    <div class="flex items-center space-x-4 transition ease-in-out delay-150 border-b border-gray-200"
                        x-bind:id="'question-' + questionIndex" x-show="(questionIndex <= currentIndex)" x-transition>
                        <span
                            class="flex-shrink-0 inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-sm font-bold text-gray-600 ring-1 ring-inset ring-gray-500"
                            x-text="questionIndex+1"></span>
                        <div class="flex-1 py-4 flex flex-col items-stretch space-y-2" x-key="question.id">
                            <label for="about"
                                class="text-center whitespace-normal block font-semibold leading-6 text-gray-900"
                                x-text="question.question">
                            </label>
                            <div
                                class="flex-shrink-0 justify-center space-y-4 lg:flex lg:items-center lg:space-x-10 lg:space-y-0 lg:flex-wrap">
                                <template x-for="answer in Object.entries(scale)">
                                    <div class="flex-1 flex items-center" x-key="question.id + '-' + answer[0]">
                                        <input x-bind:id="question.id + '-' + answer[0]" type="radio"
                                            x-bind:name="question.id"
                                            x-on:change="$event.target.checked && next(question.id, answer[0])"
                                            class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                        <label x-bind:for="question.id + '-' + answer[0]"
                                            class="ml-3 block text-sm font-medium leading-6 text-gray-900"
                                            x-text="answer[1]"></label>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="flex-shrink-0 w-full lg:w-1/2 lg:mx-auto bg-gray-200 rounded-full dark:bg-gray-700 mt-4 h-4"
                x-show="results === null" x-key="progress-bar">
                <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full h-4"
                    x-bind:style="{ width: progress + '%', minWidth: '30px' }" x-text="progress + '%'"></div>
            </div>
            <div class="flex justify-center mt-2" x-show="results === null" x-key="results-button">
                <button x-bind:disabled="remainingQuestions > 0" x-on:click="storeResults()"
                    class="block font-semibold rounded-l-full rounded-r-full text-white py-2 px-4"
                    x-bind:class="remainingQuestions === 0 ? 'cursor-pointer bg-gradient-to-r from-blue-700 to-purple-700' :
                        'cursor-not-allowed bg-gradient-to-r from-blue-300 to-purple-300'">
                    {{ __('public.test.save') }}
                </button>
            </div>
        @else
            <x-likert-test-results :test="$this->test" :results="$results" :backUrl="route('test-list')" />
        @endif
    </div>
</div>
@script
    <script>
        Alpine.data('likert', () => {
            return {
                scale: $wire.$entangle('scale'),
                questions: $wire.$entangle('questions'),
                results: $wire.$entangle('results'),
                remainingQuestions: $wire.$entangle('remainingQuestions'),
                totalQuestions: $wire.$entangle('totalQuestions'),
                currentIndex: 0,
                progress: 0,

                init() {
                    this.$watch('remainingQuestions', () => {
                        this.updateDisplay();
                        this.$nextTick(() => {
                            document.getElementById('question-' + this.currentIndex)
                                ?.scrollIntoView();
                        });
                    });
                    this.updateDisplay();
                },
                updateDisplay() {
                    this.currentIndex = this.totalQuestions - this.remainingQuestions;

                    this.progress = Math.round(
                        Math.min(
                            100,
                            ((this.totalQuestions - this.remainingQuestions) / this.totalQuestions) * 100
                        )
                    );
                },
                showPicker() {

                },
                next(questionId, questionResponse) {
                    $wire.storeValue(questionId, questionResponse);
                },
                storeResults() {
                    $wire.storeResults();
                }
            }
        })
    </script>
@endscript
