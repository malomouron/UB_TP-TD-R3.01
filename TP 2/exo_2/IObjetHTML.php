<?php

interface IObjetHTML
{

    public function __toString(): string;
    public function setCSS(array $styles): void;
    public function getCSS(): array;

}