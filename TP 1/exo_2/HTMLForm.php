<?php

require_once 'IObjetHTML.php';
require_once 'HTMLInput.php';

class HTMLForm implements IObjetHTML
{
    private array $inputs = [];
    private string $action;
    private array $styles = [];

    public function __construct(string $action)
    {
        $this->action = $action;
    }

    public function __toString(): string
    {
        $style = $this->getStyleString();
        return "<form method='post' action=\"$this->action\" style=\"$style\">" . implode('', $this->inputs) . "</form>";
    }

    public function __toStringResultat(): string
    {
        $result = "";
        foreach ($this->inputs as $input) {
            $result .= $input->getName() . " => " . $input->getValue() . "\n";
        }
        return $result;
    }

    public function add(HTMLInput $input)
    {
        $this->inputs[] = $input;
    }

    public function hydrate(array $data)
    {
        foreach ($this->inputs as $input) {
            $input->setValue($data[$input->getName()]);
        }
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