<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    wire:ignore
>
    <div
        x-data="{ state: $wire.$entangle('{{ $getStatePath() }}') }"
    >
        <pre class="bg-gray-800 dark:bg-gray-800 rounded-lg">
            <code
                id="{{ $getId() }}"
                class="hljs language-{{ $getLanguage() }}"
                x-ref="{{ $getId() }}"
                x-text="state"
                x-init="
                    $data.background = 'zinc';
                    $data.accent = 'amber';

                    const defaultBackground = JSON.parse(window.filamentData.background);
                    const defaultAccent = JSON.parse(window.filamentData.accent);
                    const backgroundColors = JSON.parse(window.filamentData.backgroundColors);
                    const accentColors = JSON.parse(window.filamentData.accentColors);

                    $data.php = getPhpCode(defaultBackground, defaultAccent);
                    $data.css = getCssCode(defaultBackground, defaultAccent);

                    $watch('background', value => {
                        if(!value) return;
                        const backgroundShades = backgroundColors[value];
                        const accentShades = accentColors[accent];
                        previewTheme('gray', backgroundShades);
                        $data.php = getPhpCode(backgroundShades, accentShades);
                        $data.css = getCssCode(backgroundShades, accentShades);
                    });

                    $watch('accent', value => {
                        if(!value) return;
                        const backgroundShades = backgroundColors[background];
                        const accentShades = accentColors[value];
                        previewTheme('primary', accentShades);
                        $data.php = getPhpCode(backgroundShades, accentShades);
                        $data.css = getCssCode(backgroundShades, accentShades);
                    })
                "
            >Code will go here</code>
        </pre>
    </div>
</x-dynamic-component>
