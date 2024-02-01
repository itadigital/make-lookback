<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$person = $_GET['personId'];
$filename =  $_GET['data'];

$service_url = 'https://itagroup.hs.llnwd.net/o40/csg/video/dynamic/' . $filename . '.json';

$curl = curl_init($service_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$curl_response = curl_exec($curl);

if ($curl_response === false) {
    $info = curl_getinfo($curl);
    curl_close($curl);
    die('error occured during curl exec. Additional info: ' . var_export($info));
}
curl_close($curl);

$decoded = json_decode($curl_response,true);
if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
    die('error occured: ' . $decoded->response->errormessage);
}

foreach ($decoded as $item) {

    if ($item['personid'] == $person) {
        $myObj = array("personid" => $item['personid']);
        if (array_key_exists("display-name",$item)){
            $myObj['display-name'] = $item['display-name'];
        }
        if (array_key_exists("first-name",$item)){
            $myObj['first-name'] = $item['first-name'];
        }
        if (array_key_exists("last-name",$item)){
            $myObj['last-name'] = $item['last-name'];
        }
        if (array_key_exists("yos",$item)){
            $myObj['yos'] = $item['yos'];
        }
        if (array_key_exists("yos-text",$item)){
            $myObj['yos'] = $item['yos-text'];
        }
        if (array_key_exists("number-sent-recognitions",$item)){
            $myObj['number-sent-recognitions'] = $item['number-sent-recognitions'];
        }
        if (array_key_exists("number-received-recognitions",$item)){
            $myObj['number-received-recognitions'] = $item['number-received-recognitions'];
        }
        if (array_key_exists("total-value1-received",$item)){
            $myObj['total-value1-received'] = $item['total-value1-received'];
        }
        if (array_key_exists("total-value2-received",$item)){
            $myObj['total-value2-received'] = $item['total-value2-received'];
        }
        if (array_key_exists("total-value3-received",$item)){
            $myObj['total-value3-received'] = $item['total-value3-received'];
        }
        if (array_key_exists("total-value4-received",$item)){
            $myObj['total-value4-received'] = $item['total-value4-received'];
        }
        if (array_key_exists("total-value5-received",$item)){
            $myObj['total-value5-received'] = $item['total-value5-received'];
        }
        if (array_key_exists("total-company-recognitions-sent",$item)){
            $myObj['total-company-recognitions-sent'] = $item['total-company-recognitions-sent'];
        }
        
        $personItems[] = $myObj;
    }
    
}

echo json_encode($personItems);
?>
