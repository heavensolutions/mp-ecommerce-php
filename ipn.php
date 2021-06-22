<?php
require_once("vendor/autoload.php");
http_response_code(200);
MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');

$arch = fopen("json.txt", "a+");


$input = file_get_contents('php://input');
fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] POST (file_get_contents):  $input\n");


$data = json_encode($input);
fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] POST (json encode):  $data\n");


$data = json_decode($input);
fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] POST (json decode):  $data\n");


$data = json_encode(parse_str($_SERVER['QUERY_STRING']));
fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] QUERY STRING:  $data\n");

switch ($_GET["type"]) {
    case "payment":
        $payment = MercadoPago\Payment::find_by_id($_GET["id"]);
        break;
    case "plan":
        $plan = MercadoPago\Plan::find_by_id($_GET["id"]);
        break;
    case "subscription":
        $plan = MercadoPago\Subscription::find_by_id($_GET["id"]);
        break;
    case "invoice":
        $plan = MercadoPago\Invoice::find_by_id($_GET["id"]);
        break;
}

if ($payment->status == "approved") {

    $payment = json_encode($payment);
    fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] payment: $payment\n");
    
} else {

    fwrite($arch, "[" . date("Y-m-d H:i:s.u") . "] payment status:  $payment->status  \n");
}

fclose($arch);