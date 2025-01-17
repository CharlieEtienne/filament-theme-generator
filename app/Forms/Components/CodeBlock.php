<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class CodeBlock extends Field
{
    protected string $view = 'forms.components.code-block';

    protected ?string $language = '';

    public function language(string | null $language): static
    {
        $this->language = $language;

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->evaluate($this->language);
    }
}
