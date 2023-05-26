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