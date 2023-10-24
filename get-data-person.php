<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$service_url = 'https://itagroup.hs.llnwd.net/o40/csg/year-end-recap/lookback-2023-vimeo.json';
$person = $_GET['personId'];

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
        $myObj = array(
            "personid" => $item['personid'],
            "first-name" => $item['first-name'],
            "number-sent-recognitions" => $item['number-sent-recognitions'],
            "number-received-recognitions" => $item['number-received-recognitions'],
            "total-value1-received" => "%",
            "total-value2-received" => $item['total-value2-received'],
            "total-value3-received" => $item['total-value3-received'],
            "total-value4-received" => $item['total-value4-received'],
            "total-value5-received" => $item['total-value5-received'],
            "total-company-recognitions-sent" => $item['total-company-recognitions-sent'] 
        );
      
        $personItems[] = $myObj;
    }
    
}

echo json_encode($personItems);
?>
