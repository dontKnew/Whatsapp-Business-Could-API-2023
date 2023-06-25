<?php
/*require 'vendor/autoload.php';

define('STDOUT', fopen('response.txt', 'w'));

use Netflie\WhatsAppCloudApi\WebHook;


$payload = file_get_contents('php://input');
fwrite(STDOUT, print_r($payload, true) . "\n");

// Instantiate the Webhook super class.
$webhook = new WebHook();

fwrite(STDOUT, print_r($webhook->read(json_decode($payload, true)), true) . "\n");*/


// above 

$requestData = file_get_contents('php://input');
file_put_contents("response.txt", $requestData);
$requestData = json_decode($requestData, true);
