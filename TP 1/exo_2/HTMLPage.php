<?php
declare(strict_types=1);
require_once 'IObjetHTML.php';
require_once 'HTMLHead.php';
require_once 'HTMLBody.php';

class HTMLPage implements IObjetHTML
{
    private HTMLHead $head;
    private HTMLBody $body;
    private array $styles = [];

    public function __construct(HTMLHead $head, HTMLBody $body)
    {
        $this->head = $head;
        $this->body = $body;
    }

    public function __toString(): string
    {
        $style = $this->getStyleString();
        return "<html style=\"$style\">" . $this->head . $this->body . "</html>";
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