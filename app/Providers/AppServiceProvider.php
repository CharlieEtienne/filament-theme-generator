<?php

namespace App\Providers;

use Filament\Support\Assets\Js;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentAsset::registerScriptData([
            'background' => json_encode(Color::Zinc),
            'accent' => json_encode(Color::Amber),
            'backgroundColors' => json_encode(self::getBackgroundColors()),
            'accentColors' => json_encode(self::getAccentColors()),
        ]);
    }

    public static function getBackgroundColors(): array
    {
        return [
            'stone' => Color::Stone,
            'neutral' => Color::Neutral,
            'zinc' => Color::Zinc,
            'gray' => Color::Gray,
            'slate' => Color::Slate,
        ];
    }

    /**
     * @return array
     */
    public static function getAccentColors(): array
    {
        return [
            'red' => Color::Red,
            'orange' => Color::Orange,
            'amber' => Color::Amber,
            'yellow' => Color::Yellow,
            'lime' => Color::Lime,
            'green' => Color::Green,
            'emerald' => Color::Emerald,
            'teal' => Color::Teal,
            'cyan' => Color::Cyan,
            'sky' => Color::Sky,
            'blue' => Color::Blue,
            'indigo' => Color::Indigo,
            'violet' => Color::Violet,
            'purple' => Color::Purple,
            'fuchsia' => Color::Fuchsia,
            'pink' => Color::Pink,
            'rose' => Color::Rose,
        ];
    }
}
