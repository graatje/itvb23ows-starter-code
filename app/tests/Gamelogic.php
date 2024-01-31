<?php
ob_start();

session_start();
include 'main/Game.php';
include 'main/DatabaseHandler.php';

use PHPUnit\Framework\TestCase;

final class Gamelogic extends TestCase {
    public function testValidMoves(): void {
        ob_start();
        
        $dbHandler = new DatabaseHandler();
        $g = new Game($dbHandler);
        
        $this->assertEquals($g->getPossibleAddPositions(), ['0,0']);

        $g->addPiece('Q', '0,0');

        $this->assertEquals($g->getPossibleAddPositions(), ['0,1', '0,-1','1,0', '-1,0', '-1,1', '1,-1']);

        $g->addPiece('Q', '0,1');

        $this->assertEquals($g->getPossibleAddPositions(), ['0,-1', '-1,0', '1,-1']);
        
        $g->addPiece('B', '-1,0');

        $this->assertEquals($g->getPossibleAddPositions(), ['0,2', '1,1', '-1,2']);

        ob_end_clean();
    }
}
