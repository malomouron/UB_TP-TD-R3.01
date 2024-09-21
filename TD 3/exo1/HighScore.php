<?php

declare(strict_types=1);

namespace exo;
class HighScore
{
    private array $tab;

    public function __construct()
    {
        $this->tab = [];
    }

    public function add_value($value)
    {
        $this->tab[] = $value;
        sort($this->tab);
        $this->tab = array_slice($this->tab, 0, 10);
    }

    public function __toString(): string
    {
        $str = "";
        foreach ($this->tab as $value) {
            $str .= $value . "\n";
        }
        return $str;
    }

    public function storeInCookie()
    {
        setcookie('highscore', json_encode($this->tab), time() + 3600);
    }

    public function loadFromCookie()
    {
        if (isset($_COOKIE['highscore'])) {
            $this->tab = json_decode($_COOKIE['highscore'], true);
        }
    }

}