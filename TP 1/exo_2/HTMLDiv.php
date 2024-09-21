<?php
declare(strict_types=1);
require_once ('IObjetHTML.php');
class HTMLDiv implements IObjetHTML
{
    private array $children = [];
    private array $styles = [];

    public function add(IObjetHTML $child): void
    {
        $this->children[] = $child;
    }

    public function __toString(): string
    {
        $style = $this->getStyleString();
        $content = '';
        foreach ($this->children as $child) {
            $content .= $child;
        }
        return "<div style=\"$style\">$content</div>";
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