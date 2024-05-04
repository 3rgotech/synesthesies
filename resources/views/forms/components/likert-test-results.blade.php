<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <x-likert-test-results :test="$getRecord()->likertTest" :results="$getRecord()" />
    </div>
</x-dynamic-component>
