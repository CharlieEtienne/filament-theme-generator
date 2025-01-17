<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    wire:ignore
>
    <div
        x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }"
    >
        <pre class="bg-gray-800 dark:bg-gray-800 rounded-lg">
            <code id="{{ $getId() }}" class="hljs language-{{ $getLanguage() }}">Code will go here</code>
        </pre>
    </div>
</x-dynamic-component>
