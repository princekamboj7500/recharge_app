<?php
header('Access-Control-Allow-Origin: *');

$tolken = "sk_test_1x1_4d6291727cece28a966025aaefa1503b6853a2698b6be6d0707c1192dcae45dd";
$version = "2021-11";


$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://static.rechargecdn.com/store/rechargetestjenn.myshopify.com/product/2020-12/products.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'X-Recharge-Access-Token: '.$tolken,
    'X-Recharge-Version: '.$version
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;


?>


