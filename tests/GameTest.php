<?php


use App\Dice;
use App\GameTable;
use App\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function test_win()
    {
        $sut = new GameTable(new Player([1, 2], 100), $this->getDiceMock(1));
        $sut->play();
        $this->assertTrue($sut->isWin());
        $this->assertEquals($sut->getAward(), 100);
    }

    protected function getDiceMock(int $willReturn): Dice
    {
        $diceMock = $this->createMock(Dice::class);
        $diceMock->expects($this->once())->method("getNumber")->willReturn($willReturn);
        return $diceMock;
    }

    public function test_lesser_lose()
    {
        $sut = new GameTable(new Player([1, 2], 100), $this->getDiceMock(3));
        $sut->play();
        $this->assertFalse($sut->isWin());
        $this->assertEquals($sut->getAward(), -50);
    }

    public function test_more_lose()
    {
        $sut = new GameTable(new Player([1, 2, 3, 4], 100), $this->getDiceMock(5));
        $sut->play();
        $this->assertFalse($sut->isWin());
        $this->assertEquals($sut->getAward(), -200);
    }
}