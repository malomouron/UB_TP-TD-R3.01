<?php
declare(strict_types=1);
require_once 'IObjetHTML.php';

class HTMLInput implements IObjetHTML
{
    private string $name;
    private string $type;
    private string $value;
    private string $label;
    private array $styles = [];

    public function setValue(string $value): void
    {
        $this->value = htmlspecialchars($value);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __construct(string $name, string $type, string $value, string $label)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->label = $label;
    }

    public function __toString(): string
    {
        $style = $this->getStyleString();
        return "<label for=\"$this->name\">$this->label</label><input type=\"$this->type\" name=\"$this->name\" value=\"$this->value\" style=\"$style\">";
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