<?php

namespace Test\Bot;

use Board\GameRules;
use Bot\Bot;
use PHPUnit\Framework\TestCase;

class BotTest extends TestCase
{
    /**
     * @var Bot
     */
    private $bot;

    protected function setUp(): void
    {
        $winFunc = [GameRules::class, 'isWin'];

        $this->bot = new Bot($winFunc);
    }

    /**
     * @param $board
     * @param $playerUnit
     * @param $expectedMove
     * @dataProvider makeMoveDataProvider
     */
    public function testMakeMove($board, $playerUnit, $expectedMove)
    {
        $move = $this->bot->makeMove($board, $playerUnit);
        $this->assertEquals($expectedMove, $move);
    }

    public function makeMoveDataProvider()
    {
        return [
            [
                [
                    ['X', '', ''],
                    ['', '', ''],
                    ['', '', ''],
                ],
                'X',
                [1,1,'O'],
            ],
            [
                [
                    ['X', '', ''],
                    ['X', 'O', ''],
                    ['', '', ''],
                ],
                'X',
                [0,2,'O'],
            ],
            [
                [
                    ['X', '', 'X'],
                    ['X', 'O', ''],
                    ['O', '', ''],
                ],
                'X',
                [1,0,'O'],
            ],
            [
                [
                    ['X', 'O', 'X'],
                    ['X', 'O', ''],
                    ['O', 'X', ''],
                ],
                'X',
                [2,1,'O'],
            ],
        ];
    }
}
