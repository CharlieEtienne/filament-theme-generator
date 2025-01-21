<?php

namespace App\Filament\Pages;

use App\Forms\Components\CodeBlock;
use Awcodes\Palette\Forms\Components\ColorPicker as PaletteColorPicker;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\Support\Htmlable;

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
                            Tabs::make('tabs')
                                ->contained(false)
                                ->tabs([
                                    Tabs\Tab::make('Use Tailwind palette')
                                        ->schema([
                                            PaletteColorPicker::make('background')
                                                ->label('Background Color')
                                                ->colors($this->getBackgroundColors()),

                                            PaletteColorPicker::make('accent')
                                                ->label('Accent Color')
                                                ->colors($this->getAccentColors()),
                                            ]),
                                    Tabs\Tab::make('Use custom colors')
                                        ->schema([
                                            Grid::make()
                                                ->schema([
                                                    ColorPicker::make('background')
                                                        ->live(debounce: 250)
                                                        ->label('Background Color'),

                                                    ColorPicker::make('accent')
                                                        ->live(debounce: 250)
                                                        ->label('Accent Color'),
                                                ])->columns(['sm' => 2]),

                                        ]),
                                ]),
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
                            Toggle::make('toggle')
                                ->inline(false),
                        ])
                        ->columns(2),

                    Section::make('Get the code')
                        ->schema([
                            Tabs::make('tabs')
                                ->contained(false)
                                ->tabs([
                                    Tabs\Tab::make('Panel Provider (PHP)')
                                        ->schema([
                                            CodeBlock::make('php')
                                                ->label('Panel Provider')
                                                ->helperText('Paste this code in your Filament [PanelName]PanelProvider.php file')
                                                ->language('php')
                                                ->hintAction(fn() => Action::make('Copy')
                                                    ->icon('heroicon-s-clipboard')
                                                    ->action(function ($livewire, $state) {
                                                        $livewire->js(
                                                            'window.navigator.clipboard.writeText("' . url('/doc/' . $state) . '");
                                                            $tooltip("' . __('Copied!') . '", { timeout: 1500 });'
                                                        );
                                                    })
                                                ),
                                        ]),
                                    Tabs\Tab::make('Custom Theme (CSS)')
                                        ->schema([
                                            CodeBlock::make('css')
                                                ->label('Theme CSS')
                                                ->helperText('Paste this code in your Filament theme.css file')
                                                ->language('css')
                                                ->hintAction(fn() => Action::make('Copy')
                                                    ->icon('heroicon-s-clipboard')
                                                    ->action(function ($livewire, $state) {
                                                        $livewire->js(
                                                            'window.navigator.clipboard.writeText("' . url('/doc/' . $state) . '");
                                                            $tooltip("' . __('Copied!') . '", { timeout: 1500 });'
                                                        );
                                                    })
                                                ),
                                        ]),
                                ])

                        ]),

                ]
            );
    }
}
