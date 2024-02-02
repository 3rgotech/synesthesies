<div class="">
    @include('livewire.qualificationWizard.navigation')

    <div class="w-full mx-auto mt-4 sm:mt-6 grid max-w-2xl grid-cols-1 gap-x-6 gap-y-4 sm:gap-y-6 sm:grid-cols-6"
        x-data="syn">
        @foreach (\App\Enum\Perception::cases() as $perception)
            <div class="sm:col-span-6" wire:key="perception-{{ $perception }}">
                <label for="" class="block text-sm font-medium leading-6 text-gray-900">
                    {!! __('public.qualification.fields.synesthesies_item', [
                        'perception' => '<u>' . __('public.qualification.values.perception.' . $perception->value) . '</u>',
                    ]) !!}
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-5 gap-2 px-2 mt-2">
                    @foreach (\App\Enum\Response::cases() as $response)
                        <div class="flex items-center pl-2 sm:pl-0">
                            <input id="perception-{{ $perception->value }}-response-{{ $response->value }}"
                                value="{{ $response->value }}" name="responses"
                                x-model="synesthesies.{{ $perception->value }}" type="checkbox"
                                x-on:change="synesthesies.{{ $perception->value }} = $event.target.checked ? [...(synesthesies.{{ $perception->value }}.filter(v => v !== 'none')), '{{ $response->value }}'] : synesthesies.{{ $perception->value }}.filter(v => v!== '{{ $response->value }}')"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                            <label for="perception-{{ $perception->value }}-response-{{ $response->value }}"
                                class="pl-3 text-sm leading-6 font-medium text-gray-700">{{ __('enums.response.' . $response->value) }}</label>
                        </div>
                    @endforeach
                    <div class="col-span-2 sm:col-span-3 flex items-center pl-2 sm:pl-0">
                        <input id="perception-{{ $perception->value }}-response-none" value="none" name="responses"
                            x-model="synesthesies.{{ $perception->value }}" type="checkbox"
                            x-on:change="synesthesies.{{ $perception->value }} = $event.target.checked ? ['none'] : []"
                            class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        <label for="perception-{{ $perception->value }}-response-none"
                            class="pl-3 text-sm leading-6 font-medium text-gray-700">{{ __('public.qualification.fields.synesthesies_nothing') }}</label>
                    </div>
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
                synesthesies: @entangle('synesthesies'),
                init() {
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
