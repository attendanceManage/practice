<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once 'autoload.php';
require_once '../config/Database.php';
require_once '../class/RegisterEvent.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$database = new Database();
$db = $database->connect();
$listRegisterEventArray = [];
$listRegisterEvent = new RegisterEvent($db);
$result = $listRegisterEvent->read();
$number = $result->rowCount();
$listRegisterEventArrayList['response'] = [];
$listRegisterEventArrayList['response']['code'] = [];
$listRegisterEventArrayList['response']['data'] = [];

if ($number > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $listRegisterEventVal = array(
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'town' => $town,
            'date_time' => $date_time,
            'comment' => $comment,
        );
        $listRegisterEventArrayList['response']['code'] = 200;
        $listRegisterEventArrayList['response']['message'] = 'weather successfully!';
        array_push($listRegisterEventArrayList['response']['data'], $listRegisterEventVal);
    }

} else {
    $listRegisterEventArrayList['response']['code'] = 404;
    $listRegisterEventArrayList['response']['message'] = 'data not found';
    $listRegisterEventArrayList['response']['data'] = [];
}

echo json_encode($listRegisterEventArrayList);
