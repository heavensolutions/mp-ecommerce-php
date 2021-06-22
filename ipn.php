<?php
require_once("vendor/autoload.php");

MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

switch($_GET["topic"]) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
        // Get the payment and the corresponding merchant_order reported by the IPN.
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($payment->order->id);
        break;
    case "merchant_order":
        $merchant_order = MercadoPago\MerchantOrder::find_by_id($_GET["id"]);
        break;
}

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