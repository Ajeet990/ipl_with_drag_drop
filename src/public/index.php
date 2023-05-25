<?php
use Task\Ipl\DBconnection\Db;
use Task\Ipl\Controller\PlayerController;
use Task\Ipl\Model\playerModel;


require_once __DIR__ . '/../../vendor/autoload.php';
$db = new Db();
$conn = $db->getConnection();
$pModelObj = new playerModel($conn);
$pControllerObj = new PlayerController($pModelObj);

$pControllerObj->getLandingPage();
if (isset($_POST['addNewPlayer'])) {
    $playerName = $_POST['playerName'];
    $jerseyNo = (int)$_POST['jerseyNo'];
    $playerType = $_POST['playerType'];
    $playerAddResult = $pControllerObj->addPlayer($playerName, $jerseyNo, $playerType);
}