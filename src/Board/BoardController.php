<?php


namespace Board;

use Bot\Bot;
use Exception;

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


    /**
     * BoardController constructor.
     * @param Bot $bot
     * @param BoardModel $boardModel
     */
    public function __construct(Bot $bot, BoardModel $boardModel)
    {
        $this->bot = $bot;
        $this->boardModel = $boardModel;
    }

    /**
     * @param array $position
     * @return array
     */
    public function move(array $position) : array
    {
        $playerUnit = $position[2];

        //make player move
        try {
            $board = $this->boardModel->makeMove($position);
        } catch (Exception $e) {
            die('Problem while executing player move. Error: ' . $e->getMessage());
        }

        if (GameRules::isWin($board, $playerUnit)) {
            return [
                'board' => $board,
                'win' => 'player'
            ];
        }
        //make bot move
        $botPosition = $this->bot->makeMove($board, $playerUnit);
        $botUnit = $botPosition[2];

        try {
            $board = $this->boardModel->makeMove($botPosition);
        } catch (Exception $e) {
            die('Problem while executing bot move. Error: ' . $e->getMessage());
        }

        if (GameRules::isWin($board, $botUnit)) {
            return [
                'board' => $board,
                'win' => 'ai'
            ];
        }


        return [
            'board' => $board,
            'win' => ''
        ];
    }

    /**
     * @return array
     */
    public function load() : array
    {
        $board = $this->boardModel->getBoard();
        return [
            'board' => $board,
            'win' => ''
        ];
    }

    /**
     * @return array
     */
    public function restart() : array
    {
        $this->boardModel->clearCurrentBoard();
        $board = $this->boardModel->getBoard();
        return [
            'board' => $board,
            'win' => ''
        ];
    }
}