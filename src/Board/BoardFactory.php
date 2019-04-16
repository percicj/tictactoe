<?php

namespace Board;

use Bot\Bot;

class BoardFactory
{
    /**
     * @return BoardController
     */
    static function getBoardController() {
        return new BoardController(
            new Bot(),
            new BoardModel()
        );
    }
}