<?php


namespace App;


class Dice
{
    const MAX_NUMBER = 6;

    public function getNumber()
    {
        return rand(1, self::MAX_NUMBER);
    }
}