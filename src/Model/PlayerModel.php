<?php
namespace Task\Ipl\Model;

class PlayerModel
{
    public const SELECTED_IN_PLAYING_XI = '1';
    public const NOT_SELECTED_IN_PLAYING_XI = '0';
    public const PLAYER_DELETED = '1';
    public const PLAYER_NOT_DELETED = '0';

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
        $deleteStatus = PlayerModel::PLAYER_NOT_DELETED;
        $allPlayersStmt = $this->conn->prepare("SELECT * from players where isPlayingXi = ? and isDeleted = ?");
        $allPlayersStmt->bind_param("ss", $status, $deleteStatus);
        $allPlayersStmt->execute();
        $allPlayers = $allPlayersStmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $allPlayers;
    }

    public function addPlayer(string $playerName, int $jerseyNo, string $playerType) : bool
    {
        $status = PlayerModel::NOT_SELECTED_IN_PLAYING_XI;
        $deleteStatus = PlayerModel::PLAYER_NOT_DELETED;
        $addNewPlayerStmt = $this->conn->prepare("INSERT INTO players(name, type, jersey_no, isPlayingXi, isDeleted) values (? ,?, ?, ?, ?)");
        $addNewPlayerStmt->bind_param("ssiss", $playerName, $playerType, $jerseyNo, $status, $deleteStatus);
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
        $updatePlayerstmt->bind_param("si", $selectedStatus, $playerId);
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
        $deleteStatus = PlayerModel::PLAYER_NOT_DELETED;
        $playingXiPlayers = $this->conn->prepare("SELECT * from players where isPlayingXI = ? and isDeleted = ?");
        $playingXiPlayers->bind_param("ss", $status, $deleteStatus);
        $playingXiPlayers->execute();
        $playerList = $playingXiPlayers->get_result()->fetch_all(MYSQLI_ASSOC);
        return $playerList;
    }

    public function removePlayerFromPlayingXi(int $playerId) : bool
    {
        $selectedStatus = PlayerModel::NOT_SELECTED_IN_PLAYING_XI;
        $removePlayerStmt = $this->conn->prepare("UPDATE players set isPlayingXi = ? where id = ?");
        $removePlayerStmt->bind_param("si", $selectedStatus, $playerId);
        $removePlayerStmt->execute();
        if ($removePlayerStmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }

    }

    public function removePlayerFromSquad(int $playerId) : bool
    {
        $deleteStatus = PlayerModel::PLAYER_DELETED;
        $deletePlayerStmt = $this->conn->prepare("UPDATE players set isDeleted = ? where id = ?");
        $deletePlayerStmt->bind_param("si", $deleteStatus, $playerId);
        $deletePlayerStmt->execute();
        if ($deletePlayerStmt->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addScore(array $idsAndScores)
    {
        foreach ($idsAndScores as $id => $score) {
            $addScoreRst = $this->conn->prepare("UPDATE players set score = ? where id = ?");
            $addScoreRst->bind_param("ii", $score, $id);
            $addScoreRst->execute();
        }
        return true;
    }
}