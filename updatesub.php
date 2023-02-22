<?php
header('Access-Control-Allow-Origin: *');

$tolken = "sk_test_1x1_4d6291727cece28a966025aaefa1503b6853a2698b6be6d0707c1192dcae45dd";
$version = "2021-11";

$ptile = $_POST["ptile"];
$qty = $_POST["qty"];
$subid = $_POST["subid"];
$cid = $_POST["cid"];
$email = $_POST["email"];
$nxt = $_POST["nxt"];
$addid= $_POST["addid"];
$frqm = $_POST["frqm"];
$frqt = $_POST["frqt"];
$pid = $_POST["pid"];
$vid = $_POST["vid"];

$address1 =$_POST["address1"];
$address2 =$_POST["address2"];
$city =$_POST["city"];
$company =$_POST["company"];
$country_code =$_POST["country_code"];
$first_name =$_POST["first_name"];
$last_name =$_POST["last_name"];
$phone =$_POST["phone"];
$province =$_POST["province"];
$zip =$_POST["zip"];

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rechargeapps.com/subscriptions/$subid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS =>'{"quantity": "'.$qty.'","charge_interval_frequency":"'.$frqm.'","order_interval_frequency":"'.$frqm.'","order_interval_unit":"'.$frqt.'","external_product_id": {"ecommerce": "'.$pid.'" },"external_variant_id": {"ecommerce": "'.$vid.'"},"product_title":"'.$ptile.'"}',
  CURLOPT_HTTPHEADER => array(
    "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);
echo "Subscription Updated Successfully";
curl_close($curl);

$curl2 = curl_init();
curl_setopt_array($curl2, array(
  CURLOPT_URL => "https://api.rechargeapps.com/customers/$cid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS =>'{"email": "'.$email.'"}',
  CURLOPT_HTTPHEADER => array(
    "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
    'Content-Type: application/json'
  ),
));

$response2 = curl_exec($curl2);

curl_close($curl2);
echo $response2;


$curl3 = curl_init();
curl_setopt_array($curl3, array(
  CURLOPT_URL => "https://api.rechargeapps.com/subscriptions/$subid/set_next_charge_date",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"date": "'.$nxt.'"}',
  CURLOPT_HTTPHEADER => array(
    "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
    'Content-Type: application/json'
  ),
));

$response3 = curl_exec($curl3);

curl_close($curl3);
echo $response3;

$curl4 = curl_init();
curl_setopt_array($curl4, array(
  CURLOPT_URL => "https://api.rechargeapps.com/addresses/$addid",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'PUT',
  CURLOPT_POSTFIELDS =>'{"address1": "'.$address1.'","address2":"'.$address2.'","city":"'.$city.'","company":"'.$company.'","country_code":"'.$country_code.'","first_name":"'.$first_name.'","last_name":"'.$last_name.'","phone":"'.$phone.'","province":"'.$province.'","zip":"'.$zip.'"}',
  CURLOPT_HTTPHEADER => array(
    "X-Recharge-Access-Token: $tolken",
    "X-Recharge-Version: $version",
    'Content-Type: application/json'
  ),
));

$response4 = curl_exec($curl4);

curl_close($curl4);
echo $response4;
?>


