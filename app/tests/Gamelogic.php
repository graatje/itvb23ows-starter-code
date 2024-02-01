<?php
ob_start();

session_start();
include 'main/Game.php';
include 'main/DatabaseHandler.php';

use PHPUnit\Framework\TestCase;

final class Gamelogic extends TestCase {
    public function testValidMoves(): void {
        $dbHandler = new DatabaseHandler();
        $g = new Game($dbHandler);
        
        $this->assertEquals($g->getPossibleAddPositions(), ['0,0']);
        $this->assertEquals($g->hand, [0 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3],
                                       1 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3]
                                    ]
        );

        $g->addPiece('Q', '0,0');

        $this->assertEquals($g->getPossibleAddPositions(), ['0,1', '0,-1','1,0', '-1,0', '-1,1', '1,-1']);
        $this->assertEquals($g->hand, [0 => ["Q" => 0, "B" => 2, "S" => 2, "A" => 3, "G" => 3],
                                       1 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3]
                                    ]
        );

        $g->addPiece('Q', '0,1');

        $this->assertEquals($g->getPossibleAddPositions(), ['0,-1', '-1,0', '1,-1']);
        $this->assertEquals($g->getPossibleMovePositions(), []);
        
        $g->addPiece('B', '-1,0');

        $this->assertEquals($g->getPossibleAddPositions(), ['0,2', '1,1', '-1,2']);
        $this->assertEquals($g->getPossibleMovePositions(), []);
    }

    protected function setUp(): void{
        ob_start();
    }

    protected function tearDown(): void{
        ob_end_clean();
    }
}
