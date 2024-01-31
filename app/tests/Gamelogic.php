<?php
ob_start();

session_start();
include 'main/Game.php';
include 'main/DatabaseHandler.php';

use PHPUnit\Framework\TestCase;

final class Gamelogic extends TestCase
{
    public function testValidMoves(): void
    {
        
        $dbHandler = new DatabaseHandler();
        $g = new Game($dbHandler);
        ob_end_flush();
    }
}
