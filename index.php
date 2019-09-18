<?php
/**
 * Created by PhpStorm.
 * User: Christian Pippert
 * Date: 07.11.2018
 * Time: 09:19
 */

require_once('class.service.php');
include('lib/log4php/Logger.php');
$config = include_once ('config.php');

$alertArray = [
    "priority"=>1,
    "type"=> "",
    "text"=> "",
    "address"=> "",
    "vehicle" => ""
];
Logger::configure('config_log4php.xml');
$logger = Logger::getLogger('diveraLogger');


/**
 * First Gate: Request must be a POST request
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $entityBodyJson = file_get_contents('php://input');
    $entityBodyArray = json_decode($entityBodyJson, true);
    $logger->info("DIVERA input to script: " . $entityBodyJson);
    /**
     * Second Gate: If the field address is filled out in the request data. It should be a loop request. By default
     * the address field is empty.
     * Second condition ist that the group can't be empty. Reason is when you crate a alert inside Divera only for
     * testing and select a spezific user, the group is empty. A empty group indicated die group ALL. So everybody
     * get's this alert.
     */
    if($entityBodyArray['address'] == "" && !empty($entityBodyArray['group'])){
        $text = explode("*", $entityBodyArray['text']);

        /**
         * Third Gate: The message from Operation Center should have 4 peaces
         * Example: S23*B190105124*H1Y*CRUMBACH CRUMBACHER STRASSE 85 LOHFELDEN otherwise it is not a valid alarm.
         */
        if(count($text) == 4){
            $logger->info("Alarm: " . $entityBodyArray['text']);
            $service = new service();

            $alertArray["type"]     = $service->getAlarmType($text[2], $config['alarmKeywords'], $config['maxStrLenType']);
            $alertArray["text"]     = $service->getAlarmText($text[2], $config['alarmKeywords'])." ".$entityBodyArray["text"];
            $alertArray["address"]  = $service->formatAddress($text[3], $config['districts']);
            $alertArray["vehicle"]  = $service->getVehicle($text[2], $config['alarmKeywords']);

            $alertJson = json_encode($alertArray);
            $logger->info("Request to DIVERA: " . $alertJson);

            $ch = curl_init($config['diveraUrl']);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, utf8_decode($alertJson));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    'Content-Type: application/json',
                    'Content-Length: ' . strlen($alertJson))
            );
            $result = curl_exec($ch);

            if($result){
                $logger->info("Alarm successfully delivered: " . json_encode($result));
            }
            else{
                $logger->error(curl_error($ch));
            }
            curl_close($ch);
        }
        else{
            $logger->error('Message of Operation Center corrupted ' .  $entityBodyArray['text']);
        }
    }
    else {
        if($entityBodyArray['address'] == "")
            $logger->warn("Response address has content ".$entityBodyArray['address'] );
        else
            $logger->warn("Group as no content: ".$entityBodyArray['group']. "No group selected" );
    }
}
else {
    $logger->warn("No POST Request");
}


