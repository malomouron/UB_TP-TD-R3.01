<?php
declare(strict_types=1);

namespace exo_1;

require_once("HTMLHead.php");
require_once("HTMLBody.php");

class HTMLPage
{
    private HTMLHead $_head;
    private HTMLBody $_body;

    public function __construct(HTMLHead $head, HTMLBody $body)
    {
        $this->_head = $head;
        $this->_body = $body;
    }

    public function __toString(): string
    {
        return "<!DOCTYPE html>\n<html>\n" . $this->_head . "\n" . $this->_body . "\n</html>";
    }

}