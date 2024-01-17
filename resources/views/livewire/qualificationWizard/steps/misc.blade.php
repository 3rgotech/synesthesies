<div class="">
    @include('livewire.qualificationWizard.navigation')

    <div class="w-full mx-auto mt-4 sm:mt-6 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-6 sm:grid-cols-6"
        x-data="misc">
        <div class="sm:col-span-6">
            <label for="alwaysExisted" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.alwaysExisted') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <div class="flex items-center space-x-5">
                    @foreach (__('public.qualification.values.boolean') as $value => $label)
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="alwaysExisted-{{ $value }}" value="{{ $value }}"
                                    name="alwaysExisted" wire:model="alwaysExisted" type="radio"
                                    class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="alwaysExisted-{{ $value }}"
                                    class="font-medium text-gray-700">{{ $label }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('alwaysExisted')
                <p class="mt-2 text-sm text-red-600" id="alwaysExisted-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6">
            <label for="hasChanged" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.hasChanged') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <div class="flex items-center space-x-5">
                    @foreach (__('public.qualification.values.boolean') as $value => $label)
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="hasChanged-{{ $value }}" value="{{ $value }}" name="hasChanged"
                                    x-model="hasChanged" type="radio"
                                    class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="hasChanged-{{ $value }}"
                                    class="font-medium text-gray-700">{{ $label }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('hasChanged')
                <p class="mt-2 text-sm text-red-600" id="hasChanged-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6" x-show="hasChanged === 'yes'">
            <label for="hasChangedDetails" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.ifYesExplain') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <textarea rows="4" name="hasChangedDetails" id="hasChangedDetails" wire:model="hasChangedDetails"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
            @error('hasChangedDetails')
                <p class="mt-2 text-sm text-red-600" id="hasChangedDetails-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6">
            <label for="problematic" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.problematic') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <div class="flex items-center space-x-5">
                    @foreach (__('public.qualification.values.boolean') as $value => $label)
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="problematic-{{ $value }}" value="{{ $value }}"
                                    name="problematic" x-model="problematic" type="radio"
                                    class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="problematic-{{ $value }}"
                                    class="font-medium text-gray-700">{{ $label }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('problematic')
                <p class="mt-2 text-sm text-red-600" id="problematic-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6" x-show="problematic === 'yes'">
            <label for="problematicDetails" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.ifYesExplain') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <textarea rows="4" name="problematicDetails" id="problematicDetails" wire:model="problematicDetails"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
            @error('problematicDetails')
                <p class="mt-2 text-sm text-red-600" id="problematicDetails-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6">
            <label for="comments" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.comments') }}
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <textarea rows="4" name="comments" id="comments" wire:model="comments"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
            @error('comments')
                <p class="mt-2 text-sm text-red-600" id="comments-error">{{ $message }}</p>
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
            Alpine.data('misc', () => ({
                hasChanged: @entangle('hasChanged'),
                problematic: @entangle('problematic'),
            }))
        </script>
    @endscript
</div>
