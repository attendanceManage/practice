<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
require_once 'autoload.php';
require_once '../class/Curl.php';
require_once '../core/constant.php';

$city = "tallinn";
if (!empty($_GET["city"])) {
    $city = $_GET["city"];
}

$apiKey = APIKEY;
$apiUrl = "api.openweathermap.org/data/2.5/forecast?q=" . $city . "&appid=" . $apiKey;

$curl = new Curl($apiUrl);
$curl->init();
$curl->setOption(CURLOPT_URL, $apiUrl);
$curl->setOption(CURLOPT_RETURNTRANSFER, true);

$curl->decode();
$response = $curl->fetch();
$curl->close();

$availableClearSky = [];
$arrayAvailableClearSky['response'] = [];
$arrayAvailableClearSky['response']['code'] = [];
$arrayAvailableClearSky['response']['data'] = [];

if (!empty($response)) {
    foreach ($response['list'] as $key => $value) {
        if (!empty($value['weather'][0]) &&
            $value['weather'][0]['description'] == 'clear sky') {
            $availableClearSky['weather'][] = $value;
        } else {
            $arrayAvailableClearSky['response']['code'] = 404;
            $arrayAvailableClearSky['response']['data'] = [];
            $arrayAvailableClearSky['response']['message'] = 'data not found';
        }
    }

    if (!empty($response['city'])) {
        $availableClearSky['city'][] = $response['city'];
    }
    $arrayAvailableClearSky['response']['code'] = 200;
    $arrayAvailableClearSky['response']['message'] = 'weather successfully!';
    array_push($arrayAvailableClearSky['response']['data'], $availableClearSky);
    echo json_encode($arrayAvailableClearSky);
}




