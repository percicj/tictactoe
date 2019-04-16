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
        return new BoardController(
            new Bot(),
            new BoardModel(
                new CacheModel(
                    new FileStorageRepository()
                )
            )
        );
    }
}