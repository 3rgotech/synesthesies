<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }">
        <x-dynamic-component :component="$getRecord()->test->getResultsComponent()" :test="$getRecord()->test" :results="$getRecord()" />
    </div>
</x-dynamic-component>
