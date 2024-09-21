<?php
declare(strict_types=1);
require_once ('IObjetHTML.php');
class HTMLP implements IObjetHTML
{
    private string $content;
    private array $styles = [];

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function __toString(): string
    {
        $style = $this->getStyleString();
        return "<p style=\"$style\">$this->content</p>";
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