<?php
header('Access-Control-Allow-Origin: *');
$address_id = $_POST["address_id"];
$variant_id = $_POST["variant_id"];
$date = $_POST["date"];
$title = $_POST["title"];
$tolken = "sk_test_1x1_4d6291727cece28a966025aaefa1503b6853a2698b6be6d0707c1192dcae45dd";
$version = "2021-11";


$curl = curl_init();
$data = [
        "address_id" =>$address_id ,
        "next_charge_scheduled_at"=>$date,
        "product_title"=>$title,
        "quantity"=>1,
        "external_variant_id" => ["ecommerce" =>$variant_id ]
];

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.rechargeapps.com/onetimes',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => json_encode($data),
  CURLOPT_HTTPHEADER => array(
    'X-Recharge-Access-Token: '.$tolken,
    'X-Recharge-Version: '.$version,
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


?>


