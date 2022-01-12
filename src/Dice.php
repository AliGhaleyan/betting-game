<?php


namespace App;


class Dice
{
    public function getNumber()
    {
        return rand(1, 6);
    }
}