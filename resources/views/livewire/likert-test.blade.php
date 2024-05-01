<div class="flex-1 flex flex-col items-stretch">
    <div class="flex flex-col items-stretch">
        <div class="lg:w-1/2 lg:mx-auto my-3 text-lg leading-8 text-gray-600 flex flex-col items-stretch space-y-4">
            <h1 class="text-bold text-4xl text-center">
                {{ $this->test->title }}
            </h1>
            {!! $this->test->introduction !!}
        </div>
    </div>
    <div class="flex-1 flex flex-col justify-center items-stretch mx-auto w-full overflow-y-scroll divide-y divide-gray-200"
        x-data="likert" x-bind:class="!!results && 'hidden'">
        <template x-for="(question, questionIndex) in questions">
            <div class="py-4 flex flex-col items-start space-y-2" x-key="question.id"
                x-bind:class="(questionIndex > this.currentIndex) && 'hidden'">
                <div class="flex items-center space-x-4">
                    <span
                        class="flex-shrink-0 inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-sm font-bold text-gray-600 ring-1 ring-inset ring-gray-500"
                        x-text="questionIndex+1"></span>
                    <label for="about" class="flex-1 whitespace-normal block font-semibold leading-6 text-gray-900"
                        x-text="question.question">
                    </label>
                </div>
                <div class="flex-shrink-0 space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                    <template x-for="answer in Object.entries(scale)">
                        <div class="flex items-center" x-key="question.id + '-' + answer[0]">
                            <input x-bind:id="question.id + '-' + answer[0]" type="radio"
                                class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label x-bind:for="question.id + '-' + answer[0]"
                                class="ml-3 block text-sm font-medium leading-6 text-gray-900"
                                x-text="answer[1]"></label>
                        </div>
                    </template>
                </div>
            </div>
        </template>

        <div class="flex-shrink-0 w-full lg:w-1/2 lg:mx-auto bg-gray-200 rounded-full dark:bg-gray-700">
            <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                x-bind:style="{ width: progress + '%', minWidth: '30px' }" x-text="progress + '%'"></div>
        </div>
    </div>
    @if (filled($results))
        <div class="flex justify-center">
            <a href="{{ route('test-list') }}"
                class="block font-semibold rounded-l-full rounded-r-full text-white py-2 px-4 bg-gradient-to-r from-blue-700 to-purple-700">
                {{ __('public.test.back_to_list') }}
            </a>
        </div>
    @endif
</div>
@script
    <script>
        Alpine.data('likert', () => {
            return {
                scale: $wire.$entangle('scale'),
                questions: $wire.$entangle('questions'),
                results: $wire.$entangle('results'),
                score: $wire.$entangle('score'),
                remainingQuestions: $wire.$entangle('remainingQuestions'),
                totalQuestions: $wire.$entangle('totalQuestions'),
                currentIndex: 0,
                progress: 0,

                init() {
                    console.log(this.totalQuestions, this.remainingQuestions);
                    this.$watch('remainingQuestions', () => {
                        this.updateDisplay();
                        this.$nextTick(() => {});
                    });
                    this.updateDisplay();
                },
                updateDisplay() {
                    this.currentIndex = this.totalQuestions - this.remainingQuestions;
                    console.log(this.currentIndex);

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
                }
            }
        })
    </script>
@endscript
