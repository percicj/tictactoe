<?php

include('../vendor/autoload.php');

use RestService\Server;

session_start();

Server::create('/', 'Api\TicTacToe')
    ->collectRoutes()
    ->run();