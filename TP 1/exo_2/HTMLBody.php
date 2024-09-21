<?php
declare(strict_types=1);
require_once 'IObjetHTML.php';

class HTMLBody implements IObjetHTML
{
    private array $elements = [];
    private array $styles = [];

    public function add(IObjetHTML $element): void
    {
        $this->elements[] = $element;
    }

    public function __toString(): string
    {
        $style = $this->getStyleString();
        $content = '';
        foreach ($this->elements as $element) {
            $content .= $element;
        }
        return "<body style=\"$style\">$content</body>";
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