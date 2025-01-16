<?php

namespace App\Filament\Pages;

use Awcodes\Palette\Forms\Components\ColorPicker;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;

class ThemeGenerator extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.theme-generator';

    public function getTitle(): string|Htmlable
    {
        return '';
    }

    protected static ?string $slug = '';

    public string $accent = 'amber';
    public string $background = 'zinc';
    public string $text_input;
    public string $select;
    public string $radio = 'draft';
    public string $toggle_buttons = 'draft';
    public array $tags = ['Tailwind CSS', 'Alpine.js'];
    public string $toggle = '1';
    public string $css;
    public string $php;

    /**
     * @return array
     */
    public function getBackgroundColors(): array
    {
        return [
            'stone' => Color::Stone,
            'neutral' => Color::Neutral,
            'zinc' => Color::Zinc,
            'gray' => Color::Gray,
            'slate' => Color::Slate,
        ];
    }

    public function getJson(): false|string
    {
        return json_encode($this->getBackgroundColors());
    }

    /**
     * @return array
     */
    public function getAccentColors(): array
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

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                    Section::make('Customize your theme')
                        ->schema([

                            ColorPicker::make('background')
                                ->label('Background Color')
                                ->colors($this->getBackgroundColors())
                                ->live()
                                ->extraAttributes(['id' => 'background'])
                                ->afterStateUpdated(function ($livewire) {
                                    $colors = json_encode($this->getBackgroundColors());
                                    $livewire->js(
                                        <<<JS
                                        const colors = JSON.parse('$colors');
                                        const color = document.querySelector('#background input[type="radio"]:checked').value;
                                        const shades = colors[color];
                                        previewTheme('gray', shades);
                                        window.background = shades;
                                        updateTheme();
                                    JS
                                    );
                                }),


                            ColorPicker::make('accent')
                                ->label('Accent Color')
                                ->colors($this->getAccentColors())
                                ->live()
                                ->extraAttributes(['id' => 'accent'])
                                ->afterStateUpdated(function ($livewire) {
                                    $colors = json_encode($this->getAccentColors());
                                    $livewire->js(
                                        <<<JS
                                        const colors = JSON.parse('$colors');
                                        const color = document.querySelector('#accent input[type="radio"]:checked').value;
                                        const shades = colors[color];
                                        previewTheme('primary', shades);
                                        // const rgb = hexToRgb(color);
                                        // const shades = generateShades(rgb);
                                        window.accent = shades;
                                        updateTheme();
                                    JS
                                    );
                                }),
                        ]),

                    Section::make('Preview')
                        ->headerActions([
                            Action::make('Primary Button'),
                            Action::make('Outlined Button')->outlined(),
                        ])
                        ->schema([
                            Radio::make('radio')
                                ->inline()
                                ->inlineLabel(false)
                                ->options([
                                    'draft' => 'Draft',
                                    'scheduled' => 'Scheduled',
                                    'published' => 'Published'
                                ]),
                            ToggleButtons::make('toggle_buttons')
                                ->inline()
                                ->options([
                                    'draft' => 'Draft',
                                    'scheduled' => 'Scheduled',
                                    'published' => 'Published'
                                ]),
                            TagsInput::make('tags'),
                            Toggle::make('toggle'),
                        ])
                        ->columns(2),

                    Section::make('Get the code')
                        ->schema([
                            Tabs::make('tabs')
                                ->contained(false)
                                ->tabs([
                                    Tabs\Tab::make('Panel Provider (PHP)')
                                        ->schema([
                                            Textarea::make('php')
                                                ->label('Panel Provider')
                                                ->readOnly()
                                                ->rows(20)
                                                ->helperText('Paste this code in your Filament [PanelName]PanelProvider.php file')
                                                ->hintAction(fn() => Action::make('Copy')
                                                    ->icon('heroicon-s-clipboard')
                                                    ->action(function ($livewire) {
                                                        $livewire->js(
                                                            'window.navigator.clipboard.writeText(document.getElementById("php").value);
                                                            $tooltip( "Copied to clipboard", { timeout: 1500 }); ');
                                                    })
                                                ),
                                        ]),
                                    Tabs\Tab::make('Custom Theme (CSS)')
                                        ->schema([
                                            Textarea::make('css')
                                                ->label('Theme CSS')
                                                ->readOnly()
                                                ->rows(20)
                                                ->helperText('Paste this code in your Filament theme.css file')
                                                ->hintAction(fn() => Action::make('Copy')
                                                    ->icon('heroicon-s-clipboard')
                                                    ->action(function ($livewire) {
                                                        $livewire->js(
                                                            'window.navigator.clipboard.writeText(document.getElementById("css").value);
                                                            $tooltip( "Copied to clipboard", { timeout: 1500 }); ');
                                                    })
                                                ),
                                        ]),
                                ])

                        ]),

                ]
            );
    }

    /**
     * @throws ValidationException
     */
    public function submit(): void
    {
        $this->validate();
    }
}