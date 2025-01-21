<x-filament-panels::page>

    <div class="text-center items-center justify-center flex">
        <div x-data="{ theme: null }" x-init="
        $watch('theme', () => {
            $dispatch('theme-changed', theme)
        })

        theme = localStorage.getItem('theme') || 'system'    " class="fi-theme-switcher grid grid-flow-col gap-x-1">
            <button aria-label="Enable light theme" type="button" x-on:click="(theme = 'light')" x-tooltip="{
        content: 'Enable light theme',
        theme: $store.theme,
    }"
                    class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400"
                    x-bind:class="
        theme === 'light' ? 'fi-active bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400'
            : 'text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400'
    ">
                <x-filament::icon
                    :alias="'panels::theme-switcher.light-button'"
                    :icon="'heroicon-m-sun'"
                    class="h-5 w-5"
                />
            </button>

            <button aria-label="Enable dark theme" type="button" x-on:click="(theme = 'dark')" x-tooltip="{
        content: 'Enable dark theme',
        theme: $store.theme,
    }"
                    class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400"
                    x-bind:class="
        theme === 'dark' ? 'fi-active bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400'
            : 'text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400'
    ">
                <x-filament::icon
                    :alias="'panels::theme-switcher.dark-button'"
                    :icon="'heroicon-m-moon'"
                    class="h-5 w-5"
                />
            </button>

            <button aria-label="Enable system theme" type="button" x-on:click="(theme = 'system')" x-tooltip="{
        content: 'Enable system theme',
        theme: $store.theme,
    }"
                    class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 fi-active bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400"
                    x-bind:class="
        theme === 'system' ? 'fi-active bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400'
            : 'text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400'
    ">
                <x-filament::icon
                    :alias="'panels::theme-switcher.system-button'"
                    :icon="'heroicon-m-computer-desktop'"
                    class="h-5 w-5"
                />
            </button>
        </div>
    </div>

    <div class="py-12 text-center items-center justify-center">
        <h1 class="italic text-3xl font-black tracking-tighter">Filament Theme Generator</h1>
        <h2 class="opacity-70 text-md">Generate a custom Filament theme in just a few clicks</h2>
    </div>


    <div
        x-data="{
            background: $wire.entangle('background'),
            accent: $wire.entangle('accent'),
            php: $wire.entangle('php'),
            css: $wire.entangle('css'),
       }"
        @change="
            cssEl = document.getElementById('css');
            phpEl = document.getElementById('php');
            cssEl.removeAttribute('data-highlighted');
            phpEl.removeAttribute('data-highlighted');

            hljs.highlightElement(cssEl);
            hljs.highlightElement(phpEl);
        "
    >
        {{ $this->form }}

        <link rel="stylesheet"
              href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/base16/mocha.min.css"
              integrity="sha512-OtRVA+0CtnuU6s7M6XDDpFm8p/+FbqTdeHV+XKIZ5TXjWvYrR0zc3Yi0QWL6+K+NYQeNba9Wf//91znzRbonig=="
              crossorigin="anonymous" referrerpolicy="no-referrer"/>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"
                integrity="sha512-EBLzUL8XLl+va/zAsmXwS7Z2B1F9HUHkZwyS/VKwh3S7T/U0nF4BaU29EP/ZSf6zgiIxYAnKLu6bJ8dqpmX5uw=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/languages/php.min.js"
                integrity="sha512-uSKj9vayq7XKzfzflBQdmCuLIzKtsmsv7jjfr85Z0GQxNyID1anc0GMYHsNMo93A0oaro6696CQ5Q00xvCpoBQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/languages/css.min.js"
                integrity="sha512-fQhadp2Av4sRhTYd9TEggQW4NrosThwDUXIMLin90uepvmCZG0mRTdPVtHujrXD22qMTtdQlrAEdvWocezI8ow=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            hljs.configure({'ignoreUnescapedHTML': true});

            hljs.highlightAll();

            function hexToRgb(hex) {
                const bigint = parseInt(hex.slice(1), 16);
                return {
                    r: (bigint >> 16) & 255,
                    g: (bigint >> 8) & 255,
                    b: bigint & 255
                };
            }

            function generateShades(rgb) {
                const intensityMap = {
                    50: 0.95,
                    100: 0.9,
                    200: 0.75,
                    300: 0.6,
                    400: 0.3,
                    500: 1.0,
                    600: 0.9,
                    700: 0.75,
                    800: 0.6,
                    900: 0.49,
                    950: 0.3,
                };

                const shades = {};

                for (const [shade, intensity] of Object.entries(intensityMap)) {
                    let red, green, blue;

                    if (shade < 500) {
                        red = ((255 - rgb.r) * intensity) + rgb.r;
                        green = ((255 - rgb.g) * intensity) + rgb.g;
                        blue = ((255 - rgb.b) * intensity) + rgb.b;
                    } else {
                        red = rgb.r * intensity;
                        green = rgb.g * intensity;
                        blue = rgb.b * intensity;
                    }

                    shades[shade] = Math.round(red) + ', ' + Math.round(green) + ', ' + Math.round(blue);
                }

                return shades;
            }

            function getPhpCode(background, accent) {
                return `public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->colors([
            'gray' => [
                50 => '${background[50]}',
                100 => '${background[100]}',
                200 => '${background[200]}',
                300 => '${background[300]}',
                400 => '${background[400]}',
                500 => '${background[500]}',
                600 => '${background[600]}',
                700 => '${background[700]}',
                800 => '${background[800]}',
                900 => '${background[900]}',
                950 => '${background[950]}',
            ],
            'primary' => [
                50 => '${accent[50]}',
                100 => '${accent[100]}',
                200 => '${accent[200]}',
                300 => '${accent[300]}',
                400 => '${accent[400]}',
                500 => '${accent[500]}',
                600 => '${accent[600]}',
                700 => '${accent[700]}',
                800 => '${accent[800]}',
                900 => '${accent[900]}',
                950 => '${accent[950]}',
            ],
        ])

    }`;
            }

            function getCssCode(background, accent) {
                return `:root {
    /* Background */
    --gray-50: ${background[50]};
    --gray-100: ${background[100]};
    --gray-200: ${background[200]};
    --gray-300: ${background[300]};
    --gray-400: ${background[400]};
    --gray-500: ${background[500]};
    --gray-600: ${background[600]};
    --gray-700: ${background[700]};
    --gray-800: ${background[800]};
    --gray-900: ${background[900]};
    --gray-950: ${background[950]};
    /* Primary */
    --primary-50: ${accent[50]};
    --primary-100: ${accent[100]};
    --primary-200: ${accent[200]};
    --primary-300: ${accent[300]};
    --primary-400: ${accent[400]};
    --primary-500: ${accent[500]};
    --primary-600: ${accent[600]};
    --primary-700: ${accent[700]};
    --primary-800: ${accent[800]};
    --primary-900: ${accent[900]};
    --primary-950: ${accent[950]};
}`;
            }

            function previewTheme(base, shades) {
                const root = document.documentElement;

                root.style.setProperty(`--${base}-50`, shades[50]);
                root.style.setProperty(`--${base}-100`, shades[100]);
                root.style.setProperty(`--${base}-200`, shades[200]);
                root.style.setProperty(`--${base}-300`, shades[300]);
                root.style.setProperty(`--${base}-400`, shades[400]);
                root.style.setProperty(`--${base}-500`, shades[500]);
                root.style.setProperty(`--${base}-600`, shades[600]);
                root.style.setProperty(`--${base}-700`, shades[700]);
                root.style.setProperty(`--${base}-800`, shades[800]);
                root.style.setProperty(`--${base}-900`, shades[900]);
                root.style.setProperty(`--${base}-950`, shades[950]);
            }

        </script>
    </div>
</x-filament-panels::page>
