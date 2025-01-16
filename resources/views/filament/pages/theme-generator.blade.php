<x-filament-panels::page>

    <div class="py-16 text-center items-center justify-center">
        <h1 class="italic text-3xl font-black tracking-tighter">Filament Theme Generator</h1>
        <h2 class="opacity-70 text-md">Generate a custom Filament theme in just a few clicks</h2>
    </div>

    {{ $this->form }}

    <script>

        window.background = JSON.parse(`{!! json_encode($this->getBackgroundColors()['zinc']) !!}`);
        window.accent = JSON.parse(`{!! json_encode($this->getAccentColors()['amber']) !!}`);

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

        function getCSS(base, shades) {
            return `:root {
    --${base}-50: ${shades[50]};
    --${base}-100: ${shades[100]};
    --${base}-200: ${shades[200]};
    --${base}-300: ${shades[300]};
    --${base}-400: ${shades[400]};
    --${base}-500: ${shades[500]};
    --${base}-600: ${shades[600]};
    --${base}-700: ${shades[700]};
    --${base}-800: ${shades[800]};
    --${base}-900: ${shades[900]};
    --${base}-950: ${shades[950]};
}`;
        }

        function updateTheme(){
            document.getElementById('css').value = `:root {
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


            document.getElementById('php').value = `public function panel(Panel $panel): Panel
{
    return $panel
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
        ])`
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
