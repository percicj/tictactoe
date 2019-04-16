<?php

include('../vendor/autoload.php');

use Api\TicTacToe;
use Luracast\Restler\Restler;

define("ROOTDIR", realpath('..'));

session_set_cookie_params(600);
session_start();

try {
    $r = new Restler();
    $r->addAPIClass(TicTacToe::class);
    $r->handle();
} catch (Exception $e) {
    die($e->getMessage());
}