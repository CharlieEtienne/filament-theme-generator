<x-filament-panels::page >

    <div class="text-center items-center justify-center flex">
        <div x-data="{ theme: null }" x-init="
        $watch('theme', () => {
            $dispatch('theme-changed', theme)
        })

        theme = localStorage.getItem('theme') || 'system'    " class="fi-theme-switcher grid grid-flow-col gap-x-1">
            <button aria-label="Enable light theme" type="button" x-on:click="(theme = 'light') && close()" x-tooltip="{
        content: 'Enable light theme',
        theme: $store.theme,
    }"
                    class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400"
                    x-bind:class="
        theme === 'light' ? 'fi-active bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400'
            : 'text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400'
    ">
                <!--[if BLOCK]><![endif]-->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true" data-slot="icon">
                    <path
                        d="M10 2a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 2ZM10 15a.75.75 0 0 1 .75.75v1.5a.75.75 0 0 1-1.5 0v-1.5A.75.75 0 0 1 10 15ZM10 7a3 3 0 1 0 0 6 3 3 0 0 0 0-6ZM15.657 5.404a.75.75 0 1 0-1.06-1.06l-1.061 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM6.464 14.596a.75.75 0 1 0-1.06-1.06l-1.06 1.06a.75.75 0 0 0 1.06 1.06l1.06-1.06ZM18 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 18 10ZM5 10a.75.75 0 0 1-.75.75h-1.5a.75.75 0 0 1 0-1.5h1.5A.75.75 0 0 1 5 10ZM14.596 15.657a.75.75 0 0 0 1.06-1.06l-1.06-1.061a.75.75 0 1 0-1.06 1.06l1.06 1.06ZM5.404 6.464a.75.75 0 0 0 1.06-1.06l-1.06-1.06a.75.75 0 1 0-1.061 1.06l1.06 1.06Z"></path>
                </svg><!--[if ENDBLOCK]><![endif]-->
            </button>

            <button aria-label="Enable dark theme" type="button" x-on:click="(theme = 'dark') && close()" x-tooltip="{
        content: 'Enable dark theme',
        theme: $store.theme,
    }"
                    class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400"
                    x-bind:class="
        theme === 'dark' ? 'fi-active bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400'
            : 'text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400'
    ">
                <!--[if BLOCK]><![endif]-->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd"
                          d="M7.455 2.004a.75.75 0 0 1 .26.77 7 7 0 0 0 9.958 7.967.75.75 0 0 1 1.067.853A8.5 8.5 0 1 1 6.647 1.921a.75.75 0 0 1 .808.083Z"
                          clip-rule="evenodd"></path>
                </svg><!--[if ENDBLOCK]><![endif]-->
            </button>

            <button aria-label="Enable system theme" type="button" x-on:click="(theme = 'system') && close()" x-tooltip="{
        content: 'Enable system theme',
        theme: $store.theme,
    }"
                    class="fi-theme-switcher-btn flex justify-center rounded-md p-2 outline-none transition duration-75 hover:bg-gray-50 focus-visible:bg-gray-50 dark:hover:bg-white/5 dark:focus-visible:bg-white/5 fi-active bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400"
                    x-bind:class="
        theme === 'system' ? 'fi-active bg-gray-50 text-primary-500 dark:bg-white/5 dark:text-primary-400'
            : 'text-gray-400 hover:text-gray-500 focus-visible:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 dark:focus-visible:text-gray-400'
    ">
                <!--[if BLOCK]><![endif]-->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                     aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd"
                          d="M2 4.25A2.25 2.25 0 0 1 4.25 2h11.5A2.25 2.25 0 0 1 18 4.25v8.5A2.25 2.25 0 0 1 15.75 15h-3.105a3.501 3.501 0 0 0 1.1 1.677A.75.75 0 0 1 13.26 18H6.74a.75.75 0 0 1-.484-1.323A3.501 3.501 0 0 0 7.355 15H4.25A2.25 2.25 0 0 1 2 12.75v-8.5Zm1.5 0a.75.75 0 0 1 .75-.75h11.5a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-.75.75H4.25a.75.75 0 0 1-.75-.75v-7.5Z"
                          clip-rule="evenodd"></path>
                </svg><!--[if ENDBLOCK]><![endif]-->
            </button>
        </div>
    </div>

    <div class="py-12 text-center items-center justify-center">
        <h1 class="italic text-3xl font-black tracking-tighter">Filament Theme Generator</h1>
        <h2 class="opacity-70 text-md">Generate a custom Filament theme in just a few clicks</h2>
    </div>

    {{ $this->form }}

    <script>

        window.background = JSON.parse(`{!! json_encode($this->getBackgroundColors()['zinc']) !!}`);
        window.accent = JSON.parse(`{!! json_encode($this->getAccentColors()['amber']) !!}`);

        const css = document.getElementById('css');

        css.innerHTML = 'test';

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

        function updateTheme() {
                const css = document.getElementById('css');
                const php = document.getElementById('php');

                if (css && php) {

                    const cssCode = `:root {
    /* Background */
    --gray-50: ${window.background[50]};
    --gray-100: ${window.background[100]};
    --gray-200: ${window.background[200]};
    --gray-300: ${window.background[300]};
    --gray-400: ${window.background[400]};
    --gray-500: ${window.background[500]};
    --gray-600: ${window.background[600]};
    --gray-700: ${window.background[700]};
    --gray-800: ${window.background[800]};
    --gray-900: ${window.background[900]};
    --gray-950: ${window.background[950]};
    /* Primary */
    --primary-50: ${window.accent[50]};
    --primary-100: ${window.accent[100]};
    --primary-200: ${window.accent[200]};
    --primary-300: ${window.accent[300]};
    --primary-400: ${window.accent[400]};
    --primary-500: ${window.accent[500]};
    --primary-600: ${window.accent[600]};
    --primary-700: ${window.accent[700]};
    --primary-800: ${window.accent[800]};
    --primary-900: ${window.accent[900]};
    --primary-950: ${window.accent[950]};
}`;


                    const phpCode = `public function panel(Panel $panel): Panel
{
    return $panel
        // ...
        ->colors([
            'gray' => [
                50 => '${window.background[50]}',
                100 => '${window.background[100]}',
                200 => '${window.background[200]}',
                300 => '${window.background[300]}',
                400 => '${window.background[400]}',
                500 => '${window.background[500]}',
                600 => '${window.background[600]}',
                700 => '${window.background[700]}',
                800 => '${window.background[800]}',
                900 => '${window.background[900]}',
                950 => '${window.background[950]}',
            ],
            'primary' => [
                50 => '${window.accent[50]}',
                100 => '${window.accent[100]}',
                200 => '${window.accent[200]}',
                300 => '${window.accent[300]}',
                400 => '${window.accent[400]}',
                500 => '${window.accent[500]}',
                600 => '${window.accent[600]}',
                700 => '${window.accent[700]}',
                800 => '${window.accent[800]}',
                900 => '${window.accent[900]}',
                950 => '${window.accent[950]}',
            ],
        ])
        // ...
    }`;
                    css.value = cssCode;
                    php.value = phpCode;

                } else {
                    console.error('Elements with id "css" or "php" not found in the DOM.');
                }
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
</x-filament-panels::page>
