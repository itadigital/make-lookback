<?php
header("Access-Control-Allow-Origin: *");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$url = 'https://eu1.make.com/api/v2/scenarios/1509723/run';

/*
//Get url parameters and build array
parse_str($_SERVER['QUERY_STRING'], $query_array);
//print_r($query_array);

//Construct request from query parameters (ex. ?WelcomeSent=true&Touchpoint1Triggered=true&SubscriberKey=987654321)
$jsonData = array("items" => [$query_array]);
*/

//Initiate cURL.
$ch = curl_init($url);

//print_r($jsonData);

//Encode the array into JSON.
//$jsonDataEncoded = json_encode($jsonData);

//print_r($jsonDataEncoded);

//Tell cURL that we want to send a POST request.
curl_setopt($ch, CURLOPT_POST, 1);

//Tell cURL that we want to send a PUT request.
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

//Attach our JSON string to the POST fields.
//curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

//Set the content type to application/json and pass in auth
$headr = array();
//$headr[] = 'Content-Type: application/json';
$headr[] = 'Authorization: Token 86cd309b-92ad-4025-965e-dcd15c9c2e62';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);

curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);

//Execute the request
$result = curl_exec($ch);
if(curl_errno($ch)){
    echo 'Request Error:' . curl_error($ch);
} else {
    print_r($result);
}

?>
