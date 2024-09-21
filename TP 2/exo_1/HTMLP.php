<?php
declare(strict_types=1);

namespace exo_1;

require_once("IObjetHTML.php");

class HTMLP implements IObjetHTML
{
    private string $_text;

    public function __construct(string $text)
    {
        $this->_text = $text;
    }

    public function __toString(): string
    {
        return "<p>" . $this->_text . "</p>";
    }
}