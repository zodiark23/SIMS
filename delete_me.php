<?php

// header('Content-type: application/json');

$delivery_plu = $_POST["delivery_plu"];
$pickup_plu = $_POST["pickup_plu"];
$start_date = $_POST["start_date"];
$expire_date = $_POST["expire_date"];
$start_time = $_POST["start_time"];
$end_time = $_POST["end_time"];
$min_order = $_POST["min_order"];
$max_codes_allowed = $_POST["max_codes_allowed"];
$num_redeemable = $_POST["num_redeemable"];
$day_available = $_POST["day_available"];
$app_only = $_POST["app_only"];

$client_id = $_POST['client_id'];
// $client_id = escape_special($client_id);

$arr = $_POST;
$item_id = $arr["id"];

$number_of_codes = 10; //number of promo codes to be generated

// if(!isset($arr["day_available"])){
//     $a = array_merge($a, array("day_available" => "") );
    
// }

$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
$promo_code = '';

$max = strlen($characters) - 1;

$array = ["GG"];
$y=0;

//get all promotional_code of store using client_id
// $qry = mysql_query("SELECT promotional_code FROM promotional_code_manager WHERE client_id = '$client_id'", $server);

// while($row = mysql_fetch_array($qry, MYSQL_NUM))
//     {
//         $results[] = $row;
//     }

$results[] = ["GG"];
$results[] = ["G2"];

$currentCodes = call_user_func_array('array_merge', $results); //merge the result in fetched results
// echo json_encode($currentCodes);
$g = 0;
while($y < $number_of_codes){
    for ($i = 0; $i < 8; $i++) {
        $promo_code .= $characters[mt_rand(0, $max)];
    }
    if($g == 0){
        $g++;
        $promo_code = "GG";
    }

    if(!in_array($promo_code,$currentCodes) && !in_array($promo_code,$array)){ //validation if 
        $array[] = $promo_code;
        // $result = mysql_query("INSERT INTO promotional_code_manager (promotional_code, delivery_plu, pickup_plu, start_date, expire_date, start_time, end_time, min_order, max_codes_allowed, num_redeemable, day_available, app_only, client_id) 
        // VALUES ('".$array[$y]."', '$delivery_plu', '$pickup_plu','$start_date' ,'$expire_date', '$start_time', '$end_time ', '$min_order', '$max_codes_allowed', '$num_redeemable', '$day_available' ,'$app_only', $client_id)",$server);

         $y++;
    }

    $promo_code='';
}

echo json_encode($array);
?>