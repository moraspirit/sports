<?php

/**
 * @author Chathura Widanage <chathurawidanage@gmail.com>
 */
include_once '../lib/sms/SmsReceiver.php';
include_once '../lib/sms/SmsSender.php';
include_once 'log.php';
include_once 'global.inc.php';
include_once '../ScoreUtilities.php';
ini_set('error_log', '../logs/sms-app-error.log');

try {
    $receiver = new SmsReceiver();

    $content = $receiver->getMessage(); // get the message content
    $address = $receiver->getAddress(); // get the sender's address
    $requestId = $receiver->getRequestID(); // get the request ID
    $applicationId = $receiver->getApplicationId(); // get application ID
    $encoding = $receiver->getEncoding(); // get the encoding value
    $version = $receiver->getVersion(); // get the version

    logFile("[ content=$content, address=$address, requestId=$requestId, applicationId=$applicationId, encoding=$encoding, version=$version ]");


    $responseMsg = "";
    //registering new users
    $requestQry = explode(" ", $content);
    $command = $requestQry[1];



    switch ($command) {
        case "scr":
            $uni = $requestQry[2];
            $game = $requestQry[3];
            $cat = $requestQry[4];
            $score = $requestQry[5];
            $addScore = addScore($game, $uni, $cat, $score);

            if ($addScore > 0) {
                $responseMsg = "Score added successfully. $addScore is the entry id.";
            } else {
                $entry = getEntryID($game, $uni, $cat);
                $scr = $entry['score'];
                $eid = $entry['id'];
                $responseMsg = "This score already exists as $scr. Use entry id $eid to update.";
            }
            //reg new user
            break;

        case "upd":
            $eid = $requestQry[2];
            $scr = $requestQry[3];
            updateScore($eid, $scr);
            $responseMsg = "Entry $eid was updated.";
            break;
        default:
            $responseMsg = "Incorrect Messsage";
            break;
    }





    //our code goes here

    $sender = new SmsSender($SMS_SENDER);
    //sending a one message
    $applicationId = $APP_ID;
    $password = $PASSWORD;
    $sourceAddress = "77100";
    $deliveryStatusRequest = "0";
    $charging_amount = ":15.75";
    $destinationAddresses = array();
    array_push($destinationAddresses, $address);
    $binary_header = "";
    $res = $sender->sms($responseMsg, $destinationAddresses, $password, $applicationId, $sourceAddress, $deliveryStatusRequest, $charging_amount, $encoding, $version, $binary_header);
    error_log("Response :".$res);
} catch (SmsException $ex) {
    //throws when failed sending or receiving the sms
    error_log("ERROR: {$ex->getStatusCode()} | {$ex->getStatusMessage()}");
}
?>