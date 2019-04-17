<?php

namespace Test\Board;

use Board\BoardModel;
use Board\Position;
use Cache\CacheModel;
use Exception;
use PHPUnit\Framework\TestCase;

class BoardModelTest extends TestCase
{
    private $cacheModelStub;

    const CACHED_BOARD = [
        ['X', '', ''],
        ['', 'O', 'O'],
        ['','','X'],
    ];

    protected function setUp(): void
    {
        $this->cacheModelStub = $this->getMockBuilder(CacheModel::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    public function test__constructWithCache()
    {
        $this->cacheModelStub->method('getCache')->willReturn(self::CACHED_BOARD);
        $this->cacheModelStub->expects($this->once())->method('setCache')->with(self::CACHED_BOARD);
        $boardModel = new BoardModel($this->cacheModelStub);
        $this->assertInstanceOf(BoardModel::class, $boardModel);
    }

    public function test__constructNoCache()
    {
        $this->cacheModelStub->method('getCache')->willReturn('');
        $this->cacheModelStub->expects($this->once())->method('setCache')->with(BoardModel::DEFAULT_BOARD);
        $boardModel = new BoardModel($this->cacheModelStub);
        $this->assertInstanceOf(BoardModel::class, $boardModel);
    }

    public function testClearCurrentBoard()
    {
        $this->cacheModelStub->method('setCache')->with(BoardModel::DEFAULT_BOARD);
        $boardModel = new BoardModel($this->cacheModelStub);
        $boardModel->clearCurrentBoard();
        $board = $boardModel->getBoard();
        $this->assertEquals(BoardModel::DEFAULT_BOARD, $board);
    }


    /**
     * @dataProvider isMoveLegalDataProvider
     */
    public function testIsMoveLegal($position, $expected)
    {
        $this->cacheModelStub->method('getCache')->willReturn(self::CACHED_BOARD);
        $boardModel = new BoardModel($this->cacheModelStub);
        $isMoveLegal = $boardModel->isMoveLegal($position);
        $this->assertEquals($expected, $isMoveLegal);
    }

    public function isMoveLegalDataProvider() {
        return [
            [
                new Position([0,0,'X']),
                false,
            ],
            [
                new Position([0,1,'X']),
                true,
            ],
        ];
    }

    public function testMakeMove()
    {
        $newPosition = [0,1,'X'];

        $expectedBoard = self::CACHED_BOARD;
        $expectedBoard[$newPosition[1]][$newPosition[0]] = $newPosition[2];

        $this->cacheModelStub->method('getCache')->willReturn(self::CACHED_BOARD);
        $boardModel = new BoardModel($this->cacheModelStub);

        $board = $boardModel->makeMove($newPosition);

        $this->assertEquals($expectedBoard, $board);
    }

    public function testMakeMoveThrowsException()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('illegal move');
        $newPosition = [0,0,'X'];

        $expectedBoard = self::CACHED_BOARD;
        $expectedBoard[$newPosition[1]][$newPosition[0]] = $newPosition[2];

        $this->cacheModelStub->method('getCache')->willReturn(self::CACHED_BOARD);
        $boardModel = new BoardModel($this->cacheModelStub);

        $board = $boardModel->makeMove($newPosition);
    }

    public function testSetBoard()
    {
        $newBoard = [
            ['X','',''],
            ['','X',''],
            ['','','O']
        ];

        $this->cacheModelStub->expects($this->at(2))->method('setCache')->with($newBoard);
        $boardModel = new BoardModel($this->cacheModelStub);
        $boardModel->setBoard($newBoard);
        $board = $boardModel->getBoard();
        $this->assertEquals($newBoard, $board);
    }

    public function testGetBoard()
    {
        $newBoard = [
            ['X','',''],
            ['','X',''],
            ['','','O']
        ];

        $boardModel = new BoardModel($this->cacheModelStub);
        $boardModel->setBoard($newBoard);
        $board = $boardModel->getBoard();
        $this->assertEquals($newBoard, $board);
    }
}
