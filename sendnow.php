<?php
header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 0);
$tolken = "";
$version = "2021-11";

$subid = $_POST["subid"];
$nxt = $_POST["nxt"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rechargeapps.com/charges?purchase_item_ids=$subid&status=queued&scheduled_at=$nxt",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
     "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$obj = json_decode($response, true);

$cid = ($obj["charges"][0]["id"]);


echo $cid;
$curl2 = curl_init();

curl_setopt_array($curl2, array(
  CURLOPT_URL => "https://api.rechargeapps.com/charges/$cid/process",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_HTTPHEADER => array(
     "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
    "Content-Type" => "application/json",
  ),
));

$response2 = curl_exec($curl2);

curl_close($curl2);

echo $response2;