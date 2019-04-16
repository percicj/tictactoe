<?php

namespace Api;

use Board\BoardController;
use Board\BoardFactory;

class TicTacToe
{
    /**
     * @var BoardController
     */
    private $boardController;

    public function __construct()
    {
        $this->boardController = BoardFactory::getBoardController();
    }


    public function postMove($x, $y, $unit = 'X')
    {
        $board = $this->boardController->move([$x, $y, $unit]);
        var_dump($board);
    }
}