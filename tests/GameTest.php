<?php

use App\Dice;
use App\GameTable;
use App\Player;
use App\Actor;
use PHPUnit\Framework\TestCase;

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
}