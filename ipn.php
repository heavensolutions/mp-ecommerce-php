<?php
require_once("vendor/autoload.php");
http_response_code(200);

MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

if($payment->status == "approved"){
    echo json_encode($payment);
}

?>