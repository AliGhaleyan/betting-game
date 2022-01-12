<?php


namespace App;


class GameTable
{
    protected Player $player;
    protected Dice $dice;
    protected bool $win = false;

    public function __construct(Player $player, Dice $dice)
    {
        $this->player = $player;
        $this->dice = $dice;
    }

    public function play()
    {
        if (in_array($this->dice->getNumber(), $this->player->getBetNumbers()))
            $this->setWin(true);

        return $this;
    }

    public function getAward()
    {
        $betNumbers = $this->player->getBetNumbers();
        [$gameRate, $playerRate] = $this->getRatio(6 - count($betNumbers), count($betNumbers));

        if ($this->isWin())
            return $this->player->getBetValue();

        if ($gameRate > $playerRate)
            return -($this->player->getBetValue() / $gameRate);

        return -($this->player->getBetValue() * $playerRate);
    }

    protected function getRatio($num1, $num2): array
    {
        for ($i = $num2; $i > 1; $i--) {
            if (($num1 % $i) == 0 && ($num2 % $i) == 0) {
                $num1 = $num1 / $i;
                $num2 = $num2 / $i;
            }
        }
        return [$num1, $num2];
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