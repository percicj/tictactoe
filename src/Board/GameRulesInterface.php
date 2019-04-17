<?php

namespace Board;

interface GameRulesInterface
{
    public static function isWin(array $board, string $unit) : bool;
}