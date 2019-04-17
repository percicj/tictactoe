<?php

namespace Bot;

class Bot implements MoveInterface
{
    /**
     * @var array
     */
    private $winFunction;

    public function __construct(array $winFunction)
    {
        $this->winFunction = $winFunction;
    }


    /**
     * Makes a move using the actual game board state, against the player.
     *
     * $boardState contains a 2D array of the 3x3 board with the 3 possible values:
     * - X and O represents the player or the bot, as defined by $playerUnit
     * - empty string means that the field is not yet taken
     * Example:
     * [['X', 'O', '']
     * ['X', 'O', 'O']
     * [ '', '', '']]
     *
     * Returns an array containing X and Y coordinates for the next move
     * and the unit that should occupy it.
     * Example: [2, 0, 'O'] - upper right corner with O unit
     *
     * @param array $boardState
     * @param string $playerUnit
     *
     * @return array
     */
    public function makeMove(array $boardState, string $playerUnit = 'X'): array
    {
        $aiUnit = $playerUnit === 'X' ? 'O' : 'X';

        $move = $this->minmax($boardState, $aiUnit, $playerUnit, $aiUnit);

        return [$move['position'][0], $move['position'][1], $move['unit']];
    }

    private function getAvailableMoves($board)
    {
        $availableMoves = [];
        foreach ($board as $x => $column) {
            foreach ($column as $y => $spot) {
                if (empty($spot)) {
                    $availableMoves[] = [$x, $y];
                }
            }
        }

        return $availableMoves;
    }

    private function minmax($board, $player, $playerUnit, $aiUnit)
    {
        $availableMoves = $this->getAvailableMoves($board);

        if ($this->hasWon($board, $playerUnit)) {
            return ["score" => -10];
        }

        if ($this->hasWon($board, $aiUnit)) {
            return ["score" => 10];
        }

        if (empty($availableMoves)) {
            return ["score" => 0];
        }

        $moves = [];

        foreach ($availableMoves as $move) {
            $board[$move[0]][$move[1]] = $player;

            $currentMove['position'] = $move;
            $currentMove['unit'] = $player;

            if ($player === $aiUnit) {
                $result = $this->minmax($board, $playerUnit, $playerUnit, $aiUnit);
            } else {
                $result = $this->minmax($board, $aiUnit, $playerUnit, $aiUnit);
            }

            $currentMove['score'] = $result["score"];

            $board[$move[0]][$move[1]] = '';

            $moves[] = $currentMove;
        }

        if ($player === $aiUnit) {
            $bestScore = -10000;
            foreach ($moves as $index => $possibleMove) {
                if ($possibleMove['score'] > $bestScore) {
                    $bestScore = $possibleMove['score'];
                    $bestMove = $index;
                }
            }
        } else {
            $bestScore = 10000;
            foreach ($moves as $index => $possibleMove) {
                if ($possibleMove['score'] < $bestScore) {
                    $bestScore = $possibleMove['score'];
                    $bestMove = $index;
                }
            }
        }

        return $moves[$bestMove];
    }

    private function hasWon($board, $unit)
    {
        return call_user_func($this->winFunction, $board, $unit);
    }
}