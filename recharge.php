<?php
header('Access-Control-Allow-Origin: *');
ini_set('display_errors', 0);

$email = $_POST["email"];
$tolken = "sk_test_1x1_4d6291727cece28a966025aaefa1503b6853a2698b6be6d0707c1192dcae45dd";
$version = "2021-11";
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rechargeapps.com/customers?email=$email",
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
//var_dump(json_decode($response, true));
$obj = json_decode($response, true);

$cid = ($obj["customers"][0]["id"]);
$cmail = ($obj["customers"][0]["email"]);
$hash = ($obj["customers"][0]["hash"]);
$curl2 = curl_init();

curl_setopt_array($curl2, array(
  CURLOPT_URL => "https://api.rechargeapps.com/subscriptions?customer_id=$cid",
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

$response2 = curl_exec($curl2);

curl_close($curl2);
$obj2 = json_decode($response2, true);
$totalsub = ($obj2["subscriptions"]);
$subcount = count($totalsub);

for ($i = 0; $i <= $subcount-1; $i++) {
  $subid = $obj2["subscriptions"][$i]["id"];
  $subprotitle = $obj2["subscriptions"][$i]["product_title"];
  $subqty = $obj2["subscriptions"][$i]["quantity"];
  $nextdel = $obj2["subscriptions"][$i]["next_charge_scheduled_at"];
  $frq = $obj2["subscriptions"][$i]["order_interval_frequency"];
  $date = ($obj2["subscriptions"][$i]["order_interval_unit"]);
  $address = $obj2["subscriptions"][$i]["address_id"];
  $substatus = $obj2["subscriptions"][$i]["status"];
  
  $curl3 = curl_init();

  curl_setopt_array($curl3, array(
      CURLOPT_URL => "https://api.rechargeapps.com/addresses/$address",
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
    
    $response3 = curl_exec($curl3);
    curl_close($curl3);
    $obj3 = json_decode($response3, true);
    $taddr = $obj3['address'];
    $pymtid = $obj3['payment_method_id'];
    $address1 = $taddr['address1'];
    $address2 = $taddr['address2'];
    $city = $taddr['city'];
    $company = $taddr['company'];
    $country_code = $taddr['country_code'];
    $first_name = $taddr['first_name'];
    $last_name = $taddr['last_name'];
    $phone = $taddr['phone'];
    $province = $taddr['province'];
    $zip = $taddr['zip'];

   echo '<div class="content" substatus='.$substatus.' cid='.$cid.' has='.$hash.' pymtid='.$pymtid.'>
   <div class="title">'.$subprotitle.'</div>
   <div class="qty">Quantity: <span>'.$subqty.'</span></div>
   <div class="frq">Frequency: Every <span>'.$frq.' '.$date.'</span></div>
   <div class="nxtdel">Next Delivery: <span id="nxtdelv">'.$nextdel.' </span></div>
 <input id="totaladd" zip="'.$zip.'" province="'.$province.'" phone="'.$phone.'" last_name="'.$last_name.'" first_name="'.$first_name.'" country_code="'.$country_code.'" company="'.$company.'" city="'.$city.'" address2="'.$address2.'" address1="'.$address1.'" value="'.$address1.','.$address2.','.$city.','.$company.','.$country_code.','.$first_name.','.$last_name.','.$phone.','.$province.','.$zip.'" hidden>
   <div class="action-btn active">
    <span class="manage_subs" addid="'.$address.'" subid="'.$subid.'" email="'.$cmail.'" dt="'.$nextdel.'">Manage</span>
    <span class="skip_next">Skip Next</span>
    <span class="send_now">Send now</span>
   </div>
   <div class="action-btn canceled">
    <span class="reactivate" addid="'.$address.'" subid="'.$subid.'" email="'.$cmail.'" dt="'.$nextdel.'">Reactivate</span>
   </div>
   </div>';
  
}
