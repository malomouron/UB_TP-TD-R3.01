<?php
declare(strict_types=1);
require_once 'IObjetHTML.php';

class HTMLHead implements IObjetHTML
{
    private string $title;
    private array $styles = [];

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function __toString(): string
    {
        $style = $this->getStyleString();
        return "<head style=\"$style\"><title>$this->title</title></head>";
    }

    public function setCSS(array $styles): void
    {
        $this->styles = $styles;
    }

    public function getCSS(): array
    {
        return $this->styles;
    }

    private function getStyleString(): string
    {
        $styleString = '';
        foreach ($this->styles as $key => $value) {
            $styleString .= "$key: $value; ";
        }
        return $styleString;
    }
}