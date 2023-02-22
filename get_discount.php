<?php

header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 0);
$nxsh = $_POST["nxsh"];
$cid = $_POST["cid"];
$tolken = "sk_test_1x1_4d6291727cece28a966025aaefa1503b6853a2698b6be6d0707c1192dcae45dd";
$version = "2021-11";


$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rechargeapps.com/charges?status=queued&customer_id=$cid&scheduled_at=$nxsh",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version"
  ),
));

$response = curl_exec($curl);


curl_close($curl);
$obj = json_decode($response, true);

$discode  = ($obj["charges"][0]["discounts"][0]["code"]);
echo $discode;