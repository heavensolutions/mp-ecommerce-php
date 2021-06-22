<?php
require_once("vendor/autoload.php");
http_response_code(200);

MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

switch($_POST["type"]) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($_POST["id"]);
        break;
    case "plan":
        $plan = MercadoPago\Plan::find_by_id($_POST["id"]);
        break;
    case "subscription":
        $plan = MercadoPago\Subscription::find_by_id($_POST["id"]);
        break;
    case "invoice":
        $plan = MercadoPago\Invoice::find_by_id($_POST["id"]);
        break;
}

if ($payment->status == "approved") {
    
    $json = json_encode($payment);
    $arch = fopen("json.txt", "a+");
    fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] $json\n");
    fclose($arch);

    $json = json_encode($_POST);
    $arch = fopen("json.txt", "a+");
    fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] $json\n");
    fclose($arch);
    
}else{
    
        $arch = fopen("json.txt", "a+");
        fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] no guardo nada :)  \n");
        fclose($arch);

}