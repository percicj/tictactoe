<?php

namespace Board;

use Bot\Bot;
use Cache\CacheModel;
use Cache\FileStorageRepository;

class BoardFactory
{
    /**
     * @return BoardController
     */
    static function getBoardController() {

        $winFunc = [GameRules::class, 'isWin'];

        return new BoardController(
            new Bot(
                $winFunc
            ),
            new BoardModel(
                new CacheModel(
                    new FileStorageRepository()
                )
            )
        );
    }
}