<?php
/*
 * 1. add callback url in webhook config
 * 2. add token in webhook config
 * 3. use this below code make sure its response 200 to validate
 * 4. now when you hit any event it will call webhook below code will handle it & you can see the output file_put_content to use..
 * */

$hubVerifyToken = 'my_token';
$accessToken = '';

// Verify the webhook
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['hub_challenge']) && isset($_GET['hub_verify_token']) && $_GET['hub_verify_token'] === $hubVerifyToken) {
    echo $_GET['hub_challenge'];
    exit;
}

// Handle the webhook event
$requestData = file_get_contents('php://input');
$requestData = json_decode($requestData, true);

if (!empty($requestData['entry'])) {

    foreach ($requestData['entry'] as $entry) {
        $changes = $entry['changes'];
        foreach ($changes as $change) {
            $field = $change['field'];
            $value = $change['value'];

            // Handle the event based on the field and value
            // You can write your own logic here
        }
    }
}

// Return a 200 OK response to acknowledge receipt of the event
http_response_code(200);
