<?php

class DatabaseHandler {
    private $conn;

    public function addPiece($gameId, $piece, $position, $game, $lastMoveId) {
        $db = $this->getConn();

        $query = $db->prepare('insert into moves (game_id, type, move_from, move_to, previous_id, state) values (?, "play", ?, ?, ?, ?)');

        // Integer string string integer string
        $query->bind_param('issis', $gameId, $piece, $position, $lastMoveId, $game->serialize());
        $query->execute();

        return $db->insert_id;
    }

    public function movePiece($gameId, $fromPosition, $toPosition, $game, $lastMoveId) {
        $db = $this->getConn();

        $query = $db->prepare('insert into moves (game_id, type, move_from, move_to, previous_id, state) values (?, "move", ?, ?, ?, ?)');
        $query->bind_param('issis', $gameId, $fromPosition, $toPosition, $lastMoveId, $game->serialize());
        $query->execute();

        return $db->insert_id;
    }

    public function getMoves($gameId) {
        $db = $this->getConn();

        $query = $db->prepare('SELECT * FROM moves WHERE game_id = '.$gameId);
        
        $query->execute();
        
        $result = $query->get_result();

        return $result->fetch_all();
    }

    public function reset() {
        $db = $this->getConn();
        $db->prepare('INSERT INTO games VALUES ()')->execute();
        return $db->insert_id;
    }

    public function getConn() {
        if(!isset($this->conn)) {
            $this->conn = new mysqli('host.docker.internal', 'root', 'root', 'hive', 3306);
        }
        return $this->conn;
    }
}
