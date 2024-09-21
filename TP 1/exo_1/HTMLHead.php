<?php
declare(strict_types=1);

namespace exo_1;
class HTMLHead
{
    private string $_title;

    public function __construct(string $title)
    {
        $this->_title = $title;
    }

    public function __toString(): string
    {
        return "<head>\n<title>" . $this->_title . "</title>\n</head>";
    }
}