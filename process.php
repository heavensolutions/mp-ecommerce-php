
<?php
// SDK de Mercado Pago
require __DIR__ .  '/vendor/autoload.php';

$objDateTime = new DateTime('NOW');

// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-6317427424180639-042414-47e969706991d3a442922b0702a0da44-469485398');
MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");

$preference = new MercadoPago\Preference();

// item
$item = new MercadoPago\Item();
$item->title = $_POST['product_name'];
$item->description = "dispositivo móvile de Tienda e-commerce";
$item->unit_price = $_POST['product_price'];
$item->quantity = 1;
$item->picture_url = $_POST['img'];
$preference->items = array($item);

// payer
$payer = new MercadoPago\Payer();
$payer->name = $_POST['name'];
$payer->surname = $_POST['surname'];
$payer->email = $_POST['email'];
$payer->phone->area_code = $_POST['cod'];
$payer->phone->number = $_POST['tel'];
$payer->date_created = $objDateTime->format(DateTime::ISO8601);


$payer->address = array(
    "street_name" => $_POST['calle'],
    "street_number" => $_POST['calle_numero'],
    "zip_code" => $_POST['cp']
);
$preference->payer = $payer;

$preference->payment_methods->excluded_payment_methods = array("id"=> "amex");
$preference->payment_methods->excluded_payment_types = array("id"=> "atm");
$preference->payment_methods->installments = 6;


// back urls
$preference->back_urls = array(
    "success" => "https://heavensolutions-mp-commerce.herokuapp.com/success.php",
    "failure" => "https://heavensolutions-mp-commerce.herokuapp.com/failure.php",
    "pending" => "https://heavensolutions-mp-commerce.herokuapp.com/pending.php"
);

$preference->auto_return = "approved";

$preference->notification_url = "https://heavensolutions-mp-commerce.herokuapp.com/ipn.php";

$preference->external_reference = "lucas.f.fuentes@gmail.com";



$preference->save();


header("Location:".$preference->init_point);

?>
