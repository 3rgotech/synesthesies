<div class="">
    @include('livewire.qualificationWizard.navigation')

    <div class="w-full mx-auto mt-4 sm:mt-6 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-6 sm:grid-cols-6"
        x-data="medical">
        <div class="sm:col-span-6">
            <label for="disorder" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.disorder') }}
            </label>
            @foreach (\App\Enum\Disorder::cases() as $disorder)
                <div class="relative mt-2 pl-2 sm:pl-0">
                    <input id="disorder-{{ $disorder->value }}" value="{{ $disorder->value }}" name="disorders"
                        wire:model="disorders" type="checkbox"
                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="disorder-{{ $disorder->value }}"
                        class="pl-3 text-sm leading-6 font-medium text-gray-700">{{ __('enums.disorder.' . $disorder->value) }}</label>
                </div>
            @endforeach
            @error('disorders')
                <p class="mt-2 text-sm text-red-600" id="disorders-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6" x-bind:class="disorders.length == 0 && 'hidden'">
            <label for="region" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.diagnosis') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                @foreach (__('public.qualification.values.diagnosis') as $value => $label)
                    <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                            <input id="diagnosis-{{ $value }}" value="{{ $value }}" name="diagnosis"
                                wire:model="diagnosis" type="radio"
                                class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="ml-3 text-sm leading-6">
                            <label for="diagnosis-{{ $value }}"
                                class="font-medium text-gray-700">{{ $label }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('diagnosis')
                <p class="mt-2 text-sm text-red-600" id="diagnosis-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="{{ route('home') }}" class="text-sm font-semibold leading-6 text-gray-900">Précédent</a>
        <button wire:click="submit"
            class="rounded-md px-3 py-2 text-sm bg-gradient-to-r from-blue-500 to-purple-500 font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Suivant</button>
    </div>

    @script
        <script>
            Alpine.data('medical', () => ({
                disorders: @entangle('disorders')
            }))
        </script>
    @endscript
</div>
