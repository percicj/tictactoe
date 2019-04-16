<?php

namespace Board;

use Cache\CacheModel;
use Exception;

class BoardModel
{
    /**
     * @var array;
     */
    private $board;

    /**
     * @var CacheModel
     */
    private $cacheModel;

    public function __construct(CacheModel $cacheModel)
    {
        $this->cacheModel = $cacheModel;
        $cache = $this->cacheModel->getCache();
        var_dump($cache);
        if (!empty($cache)) {
            $this->setBoard($cache);
        }
    }

    public function clearCurrentBoard()
    {
        $this->cacheModel->clearCache();
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
        $this->cacheModel->setCache($board);
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
     * @return array
     * @throws Exception
     */
    public function makeMove(array $position)
    {
        $newPosition = $this->parsePosition($position);
        //check if move legal
        if (!$this->isMoveLegal($newPosition)) {
            throw new Exception("illegal move");
        }

        //update board
        $this->setNewBoard($newPosition);

        return $this->board;
    }

    private function setNewBoard(Position $newPosition)
    {
        $this->board[$newPosition->getX()][$newPosition->getY()] = $newPosition->getUnit();
        $this->cacheModel->setCache($this->board);
    }

}