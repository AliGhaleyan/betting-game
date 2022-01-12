<?php


namespace App;


class Player
{
    private array $betNumbers = [];
    private int $betValue;

    public function __construct(array $betNumbers, int $betValue)
    {
        $this->betNumbers = $betNumbers;
        $this->betValue = $betValue;
    }

    public function getBetNumbers(): array
    {
        return $this->betNumbers;
    }

    public function getBetValue(): int
    {
        return $this->betValue;
    }
}