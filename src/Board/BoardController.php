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


    public function __construct(Bot $bot, BoardModel $boardModel)
    {
        $this->bot = $bot;
        $this->boardModel = $boardModel;
    }

    public function move(array $position)
    {
        //make player move
        try {
            $board = $this->boardModel->makeMove($position);
        } catch (Exception $e) {
            die('Problem while executing player move. Error: ' . $e->getMessage());
        }

        if (GameRules::isWin($board, $position[2])) {
            return [
                'board' => $board,
                'win' => 'player'
            ];
        }
        //make bot move
        $botPosition = $this->bot->makeMove($board, $position[2]);

        try {
            $board = $this->boardModel->makeMove($botPosition);
        } catch (Exception $e) {
            die('Problem while executing bot move. Error: ' . $e->getMessage());
        }

        if (GameRules::isWin($board, $botPosition[2])) {
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

    public function load()
    {
        $board = $this->boardModel->getBoard();
        return [
            'board' => $board,
            'win' => ''
        ];
    }

    public function restart()
    {
        $this->boardModel->clearCurrentBoard();
    }
}