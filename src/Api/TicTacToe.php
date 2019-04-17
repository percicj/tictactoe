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

    /**
     * TicTacToe constructor.
     */
    public function __construct()
    {
        $this->boardController = BoardFactory::getBoardController();
    }

    public function getLoad()
    {
        $board = $this->boardController->load();
        $this->printOutput($board);
    }

    /**
     * @param string $x
     * @param string $y
     * @param string $unit
     */
    public function postMove(string $x, string $y, string $unit = 'X') : void
    {
        $board = $this->boardController->move([$x, $y, $unit]);
        $this->printOutput($board);
    }

    public function getRestart() : void
    {
        $board = $this->boardController->restart();
        $this->printOutput($board);
    }

    /**
     * @param mixed $output
     * @return string
     */
    private function printOutput($output) : void
    {
        echo json_encode($output);
    }
}