<?php

namespace Board;

use Exception;

class BoardModel
{
    /**
     * @var array;
     */
    private $board;

    public function __construct()
    {
        if (!empty($_SESSION['board'])) {
            $this->setBoard($_SESSION['board']);
        }
    }

    public function clearCurrentBoard()
    {
        $_SESSION['board'];
        $this->setBoard([]);
    }

    /**
     * @param Position $position
     * @return bool
     */
    public function isMoveLegal(Position $position)
    {
        return empty($this->board[$position->getX()][$position->getY()]);
    }

    /**
     * @param array $board
     */
    public function setBoard(array $board): void
    {
        $this->board = $board;
    }

    /**
     * @return array
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    private function parsePosition(array $position)
    {
        return new Position($position);
    }

    /**
     * @param array $position
     * @param string $unit
     * @return array
     * @throws Exception
     */
    public function makeMove(array $position, string $unit)
    {
        $newPosition = $this->parsePosition($position);
        //check if move legal
        if (!$this->isMoveLegal($newPosition)) {
            throw new Exception("illegal move");
        }

        //update board
        $this->setNewBoard($newPosition, $unit);

        return $this->board;
    }

    private function setNewBoard(Position $newPosition, string $unit)
    {
        $this->board[$newPosition->getX()][$newPosition->getY()] = $unit;
    }

}