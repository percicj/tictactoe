<?php

namespace Test\Board;

use Board\BoardController;
use Board\BoardModel;
use Bot\Bot;
use PHPUnit\Framework\TestCase;

class BoardControllerTest extends TestCase
{
    private $boardStub;

    private $botStub;

    protected function setUp(): void
    {
        $this->boardStub = $this->getMockBuilder(BoardModel::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->botStub = $this->getMockBuilder(Bot::class)
            ->disableOriginalConstructor()
            ->getMock();
    }


    public function testLoad()
    {
        $board = ['1', '2', '3'];

        $expectedResult = [
            'board'=> $board,
            'win' => ''
        ];
        $this->boardStub->expects($this->once())->method('getBoard')->willReturn($board);
        $boardController = new BoardController(
            $this->botStub,
            $this->boardStub
        );
        $result = $boardController->load();
        $this->assertEquals($expectedResult, $result);
    }

    public function testRestart()
    {
        $board = ['', '', ''];

        $expectedResult = [
            'board'=> $board,
            'win' => ''
        ];
        $this->boardStub->expects($this->once())->method('clearCurrentBoard');
        $this->boardStub->expects($this->once())->method('getBoard')->willReturn($board);
        $boardController = new BoardController(
            $this->botStub,
            $this->boardStub
        );
        $result = $boardController->restart();
        $this->assertEquals($expectedResult, $result);

    }

    public function testMovePlayerWins()
    {
        $board = [
            ['X','O',''],
            ['','X','O'],
            ['','','X'],
        ];

        $move = ['2', '2', 'X'];

        $expectedResult = [
            'board' => $board,
            'win' => 'player wins'
        ];

        $this->boardStub->expects($this->at(0))->method('makeMove')->with($move)->willReturn($board);
        $boardController = new BoardController(
            $this->botStub,
            $this->boardStub
        );

        $result = $boardController->move($move);
        $this->assertEquals($expectedResult, $result);
    }

    public function testMoveAiWins()
    {
        $boardPlayer = [
            ['X','',''],
            ['','X','O'],
            ['','X','O'],
        ];

        $boardAi = [
            ['X','','O'],
            ['','X','O'],
            ['','X','O'],
        ];

        $playerMove = ['2', '1', 'X'];

        $aiMove = ['2', '0', 'O'];

        $expectedResult = [
            'board' => $boardAi,
            'win' => 'ai wins'
        ];

        $this->boardStub->expects($this->at(0))->method('makeMove')->with($playerMove)->willReturn($boardPlayer);
        $this->botStub->expects($this->once())->method('makeMove')->with($boardPlayer, $playerMove[2])->willReturn($aiMove);
        $this->boardStub->expects($this->at(1))->method('makeMove')->with($aiMove)->willReturn($boardAi);
        $boardController = new BoardController(
            $this->botStub,
            $this->boardStub
        );

        $result = $boardController->move($playerMove);
        $this->assertEquals($expectedResult, $result);
    }

    public function testMoveDraw()
    {
        $board = [
            ['X','O','X'],
            ['O','X','O'],
            ['O','X','O'],
        ];

        $move = ['1', '2', 'X'];

        $expectedResult = [
            'board' => $board,
            'win' => 'draw'
        ];

        $this->boardStub->expects($this->at(0))->method('makeMove')->with($move)->willReturn($board);
        $boardController = new BoardController(
            $this->botStub,
            $this->boardStub
        );

        $result = $boardController->move($move);
        $this->assertEquals($expectedResult, $result);

    }

}
