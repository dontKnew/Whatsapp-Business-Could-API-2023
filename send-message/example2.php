<?php

$mobile_number = trim($pickup_data['consignee_contact']);
$name = ucwords(strtolower(trim($pickup_data['consignee'])));
$shipper_mobile_number = trim($pickup_data['contact_no']);
$shipper_name = ucwords(strtolower(trim($pickup_data['shipper_name'])));
$tracking_no = trim($pickup_data['air_waybill']);

$numbers = array($mobile_number, $shipper_mobile_number);
$names = array($name, $shipper_name);

$wp = new WP();
$wp->template_name = "rapidex_out_of_delivery";
$wp->dynamic_url_value = $tracking_no;
for($i = 0; $i < count($numbers); $i++){
    $wp->body_param = [$names[$i]];
    $wp->receiver_number = $numbers[$i];
    $wp->sendMessage();
    if($wp->response['status']==200 || empty($wp->response['error'])){

        if($names[$i]==$shipper_name){
            $msg = "Shipper - ".$wp->response['data'];
        }else if($names[$i]==$name) {
            $msg = "Consignee - ".$wp->response['data'];
        }

        if($i >= count($numbers)-1){
            echo "<script> alert('$msg'); window.history.back();</script>";
        }else {
            echo "<script> alert('$msg'); </script>";
        }

    }else {
        if($names[$i]==$shipper_name){
            $msg = "Shipper - ".$wp->response['error'];
        }else if($names[$i]==$name) {
            $msg = "Consignee - ".$wp->response['error'];
        }

        if($i >= count($numbers)-1){
            echo "<script> alert('$msg'); window.history.back();</script>";
        }else {
            echo "<script> alert('$msg'); </script>";
        }

    }

}