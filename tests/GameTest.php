<?php

use App\Actor;
use App\Calculator;
use App\Dice;
use App\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    private Calculator $calculator;

    public function test_ratio()
    {
        $this->assertRatio([5, 1], [1]);
        $this->assertRatio([2, 1], [1, 2]);
        $this->assertRatio([1, 1], [1, 2, 3]);
        $this->assertRatio([1, 2], [1, 2, 3, 4]);
        $this->assertRatio([1, 5], [1, 2, 3, 4, 5]);
    }

    protected function assertRatio($rate, $bet)
    {
        $this->assertEquals($rate, $this->calculator->getRatio($bet));
    }

    public function test_award()
    {
        $this->assertAward([
            [5, 1, 500],
            [2, 1, 200],
            [1, 1, 100],
            [1, 2, 50],
            [1, 5, 20],
        ], 100);
    }

    public function assertAward($values, $bet)
    {
        foreach ($values as [$gameRate, $playerRate, $award])
            $this->assertEquals($this->calculator->getAward($gameRate, $playerRate, $bet), $award);
    }

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

    protected function setUp(): void
    {
        parent::setUp();
        $this->calculator = new Calculator();
    }
}
