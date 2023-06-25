<?php

namespace WhatsappMessage;

    class WhatsappMessage
    {
        public $version = "v15.0"; /*default to latest version fb graph */
        public $phone_number_id = null;
        public $receiver_number = null;
        public $language = 'en_US';
        public $header_image_link  = null;
        public $template_name = null;
        public $token = null;
        public $body_param = [];
        public $dynamic_url_index = 0; /*default is zero*/
        public $dynamic_url_value = null;

        public $fbGraphURL = null;
        public $getData = [];
        private $getBodyParam = [];

        public $response = [];

        public function __construct(){
            $this->setDefaultValue();/*set default message value*/
            $this->fbGraphURL = "https://graph.facebook.com/$this->version/$this->phone_number_id/messages";
        }


        private function setDefaultValue(){
            $this->phone_number_id = 101482536130698;
            $this->receiver_number = 916205881326;
            $this->language = 'en_US';
            $this->header_image_link  = 'https://rapidexworldwide.com/assets/logo_Rapidex.jpg';
            $this->template_name = 'hello_world';
            $this->token = '';
            $this->body_param = array("User");
            $this->dynamic_url_index = 0;
            $this->dynamic_url_value = "tracking-status.php?id=$this->dynamic_url_value";
        }

        private function setBodyParam(){
            if(isset($this->body_param)){
                foreach ($this->body_param as $key=>$value) {
                     $this->getBodyParam[$key] = ["type" => "text", "text" => $value];
                }
            }
        }
        private function setData(){
                $this->getData =  [
                    "messaging_product" => "whatsapp",
                    "to" =>$this->receiver_number,
                    "type" => "template",
                    "template" => [
                        "name" => $this->template_name,
                        "language" => [
                            "code" => $this->language
                        ],
                        "components"=>[
                            [
                                "type"=>"header",
                                "parameters"=>[
                                    ["type"=>"image", "image"=>["link"=>$this->header_image_link]]
                                ]
                            ],
                            [
                                "type"=>"body",
                                "parameters"=> $this->getBodyParam
                            ],
                            [
                                "type"=>"button",
                                "sub_type"=>"url",
                                "index"=>$this->dynamic_url_index,
                                "parameters"=>[
                                    ["type"=>"text", "text"=>$this->dynamic_url_value]
                                ]
                            ]
                        ]
                    ]
                ];
        }

        public function sendMessage(){
            $this->setBodyParam();
            $this->setData();
            if(isset($this->body_param) && isset($this->getData)) {
                try {
                    $data = json_encode($this->getData);
                    $curl = curl_init();
                    curl_setopt_array($curl, [
                        CURLOPT_URL => $this->fbGraphURL,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 30,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => $data,
                        CURLOPT_HTTPHEADER => [
                            "Authorization: Bearer $this->token",
                            "Content-Type: application/json"
                        ],
                    ]);
                    $response = curl_exec($curl);
                    $err = curl_error($curl);
                    curl_close($curl);
                    $this->errorHandle($err, $response);

                }catch(Exception $e){
                    $this->response['error'] =  $e->getMessage();
                    $this->response['status'] = 500;
                }
            }else {
                $this->response['error'] = "Required to all fields of parameters variable";
                $this->response['status'] = 404;
            }
        }

        private function errorHandle($err, $response){
            if($err){
                $this->response['error'] = $err;
                $this->response['status'] = 501;
            }else {
                $response =  json_decode($response);
                if(!empty($response->error)){
                    $this->response['error'] = $response->error->error_data->details;
                    $this->response['status'] = 400;
                }else if (!empty($response->messages)){
                    $this->response['data'] = $response;
                    $this->response['status'] = 200;
                }else {
                    $this->response['data'] = "Something is wrong code side";
                    $this->response['server_response'] = $response;
                    $this->response['status'] = 502;
                }
            }

        }
    }