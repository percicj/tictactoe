<?php

namespace Test\Board;

use Board\GameRules;
use PHPUnit\Framework\TestCase;

class GameRulesTest extends TestCase
{
    /**
     * @dataProvider winDataProvider
     * @param array $board
     * @param string $unit
     * @param bool $expectedResult
     */
    public function testIsWin($board, $unit, $expectedResult)
    {
        $result = GameRules::isWin($board, $unit);
        $this->assertEquals($expectedResult, $result);
    }

    public function winDataProvider()
    {
        return [
            [
                [
                    ['X', 'X', 'X'],
                    ['', '', ''],
                    ['', '', ''],
                ],
                'X',
                true,
            ],
            [
                [
                    ['', '', ''],
                    ['X', 'X', 'X'],
                    ['', '', ''],
                ],
                'X',
                true,
            ],
            [
                [
                    ['', '', ''],
                    ['', '', ''],
                    ['X', 'X', 'X'],
                ],
                'X',
                true,
            ],
            [
                [
                    ['O', '', ''],
                    ['O', '', ''],
                    ['O', 'X', 'X'],
                ],
                'O',
                true,
            ],
            [
                [
                    ['', 'O', ''],
                    ['', 'O', ''],
                    ['X', 'O', 'X'],
                ],
                'O',
                true,
            ],
            [
                [
                    ['', '', 'O'],
                    ['', '', 'O'],
                    ['X', 'X', 'O'],
                ],
                'O',
                true,
            ],
            [
                [
                    ['', '', 'O'],
                    ['', '', 'X'],
                    ['X', 'X', 'O'],
                ],
                'O',
                false,
            ],
        ];
    }
}
