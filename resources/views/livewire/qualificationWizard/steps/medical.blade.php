<div class="">
    @include('livewire.qualificationWizard.navigation')

    <div class="w-full mx-auto mt-4 sm:mt-6 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-6 sm:grid-cols-6"
        x-data="medical">
        <div class="sm:col-span-6">
            <label for="disorder" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.disorder') }}
            </label>
            @foreach (\App\Enum\Disorder::cases() as $disorder)
                <div class="sm:col-span-6 pb-2 flex flex-col items-stretch" wire:key="disorder-{{ $disorder->value }}">
                    <div class="relative mt-2 pl-2 sm:pl-0">
                        <input id="disorder-{{ $disorder->value }}" value="{{ $disorder->value }}" name="disorders"
                            wire:model="disorders"
                            x-on:change="diagnosis = {...diagnosis, '{{ $disorder->value }}': ''}" type="checkbox"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="disorder-{{ $disorder->value }}"
                            class="pl-3 text-sm leading-6 font-medium text-gray-700">{{ __('enums.disorder.' . $disorder->value) }}</label>
                    </div>
                    <div class="grid grid-rows-3 gap-2 pl-8 mt-2" x-show="disorders.includes('{{ $disorder->value }}')"
                        x-transition.duration.500ms>
                        <label for="" class="block text-sm font-medium leading-6 text-gray-900">
                            {{ __('public.qualification.fields.diagnosis') }}
                            <span class="font-bold text-red-700">*</span>
                        </label>
                        @foreach (__('public.qualification.values.diagnosis') as $value => $label)
                            <div class="flex items-center pl-2 space-x-3 sm:pl-0">
                                <input id="diagnosis-{{ $disorder->value }}-response-{{ $value }}"
                                    value="{{ $value }}" name="diagnosis-{{ $disorder->value }}"
                                    x-model="diagnosis['{{ $disorder->value }}']" type="radio"
                                    class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                <label for="diagnosis-{{ $disorder->value }}-response-{{ $value }}"
                                    class="text-sm leading-6 font-medium text-gray-700">{{ $label }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            @error('disorders')
                <p class="mt-2 text-sm text-red-600" id="disorders-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6">
            <label for="otherDisorders" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.otherDisorders') }}
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <textarea rows="4" name="otherDisorders" id="otherDisorders" wire:model="otherDisorders"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
            @error('otherDisorders')
                <p class="mt-2 text-sm text-red-600" id="otherDisorders-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button wire:click="previousStep" class="text-sm font-semibold leading-6 text-gray-900">Précédent</button>
        <button wire:click="submit"
            class="rounded-md px-3 py-2 text-sm bg-gradient-to-r from-blue-700 to-purple-700 font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Suivant</button>
    </div>

    @script
        <script>
            Alpine.data('medical', () => ({
                disorders: @entangle('disorders'),
                diagnosis: @entangle('diagnosis'),
                init: function() {
                    this.$watch('disorders', (value) => {
                        console.log('disorders', value);
                    });
                    this.$watch('diagnosis', (value) => {
                        console.log('diagnosis', value);
                    });
                }
            }))
        </script>
    @endscript
</div>
