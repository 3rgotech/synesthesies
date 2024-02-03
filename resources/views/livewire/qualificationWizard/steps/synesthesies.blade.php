<div class="">
    @include('livewire.qualificationWizard.navigation')

    <div class="w-full mx-auto mt-4 sm:mt-6 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-6 sm:grid-cols-6"
        x-data="syn">
        <div class="sm:col-span-6">
            <label for="" class="block text-sm font-medium leading-6 text-gray-900">
                {!! __('public.qualification.fields.synesthesies_question') !!}
            </label>
        </div>
        @foreach (\App\Enum\Perception::cases() as $perception)
            <div class="sm:col-span-6 pb-2 flex flex-col items-stretch" wire:key="perception-{{ $perception->value }}">
                <div class="grid grid-cols-2 items-center gap-x-4">
                    <label for=""
                        class=" text-sm font-medium leading-6 text-gray-900 flex items-center space-x-2">
                        @svg($perception->getIcon(), 'size-6')
                        <span>
                            {{ __('public.qualification.values.perception.' . $perception->value) }}
                        </span>
                    </label>
                    <div class="relative flex items-center space-x-8">
                        @foreach (['yes', 'no'] as $value)
                            <div class="relative flex items-center">
                                <div class="flex h-6 items-center">
                                    <input id="perception-{{ $perception->value }}-{{ $value }}"
                                        name="-{{ $perception->value }}"
                                        x-model="synesthesies_bool.{{ $perception->value }}" type="radio"
                                        value="{{ $value }}"
                                        class="h-4 w-4 rounded-full border-gray-300 text-indigo-600 focus:ring-indigo-600">
                                </div>
                                <div class="ml-3 text-sm leading-6">
                                    <label for="perception-{{ $perception->value }}-{{ $value }}"
                                        class="font-medium text-gray-700">{{ __(ucfirst($value)) }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 px-2 mt-2"
                    x-show="synesthesies_bool.{{ $perception->value }} === 'yes'" x-transition.duration.500ms>
                    @foreach (\App\Enum\Response::cases() as $response)
                        <div class="flex items-center pl-2 space-x-3 sm:pl-0">
                            <input id="perception-{{ $perception->value }}-response-{{ $response->value }}"
                                value="{{ $response->value }}" name="responses"
                                x-model="synesthesies.{{ $perception->value }}" type="checkbox"
                                x-on:change="synesthesies.{{ $perception->value }} = $event.target.checked ? [...(synesthesies.{{ $perception->value }}.filter(v => v !== 'none')), '{{ $response->value }}'] : synesthesies.{{ $perception->value }}.filter(v => v!== '{{ $response->value }}')"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            @svg($response->getIcon(), 'size-4')
                            <label for="perception-{{ $perception->value }}-response-{{ $response->value }}"
                                class="text-sm leading-6 font-medium text-gray-700">{{ __('enums.response.' . $response->value) }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        @error('synesthesies')
            <p class="sm:col-span-6 mt-2 text-sm text-red-600" id="synesthesies-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button wire:click="previousStep" class="text-sm font-semibold leading-6 text-gray-900">Précédent</button>
        <button wire:click="submit"
            class="rounded-md px-3 py-2 text-sm bg-gradient-to-r from-blue-700 to-purple-700 font-semibold text-white shadow-sm focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Suivant</button>
    </div>

    @script
        <script>
            Alpine.data('syn', () => ({
                perceptions: @entangle('perceptions'),
                synesthesies: @entangle('synesthesies'),
                synesthesies_bool: {},
                init() {
                    this.perceptions.forEach(p => this.synesthesies_bool[p] = 'no');
                    console.log(JSON.stringify(this.synesthesies_bool));
                    /* this.$watch('synesthesies', (newValue, oldValue) => {
                        const newSynesthesies = {};
                        let changed = false;
                        Object.entries(newValue).forEach(([key, values]) => {
                            const diff = values.filter(v => !oldValue[key].includes(v));
                            if (diff.includes('none')) {
                                // User just selected "none", so we only keep that
                                newSynesthesies[key] = ['none'];
                                changed = true;
                            } else if (values.includes('none')) {
                                // User has selected something other than "none", so we keep everything except "none" (that may have been selected before)
                                newSynesthesies[key] = values.filter(v => v !== 'none');
                                changed = true;
                            } else {
                                newSynesthesies[key] = values;
                            }
                        })
                        console.log(oldValue)
                        console.log(newValue)
                        if (changed) {
                            console.log(JSON.stringify(newSynesthesies));
                            this.synesthesies = newSynesthesies;
                        }
                    })*/
                },
            }))
        </script>
    @endscript
</div>
