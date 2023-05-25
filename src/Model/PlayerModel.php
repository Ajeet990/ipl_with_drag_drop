<?php
namespace Task\Ipl\Model;

class PlayerModel
{
    public const SELECTED_IN_PLAYING_XI = 1;
    public const NOT_SELECTED_IN_PLAYING_XI = 0;

    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // public function getAllPlayers()
    // {
    //     $allPlayersStmt = $this->conn->prepare("SELECT * from players");
    //     $allPlayersStmt->execute();
    //     $allPlayers = $allPlayersStmt->get_result()->fetch_all(MYSQLI_ASSOC);
    //     return $allPlayers;
    // }
    public function getSquadPlayers()
    {
        $status = PlayerModel::NOT_SELECTED_IN_PLAYING_XI;
        $allPlayersStmt = $this->conn->prepare("SELECT * from players where isPlayingXi = ?");
        $allPlayersStmt->bind_param("i", $status);
        $allPlayersStmt->execute();
        $allPlayers = $allPlayersStmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $allPlayers;
    }

    public function addPlayer(string $playerName, int $jerseyNo, string $playerType) : bool
    {
        $addNewPlayerStmt = $this->conn->prepare("INSERT INTO players(name, type, jersey_no) values (? ,?, ?)");
        $addNewPlayerStmt->bind_param("ssi", $playerName, $playerType, $jerseyNo);
        $addNewPlayerStmt->execute();
        if ($addNewPlayerStmt->insert_id > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addPlayerInPlayingXI(int $playerId) : bool
    {
        $selectedStatus = PlayerModel::SELECTED_IN_PLAYING_XI;
        $updatePlayerstmt = $this->conn->prepare("UPDATE players SET isPlayingXI = ? where id = ?");
        $updatePlayerstmt->bind_param("ii", $selectedStatus, $playerId);
        $updatePlayerstmt->execute();
        if ($updatePlayerstmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getPlayingXIplayers() : array
    {
        $status = PlayerModel::SELECTED_IN_PLAYING_XI;
        $playingXiPlayers = $this->conn->prepare("SELECT * from players where isPlayingXI = ?");
        $playingXiPlayers->bind_param("i", $status);
        $playingXiPlayers->execute();
        $playerList = $playingXiPlayers->get_result()->fetch_all(MYSQLI_ASSOC);
        return $playerList;
    }
}