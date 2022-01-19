<?php

use App\Dice;
use App\GameTable;
use App\Player;
use App\Actor;
use PHPUnit\Framework\TestCase;
use App\Calculator;

class GameTest extends TestCase
{
    public function test_win()
    {
        $sut = new Actor(new Player([1, 2], 100), $this->getDiceMock(1));
        $sut->play();
        $this->assertTrue($sut->isWin());
        $this->assertEquals($sut->getAward(), 200);
    }

    protected function getDiceMock(int $willReturn): Dice
    {
        $diceMock = $this->createMock(Dice::class);
        $diceMock->expects($this->once())->method("getNumber")->willReturn($willReturn);
        return $diceMock;
    }

    public function test_lose()
    {
        $sut = new Actor(new Player([1, 2], 100), $this->getDiceMock(3));
        $sut->play();
        $this->assertFalse($sut->isWin());
        $this->assertEquals($sut->getAward(), 0);
    }

    public function test_ratio()
    {
        $this->assertRatio(
            [[5, 1], [1]],
            [[2, 1], [1, 2]],
            [[1, 1], [1, 2, 3]],
            [[1, 2], [1, 2, 3, 4]],
            [[1, 5], [1, 2, 3, 4, 5]]
        );
    }

    protected function assertRatio(...$numbers)
    {
        $calculator = new Calculator();

        foreach ($numbers as [$rate, $bet]) {
            $this->assertEquals($rate, $calculator->getRatio($bet));
        }
    }

    public function test_award()
    {
        $this->assertAward(
            [5, 1, 500],
            [2, 1, 200],
            [1, 1, 100],
            [1, 2, 50],
            [1, 5, 20],
        );
    }

    public function assertAward(...$values)
    {
        $calculator = new Calculator();
        $value = 100;

        foreach ($values as [$gameRate, $playerRate, $award]) {
            $this->assertEquals($calculator->getAward($gameRate, $playerRate, $value), $award);
        }
    }
}
