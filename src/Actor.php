<?php

namespace App;

class Actor {
    private Player $player;
    private Dice $dice;
    private Calculator $calculator;
    private bool $win = false;

    public function __construct(Player $player, Dice $dice)
    {
        $this->player = $player;
        $this->dice = $dice;
        $this->calculator = new Calculator();
    }

    public function play()
    {
        if (in_array($this->dice->getNumber(), $this->player->getBetNumbers()))
            $this->setWin(true);

        return $this;
    }

    public function getAward()
    {
        if (!$this->isWin()) return 0;

        $betNumbers = $this->player->getBetNumbers();
        [$gameRate, $playerRate] = $this->calculator->getRatio($betNumbers);

        return $this->calculator->getAward($gameRate, $playerRate, $this->player->getBetValue());
    }

    public function isWin(): bool
    {
        return $this->win;
    }

    public function setWin(bool $win): void
    {
        $this->win = $win;
    }
}