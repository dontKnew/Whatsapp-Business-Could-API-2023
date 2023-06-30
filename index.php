<?php

// Require the Composer autoloader.
require 'vendor/autoload.php';
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;
use Netflie\WhatsAppCloudApi\Message\Media\LinkID;
use Netflie\WhatsAppCloudApi\Message\Contact\ContactName;
use Netflie\WhatsAppCloudApi\Message\Contact\Phone;
use Netflie\WhatsAppCloudApi\Message\Contact\PhoneType;

use Netflie\WhatsAppCloudApi\Message\OptionsList\Row;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Section;
use Netflie\WhatsAppCloudApi\Message\OptionsList\Action;

// Instantiate the WhatsAppCloudApi super class.
$whatsapp_cloud_api = new WhatsAppCloudApi([
    'from_phone_number_id' => '',
    'access_token' => '',
]);

try {

    $whatsapp_cloud_api->sendTemplate('916205881326', 'hello_world', 'en_US');
   // $whatsapp_cloud_api->sendTextMessage('916205881326', 'hello its workinng ?');

    /*$document_link = 'https://i.ytimg.com/vi/0jIQK3GvmDk/hqdefault.jpg';
    $link_id = new LinkID($document_link);
    $whatsapp_cloud_api->sendDocument('916205881326', $link_id, "Document", "caption of document");*/

    /*$link_id = new LinkID('https://i.ytimg.com/vi/0jIQK3GvmDk/hqdefault.jpg');
    $whatsapp_cloud_api->sendImage('916205881326', $link_id);*/

    /*$name = new ContactName('Sajid', 'Ali');
    $phone = new Phone('7065221377', PhoneType::CELL());
    $whatsapp_cloud_api->sendContact('916205881326', $name, $phone);*/


    /*$rows = [
        new Row('1', '⭐️', "Experience wasn't good enough"),
        new Row('2', '⭐⭐️', "Experience could be better"),
        new Row('3', '⭐⭐⭐️', "Experience was ok"),
        new Row('4', '⭐⭐️⭐⭐', "Experience was good"),
        new Row('5', '⭐⭐️⭐⭐⭐️', "Experience was excellent"),
    ];
    $sections = [new Section('Stars', $rows)];
    $action = new Action('Submit', $sections);

    $whatsapp_cloud_api->sendList(
        '916205881326',
        'Rate your experience',
        'Please consider rating your shopping experience in our website',
        'Thanks for your time',
        $action
    );*/

    /*Media messages accept as identifiers an Internet URL pointing to a public resource (image, video, audio, etc.). When you try to send a media message from a URL you must instantiate the LinkID object.
     * $response = $whatsapp_cloud_api->uploadMedia('my-image.png');
    $media_id = new MediaObjectID($response->decodedBody()['id']);
    $whatsapp_cloud_api->sendImage('<destination-phone-number>', $media_id);*/

} catch (\Netflie\WhatsAppCloudApi\Response\ResponseException $e) {
	     echo "<pre>";
	    print_r($e->response()); // You can still check the Response returned from Meta servers
	     echo "</pre>";
}

