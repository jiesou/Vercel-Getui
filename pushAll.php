<?php
require_once 'getui-pushapi-php-client-v2/GTClient.php';

// body
$body = file_get_contents('php://input');
$body = json_decode($body, true);

// Notification
$notify = new GTNotification();
$notify->setTitle($body["title"]);
$notify->setBody($body["body"]);
if (isset($body["bigText"]))  $notify->setBigText($body["bigText"]);
if (isset($body["bigImage"])) $notify->setBigImage($body["bigImage"]);

if (isset($body["logo"])) $notify->setLogo($body["logo"]);
if (isset($body["logoURL"])) $notify->setLogoUrl($body["logoURL"]);
if (isset($body["channelId"])) $notify->setChannelId($body["channelId"]);

if (isset($body["click"][0])) {
    $clickType = $body["click"][0];
} elseif (isset($body["click"])) {
    $clickType = $body["click"];
} else {
    $clickType = "none";
}

$notify->setClickType($clickType);
if ($clickType == "intent") $notify->setIntent($body["click"][1]);
if ($clickType == "url") $notify->setUrl($body["click"][1]);
if ($clickType == "payload" or $clickType == "payload_custom") $notify->setPayload($body["click"][1]);

// Push
$push = new GTPushRequest();
$push->setRequestId(micro_time());

// Message
$message = new GTPushMessage();

// Client
$client = new GTClient("https://restapi.getui.com", $_SERVER['HTTP_APPKEY'], $_SERVER['HTTP_APPID'], $_SERVER['HTTP_MASTERSECRET']);

$message->setNotification($notify);
$push->setPushMessage($message);

echo json_encode($client->pushApi()->pushAll($push));

function micro_time()
{
    list($usec, $sec) = explode(" ", microtime());
    $time = ($sec . substr($usec, 2, 3));
    return $time;
}
