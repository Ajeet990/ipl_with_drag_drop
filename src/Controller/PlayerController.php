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
            $color = "success";
            $message = "Player Added Sucessfully.";
            echo $this->_twig->render("showMessage.html.twig", ['color' => $color, 'message' => $message]);
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
}