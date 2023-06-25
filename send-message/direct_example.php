<?php
$data = [
    "messaging_product" => "whatsapp",
    "to" => 917053876423,
    "type" => "template",
    "template" => [
        "name" => "rapidex_tracking",
        "language" => [
            "code" => "en_US"
        ],
        "components"=>[
            [
                "type"=>"header",
                "parameters"=>[
                    ["type"=>"image", "image"=>["link"=>"https://rapidexworldwide.com/admin/assets/rapidexlogo.jpg"]]
                ]
            ],
            [
                "type"=>"body",
                "parameters"=>[
                    ["type"=>"text", "text"=>"Laxman Kumar"]
                ]
            ],
            [
                "type"=>"button",
                "sub_type"=>"url",
                "index"=>0,
                "parameters"=>[
                    ["type"=>"text", "text"=>"tracking-status.php?id=5118082202"]
                ]
            ]
        ]
    ]
];

$data1 = json_encode($data);
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://graph.facebook.com/v15.0/100995949490042/messages",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data1,
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer token",
        "Content-Type: application/json"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    $error = ["error"=>$err];
    $response = false;
} else {
    $data = json_decode($response);
    if(isset($data->messages)){
        $response = true;
    }else {
        $response = false;
    }
}
/*
 * RESPONSE MESSAGE
    {"messaging_product":"whatsapp","contacts":[{"input":"917503370409","wa_id":"917503370409"}],"messages":[{"id":"wamid.HBgMOTE3NTAzMzcwNDA5FQIAERgSODMxNTJCQ0EwOTA1MjEzQUQ2AA=="}]}

 * error message
    {"error":{"message":"(#131009) Parameter value is not valid","type":"OAuthException","code":131009,"error_data":{"messaging_product":"whatsapp","details":"Parameter Invalid"},"error_subcode":2494010,"fbtrace_id":"AwvTgGtlIzl7O7UIT-fveNU"}}

*/
