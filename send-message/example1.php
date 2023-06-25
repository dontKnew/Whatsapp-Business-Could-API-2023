<?php
include("WhatsappMessage.php");
use \WhatsappMessage\WhatsappMessage as WP;
$wp = new WP();
$wp->template_name = "rapidex_picked";
$numbers = array(916205881326,916205881326);
foreach ($numbers as $n){
    $wp->body_param = ["Sajid Ali"];
    $wp->receiver_number = $n;
    $wp->sendMessage();
    echo "<pre>";
    print_r(json_encode($wp->response, JSON_PRETTY_PRINT));
    echo "</pre>";
}
$this->version = "v15.0"; /*default to latest version fb graph */
$this->phone_number_id = null;
$this->receiver_number = null;
$this->language = 'en_US';
$this->header_image_link  = null;
$this->template_name = null;
$this->token = null;
$this->body_param = [];
$this->dynamic_url_index = 0; /*default is zero*/
$this->dynamic_url_value = null;

$this->fbGraphURL = null;
$this->getData = [];
$this->$getBodyParam = [];

$this->response = [];






