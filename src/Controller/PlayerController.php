<?php
namespace Task\Ipl\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class PlayerController
{
    private $_loader;
    private $_twig;
    private $pModelObj;
    public function __construct($pModelObj)
    {
        $this->_loader = new FilesystemLoader(__DIR__ . '/../templates');
        $this->_twig = new Environment($this->_loader);
        $this->pModelObj = $pModelObj;
    }

    public function getLandingPage()
    {
        $allSquadPlayers = $this->pModelObj->getSquadPlayers();
        $allPlayingXIPlayers = $this->pModelObj->getPlayingXIPlayers();
        echo $this->_twig->render(
            'playerList.html.twig',
            ['squadPlayers' => $allSquadPlayers, 'playingXI' => $allPlayingXIPlayers]
        );
    }

    public function addPlayer(string $playerName, int $jerseyNo, string $playerType)
    {
        $addResult = $this->pModelObj->addPlayer($playerName, $jerseyNo, $playerType);
        if ($addResult) {
            return true;
            // $color = "success";
            // $message = "Player Added Sucessfully.";
            // echo $this->_twig->render("showMessage.html.twig", ['color' => $color, 'message' => $message]);
        } else {
            return false;
        }
    }

    public function addPlayerInPlayingXI(int $playerId)
    {
        $addRst = $this->pModelObj->addPlayerInPlayingXI($playerId);
        if ($addRst) {
            $playingXISquad = $this->pModelObj->getPlayingXIplayers();
            if (count($playingXISquad) > 0) {
                return $this->_twig->render("playingXiList.html.twig", ['playingXi' => $playingXISquad]);
            } else {
                return "No players are in Playing XI list.";
            }
        } else {
            return "Something went wrong or player already added in playing XI list.";
        }
    }

    public function removePlayerFromPlayingXi(int $playerId)
    {
        $removeRst = $this->pModelObj->removePlayerFromPlayingXi($playerId);
        if ($removeRst) {
            $allPlayingXIPlayers = $this->pModelObj->getPlayingXIplayers();
            return $this->_twig->render('playingXIList.html.twig', ['playingXi' => $allPlayingXIPlayers]);
        }
    }
    public function removePlayerFromSquad(int $playerId)
    {
        $removeRst = $this->pModelObj->removePlayerFromSquad($playerId);
        if ($removeRst) {
            return true;
        } else {
            return false;
        }
    }

    public function addScores(array $idsAndScores)
    {
        if (count($idsAndScores) < 1) {
            return;
        }
        $addScoreResult = $this->pModelObj->addScore($idsAndScores);
        return $addScoreResult;
    }
}