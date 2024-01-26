<?php



$GLOBALS['OFFSETS'] = [[0, 1], [0, -1], [1, 0], [-1, 0], [-1, 1], [1, -1]];


class Game {

    // External services
    private $databaseHandler;

    // Game variables
    public $gameId;
    public $board;
    public $player;
    public $hand;
    public $lastMoveId;


    public function __construct($databaseHandler) {

        $this->databaseHandler = $databaseHandler;

        if (!isset($_SESSION['game_id']) || !isset($_SESSION['board']) || !isset($_SESSION['hand']) || !isset($_SESSION['player'])) {
            $this->reset();
        }

        $this->gameId = $_SESSION['game_id'];
        $this->board = $_SESSION['board'];
        $this->player = $_SESSION['player'];
        $this->hand = $_SESSION['hand'];
        $this->lastMoveId = $_SESSION['last_move'];

    }

    public function handleAction() {
        if (!isset($_POST['action'])) {
            return;
        }

        switch ($_POST['action']) {
            case 'Play':
                $this->addPiece($_POST['piece'], $_POST['to']);
                break;
            case 'Move':
                $this->movePiece($_POST['from'], $_POST['to']);
                break;
            // case 'Pass':
            //     $this->handlePass();
            //     break;
            // case 'Restart':
            //     $this->handleRestart();
            //     break;
        }
    }

    public function addPiece($piece, $position) {
        // Check if it is in possible add positions

        $this->board[$position] = [[$this->player, $piece]];
        $this->hand[$player][$piece]--;
        $this->swapPlayer();
        

        $_SESSION['last_move'] = $db->insert_id;
    }

    public function movePiece($fromPosition, $toPosition) {

    }

    public function getPossibleAddPositions() {
        $possiblePositions = [];

        foreach ($this->board as $position => $piece) {
            if ($piece[0] != $this->player) {
                continue;
            }

            $position = explode(',', $position[1]);

            foreach ($GLOBALS['OFFSETS'] as $offset) {
                $newPosition = ($position[0] + $offset[0]).','.($position[1] + $offset[1]);
                // Check if the position is already occupied
                if (isset($this->board[$newPosition])) {
                    continue;
                }

                array_push($possiblePositions, $newPosition);
            }
        }
        
        if($possiblePositions == []) {
            $possiblePositions = ['0,0'];
        }
        return $possiblePositions;
    }

    public function getPossibleMovePositions() {
        $possiblePositions = [];

        // Every piece of self, check if it can move to any of the offsets
        foreach ($this->board as $position => $piece) {
            if ($piece[0] != $this->player) {
                continue;
            }

            $position = explode(',', $position[1]);

            foreach ($GLOBALS['OFFSETS'] as $offset) {
                $newPosition = ($position[0] + $offset[0]).','.($position[1] + $offset[1]);
                if (isset($this->board[$newPosition])) {
                    continue;
                }

                array_push($possiblePositions, [$position[1] => $newPosition]);
            }
        }

        return $possiblePositions;
    }

    public function swapPlayer() {
        $this->player = 1 - $this->player;
    }

    public function reset() {
        $this->board = [];
        $this->hand = [0 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3],
                       1 => ["Q" => 1, "B" => 2, "S" => 2, "A" => 3, "G" => 3]
        ];
        $this->player = 0;
        $this->lastMoveId = -1;

        $this->gameId = $this->databaseHandler->reset();

        $this->reload();
    }

    public function reload() {
        // Set all session variables
        $_SESSION['game_id'] = $this->gameId;
        $_SESSION['board'] = $this->board;
        $_SESSION['player'] = $this->player;
        $_SESSION['hand'] = $this->hand;
        $_SESSION['last_move'] = $this->lastMoveId;

        header('Location: index.php');
    }
}
