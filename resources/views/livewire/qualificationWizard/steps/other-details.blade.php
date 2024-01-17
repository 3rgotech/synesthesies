<div class="">
    @include('livewire.qualificationWizard.navigation')

    <div class="w-full mx-auto mt-4 sm:mt-6 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-6 sm:grid-cols-6"
        x-data="otherDetails">
        <div class="sm:col-span-6">
            <label for="" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.spatialSynesthesies') }} :
            </label>
            <img src="/spatial-months.gif" class="w-full max-w-sm">
        </div>
        <div class="sm:col-span-6">
            <label for="" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.isItTheCase') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0 grid grid-rows-2 grid-flow-col">
                @foreach (['yes', 'no'] as $value)
                    <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                            <input id="spatial-{{ $value }}" name="spatial" x-model="spatial" type="radio"
                                value="{{ $value }}"
                                class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="ml-3 text-sm leading-6">
                            <label for="spatial-{{ $value }}"
                                class="font-medium text-gray-700">{{ __(ucfirst($value)) }}</label>
                        </div>
                    </div>
                @endforeach
                @foreach (__('public.qualification.values.spatial') as $value => $label)
                    <div x-show="spatial === 'yes'" class="inline-flex items-center">
                        <div class="inline-flex items-center ml-2">
                            <input id="spatialSynesthesies-{{ $value }}" value="{{ $value }}"
                                name="spatialSynesthesies" wire:model="spatialSynesthesies" type="checkbox"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="ml-3 text-sm leading-6">
                            <label for="spatialSynesthesies-{{ $value }}"
                                class="font-medium text-gray-700">{{ $label }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('spatialSynesthesies')
                <p class="mt-2 text-sm text-red-600" id="spatialSynesthesies-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-6">
            <label for="" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.subtitles') }}
            </label>
            <label for="" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.isItTheCase') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0 grid grid-rows-2 grid-flow-col">
                @foreach (['yes', 'no'] as $value)
                    <div class="relative flex items-start">
                        <div class="flex h-6 items-center">
                            <input id="subtitles-{{ $value }}" name="subtitles" wire:model="subtitles"
                                type="radio" value="{{ $value }}"
                                class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="ml-3 text-sm leading-6">
                            <label for="subtitles-{{ $value }}"
                                class="font-medium text-gray-700">{{ __(ucfirst($value)) }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('subtitles')
                <p class="mt-2 text-sm text-red-600" id="subtitles-error">{{ $message }}</p>
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
            Alpine.data('otherDetails', () => ({
                spatial: null,
            }))
        </script>
    @endscript
</div>
