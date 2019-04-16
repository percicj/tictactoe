<?php


namespace Board;

use Bot\Bot;

class BoardController
{
    /**
     * @var Bot
     */
    private $bot;

    /**
     * @var BoardModel
     */
    private $boardModel;


    public function __construct(Bot $bot, BoardModel $boardModel)
    {
        $this->bot = $bot;
        $this->boardModel = $boardModel;
    }

    public function move(array $position, $playerUnit = 'X')
    {
    }

}