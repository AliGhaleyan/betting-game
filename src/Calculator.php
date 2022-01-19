<?php

namespace App;

class Calculator {
    public function getRatio(array $numbers): array
    {
        list($num1, $num2) = [Dice::MAX_NUMBER - count($numbers), count($numbers)];

        for ($i = $num2; $i > 1; $i--) {
            if (($num1 % $i) == 0 && ($num2 % $i) == 0) {
                $num1 = $num1 / $i;
                $num2 = $num2 / $i;
            }
        }

        return [$num1, $num2];
    }

    public function getAward(int $gameRate, int $playerRate, int $value)
    {
        if ($gameRate > $playerRate)
            return $value * $gameRate;

        return $value / $playerRate;
    }
}