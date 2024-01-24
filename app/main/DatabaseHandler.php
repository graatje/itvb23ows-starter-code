<?php

class DatabaseHandler {
    private $conn;

    public function addPiece($gameId, $piece, $position, $stateString, $lastMoveId) {
        $db = $this->getConn();

        $query = $db->prepare('insert into moves (game_id, type, move_from, move_to, previous_id, state) values (?, "play", ?, ?, ?, ?)');

        // Integer string string integer string
        $query->bind_param('issis', $gameId, $piece, $position, $lastMoveId, $stateString);
        $query->execute();

        return $db->insert_id;
    }

    public function movePiece($gameId, $fromPosition, $toPosition, $lastMoveId, $stateString) {
        $db = $this->getConn();

        $query = $db->prepare('insert into moves (game_id, type, move_from, move_to, previous_id, state) values (?, "move", ?, ?, ?, ?)');
        $query->bind_param('issis', $gameId, $fromPosition, $toPosition, $lastMoveId, $serializedState);
        $query->execute();

        return $db->insert_id;
    }

    public function getMoves($gameId) {
        $db = $this->getConn();

        $query = $db->prepare('SELECT * FROM moves WHERE game_id = '.$gameId);
        
        $query->execute();
        
        $result = $query->get_result();

        return $result->fetch_array();
    }

    public function getConn() {
        if(!isset($this->conn)) {
            $this->conn = new mysqli('host.docker.internal', 'root', 'root', 'hive', 3306);
        }
        return $this->conn;
    }
}
