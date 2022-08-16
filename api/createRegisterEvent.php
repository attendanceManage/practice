<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:POST');
header('Content-Type: application/json');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Access-Control-Allow-Methods,Authorization,X-Requested-With');

require_once 'autoload.php';
require_once '../class/RegisterEvent.php';
require_once '../config/Database.php';
require_once '../core/constant.php';
require_once '../class/Curl.php';

$database = new Database();
$db = $database->connect();
//$listRegisterEventArray = [];
$registerEventCreate = new RegisterEvent($db);
$data = json_decode(file_get_contents("php://input"));
$errorMessage = [];
$error['error']['message'] = [];

if (empty($data->name)) {
    $errorMessage[] = "Name field is mandatory";

} else {
    if (!preg_match("/^[a-zA-Z\s]+$/", $data->name)) {
        $errorMessage[] = "Name must only contain letters!";
    }

    if (strlen($data->name) > 50) {
        $errorMessage[] = "Input is too long, maximum is 50 characters.";
    }
}

if (empty($data->email)) {
    $errorMessage[] = "Email field is mandatory";

} else {
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    if (!preg_match($regex, $data->email)) {
        $errorMessage[] = $data->email . " is an invalid email. Please try again.";
    }

    if (strlen($data->email) > 200) {
        $errorMessage[] = "Input is too long, maximum is 200 characters.";
    }
}
$apiKey = APIKEY;
$isSkyClear = false;
if (empty($data->date_time)) {
    $errorMessage[] = "Date And Time field is mandatory.";

} else {

    $sessionOneTimeRange = ['20:00:00', '21:00:00', '22:00:00'];
    $sessionTwoTimeRange = ['23:00:00', '24:00:00', '1:00:00'];
    $sessionThreeTimeRange = ['02:00:00', '03:00:00', '04:00:00'];
    $sessionFourTimeRange = ['05:00:00', '06:00:00', '07:00:00'];

    $date_now = date("Y-m-d H");
    $nextFiveDay = date("Y-m-d", strtotime(' +5 day'));
    $dateTime = explode(" ", $data->date_time);

    if (isset($dateTime[0])) {
        if (($dateTime[0] < $date_now) && $dateTime[0] <= $nextFiveDay) {
            $errorMessage[] = "date_time: " . "Date must be only next 5 days.";
        }
    }

    if (isset($dateTime[1])
        && (!in_array($dateTime[1], $sessionOneTimeRange)
            && !in_array($dateTime[1], $sessionTwoTimeRange)
            && !in_array($dateTime[1], $sessionThreeTimeRange)
            && !in_array($dateTime[1], $sessionFourTimeRange)
        )) {
        $errorMessage[] = "date_time:" . "Invalid time is given for session.";
    }
    // check if given date and time range sky is clear
}

if (empty($data->town)) {
    require_once '../core/constant.php';
    $errorMessage[] = "Town field is mandatory.";

} else {
    //
    $places = ['Tallinn', 'Tartu', 'Narva', 'Pärnu', 'Jõhvi', 'Jõgeva', 'Põlva', 'Valga'];
    if ((!in_array($data->town, $places))) {
        $errorMessage[] = "town:" . "Invalid place is provided.";
    } else {
        // check if given date and time range sky is clear
        $apiUrl = "api.openweathermap.org/data/2.5/forecast?q=" . $data->town . "&appid=" . $apiKey;
        $curl = new Curl($apiUrl);
        $curl->init();
        $curl->setOption(CURLOPT_URL, $apiUrl);
        $curl->setOption(CURLOPT_RETURNTRANSFER, true);
        $curl->decode();
        $response = $curl->fetch();
        $curl->close();
        // selected place and date time
        if (!empty($response)) {
            foreach ($response['list'] as $key => $value) {

                if (!empty($value['weather'][0]) &&
                    $value['weather'][0]['description'] == 'clear sky' && $value['dt_txt'] == $data->date_time) {
                    $isSkyClear = true;
                    echo $isSkyClear;
                }
            }
        }

    }
}


if ($isSkyClear == false) {
    $errorMessage[] = "Sky must be clear.";

}
array_push($error['error']['message'], $errorMessage);

if (count($errorMessage) > 0) {
    echo json_encode($error);
} else {

    $registerEventCreate->name = $data->name;
    $registerEventCreate->email = $data->email;
    $registerEventCreate->town = $data->town;
    $registerEventCreate->comment = $data->comment;
    $registerEventCreate->date_time = $data->date_time;

    if ($registerEventCreate->create()) {
        echo json_encode(
            array('message' => 'Register event created!')
        );
    } else {
        echo json_encode(
            array('message' => 'Register event not created!')
        );
    }
}

