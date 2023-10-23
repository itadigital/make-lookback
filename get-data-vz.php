<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$service_url = 'https://itagroup.hs.llnwd.net/o40/csg/digital/dynamic-video/fios-dynamic-data.json';
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
            "FirstName" => $item['FirstName'],
            "Referrals_Submitted" => $item['Referrals_Submitted'],
            "Closed_Sold_Referrals" => $item['Closed_Sold_Referrals'],
            "Points_Earned" => $item['Points_Earned'],
            "Points_Redeemed" => $item['Points_Redeemed'],
            "Best_Month" => $item['Best_Month'],
            "Points_Expiring" => $item['Points_Expiring']
        );
      
        $personItems[] = $myObj;
    }
    
}

echo json_encode($personItems);
?>
