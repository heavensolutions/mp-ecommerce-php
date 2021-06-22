<?php
require_once("vendor/autoload.php");

MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

if ($payment->status == "approved") {
    
    http_response_code(200);
    $json = json_encode($payment);
    $arch = fopen("json.txt", "a+");
    fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] $json\n");
    fclose($arch);
    
}else{
    
        $arch = fopen("json.txt", "a+");
        fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] no guardé nada :)  \n");
        fclose($arch);

}

