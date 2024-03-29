<?php

namespace Board;

class GameRules implements GameRulesInterface
{
    /**
     * @param array $board
     * @param string $unit
     * @return bool
     */
    public static function isWin(array $board, string $unit): bool
    {
        return (
            ($board[0][0] === $unit && $board[0][1] === $unit && $board[0][2] === $unit) ||
            ($board[1][0] === $unit && $board[1][1] === $unit && $board[1][2] === $unit) ||
            ($board[2][0] === $unit && $board[2][1] === $unit && $board[2][2] === $unit) ||
            ($board[0][0] === $unit && $board[1][0] === $unit && $board[2][0] === $unit) ||
            ($board[0][1] === $unit && $board[1][1] === $unit && $board[2][1] === $unit) ||
            ($board[0][2] === $unit && $board[1][2] === $unit && $board[2][2] === $unit) ||
            ($board[0][0] === $unit && $board[1][1] === $unit && $board[2][2] === $unit) ||
            ($board[2][0] === $unit && $board[1][1] === $unit && $board[0][2] === $unit)
        );
    }

    /**
     * If player as going last didn't win and there are no more moves
     * we call it a draw
     *
     * @param array $board
     * @return bool
     */
    public static function isDraw(array $board)
    {
        foreach ($board as $x => $column) {
            foreach ($column as $y => $spot) {
                if (empty($spot)) {
                    return false;
                }
            }
        }

        return true;
    }
}