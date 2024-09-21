<?php
declare(strict_types=1);

use exo\HighScore;

require_once("HighScore.php");
$tabhighscore = new HighScore();
$tabhighscore->loadFromCookie();
$value = rand(0,100);
$tabhighscore->add_value($value);
echo $tabhighscore->__toString()."<br/>";
$tabhighscore->storeInCookie();
?>
