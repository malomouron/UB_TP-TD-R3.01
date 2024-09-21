<?php
declare(strict_types=1);

namespace exo_1;

class HTMLBody
{

    private array $_items;


    public function __construct()
    {
        $this->_items = [];
    }

    public function add(IObjetHTML $item)
    {
        $this->_items[] = $item;
    }

    public function __toString(): string
    {
        return "<body>\n" . implode("\n", $this->_items) . "\n</body>";
    }

}