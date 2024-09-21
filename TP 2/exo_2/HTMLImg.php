<?php
declare(strict_types=1);
require_once ('IObjetHTML.php');
class HTMLImg implements IObjetHTML
{
    private string $src;
    private string $alt;
    private array $styles = [];

    public function __construct(string $src, string $alt = '')
    {
        $this->src = $src;
        $this->alt = $alt;
    }

    public function __toString(): string
    {
        $style = $this->getStyleString();
        return "<img src=\"$this->src\" alt=\"$this->alt\" style=\"$style\">";
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