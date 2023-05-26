<?php
use Task\Ipl\DBconnection\Db;
use Task\Ipl\Controller\PlayerController;
use Task\Ipl\Model\playerModel;
require_once __DIR__ . '/../../vendor/autoload.php';

$db = new Db();
$conn = $db->getConnection();
$pModelObj = new playerModel($conn);
$pControllerObj = new PlayerController($pModelObj);

if (isset($_POST['action']) && isset($_POST['playerId'])) {
    $playerId = $_POST['playerId'];
    $addResult = $pControllerObj->addPlayerInPlayingXI($playerId);
    echo $addResult;
}

if (isset($_POST['removePlayerFromPlayingXi']) && $_POST['removePlayerFromPlayingXi'] == 1) {
    $playerId = (int)$_POST['playerId'];
    $removeResult = $pControllerObj->removePlayerFromPlayingXi($playerId);
    echo $removeResult;
}