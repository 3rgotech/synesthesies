<div class="">
    @include('livewire.qualificationWizard.navigation')

    <div class="w-full mx-auto mt-4 sm:mt-6 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-6 sm:grid-cols-6"
        x-data="information">
        <div class="sm:col-span-3">
            <label for="gender" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.gender') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <select id="gender" name="gender" wire:model="gender"
                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('gender') pr-10 @else pr-3 @enderror"
                    @error('gender') aria-invalid="true" aria-describedby="gender-error" @enderror>
                    <option></option>
                    @foreach (\App\Enum\Gender::cases() as $gender)
                        <option value="{{ $gender->value }}">{{ $gender->getLabel() }}</option>
                    @endforeach
                </select>
                @error('gender')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-8">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @enderror
            </div>
            @error('gender')
                <p class="mt-2 text-sm text-red-600" id="gender-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-3">
            <label for="birthYear" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.birthYear') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <input type="number" name="birthYear" id="birthYear" wire:model="birthYear" min="1900"
                    max="{{ date('Y') }}" step="1"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('birthYear') pr-10 @else pr-3 @enderror"
                    @error('birthYear') aria-invalid="true" aria-describedby="birthYear-error" @enderror>
                @error('birthYear')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @enderror
            </div>
            @error('birthYear')
                <p class="mt-2 text-sm text-red-600" id="birthYear-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-3">
            <label for="citizenship" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.citizenship') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <div class="flex items-center space-x-5">
                    @foreach (__('public.qualification.values.citizenship') as $value => $label)
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="citizenship-{{ $value }}" value="{{ $value }}"
                                    name="citizenship" wire:model="citizenship" type="radio"
                                    class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="citizenship-{{ $value }}"
                                    class="font-medium text-gray-700">{{ $label }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('citizenship')
                <p class="mt-2 text-sm text-red-600" id="citizenship-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-3">
            <label for="language" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.language') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <div class="flex items-center space-x-5">
                    @foreach (__('public.qualification.values.language') as $value => $label)
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="language-{{ $value }}" value="{{ $value }}" name="language"
                                    wire:model="language" type="radio"
                                    class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="language-{{ $value }}"
                                    class="font-medium text-gray-700">{{ $label }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('language')
                <p class="mt-2 text-sm text-red-600" id="language-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3">
            <label for="liveInFrance" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.liveInFrance') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <div class="flex items-center space-x-5 pb-3">
                    @foreach (['yes', 'no'] as $value)
                        <div class="relative flex items-start">
                            <div class="flex h-6 items-center">
                                <input id="liveInFrance-{{ $value }}" name="liveInFrance"
                                    wire:model="liveInFrance" type="radio" value="{{ $value }}"
                                    class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            </div>
                            <div class="ml-3 text-sm leading-6">
                                <label for="liveInFrance-{{ $value }}"
                                    class="font-medium text-gray-700">{{ __(ucfirst($value)) }}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @error('liveInFrance')
                <p class="mt-2 text-sm text-red-600" id="liveInFrance-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-3" x-bind:class="liveInFrance !== 'yes' && 'hidden'">
            <label for="region" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.region') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <select id="region" name="region" wire:model="region"
                    class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('region') pr-10 @else pr-3 @enderror"
                    @error('region') aria-invalid="true" aria-describedby="region-error" @enderror>
                    <option></option>
                    @foreach (\App\Enum\Region::cases() as $region)
                        <option value="{{ $region->value }}">{{ $region->getLabel() }}</option>
                    @endforeach
                </select>
                @error('region')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-8">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @enderror
            </div>
            @error('region')
                <p class="mt-2 text-sm text-red-600" id="region-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900">
                {{ __('public.qualification.fields.email') }}
                <span class="font-bold text-red-700">*</span>
            </label>
            <div class="relative mt-2 pl-2 sm:pl-0">
                <input type="email" name="email" id="email" wire:model="email"
                    class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 @error('email') pr-10 @else pr-3 @enderror"
                    @error('email') aria-invalid="true" aria-describedby="@error('email') email-error @else email-description @endif" @enderror>
                @error('email')
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                @enderror
            </div>
            <p class="mt-2 text-sm text-gray-500" id="email-description">{{ __('public.qualification.help.email') }}
            </p>
            @error('email')
                <p class="mt-2 text-sm text-red-600" id="email-error">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-6">
            <div class="relative flex items-center">
                <input id="wantsToBeInformed" value="{{ $value }}" name="wantsToBeInformed"
                    wire:model="wantsToBeInformed" type="checkbox"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                <label for="wantsToBeInformed"
                    class="pl-3 text-sm leading-6 font-medium text-gray-700">{{ __('public.qualification.fields.wantsToBeInformed') }}</label>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-between gap-x-6">
        <a href="{{ route('home') }}" class="text-sm font-semibold leading-6 text-gray-900">Retour à l'accueil</a>
        <button wire:click="submit"
            class="rounded-md px-3 py-2 text-sm bg-gradient-to-r from-blue-700 to-purple-700 font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Suivant</button>
    </div>

    @script
        <script>
            Alpine.data('information', () => ({
                liveInFrance: @entangle('liveInFrance'),
                email: @entangle('email')
            }))
        </script>
    @endscript
</div>
