<?php
declare(strict_types=1);

use exo_1\HTMLBody;
use exo_1\HTMLHead;
use exo_1\HTMLP;
use exo_1\HTMLPage;

require_once("HTMLPage.php");
require_once("HTMLP.php");

$head = new HTMLHead("Hello");
$body = new HTMLBody("Body");
$page = new HTMLPage($head, $body);

$body->add(new HTMLP("hello"));
$body->add(new HTMLP("toto"));
$body->add(new HTMLP("titi"));

echo $page->__toString();
?>