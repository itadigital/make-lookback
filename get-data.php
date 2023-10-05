<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

/*$request = new HttpRequest();
$request->setUrl('https://eu1.make.com/api/v2/scenarios/1509723/run');
$request->setMethod(HTTP_METH_POST);
$request->setHeaders([  'Authorization' => 'Token 86cd309b-92ad-4025-965e-dcd15c9c2e62']);
$request->setBody('{"data":{"personId":"7010c621-c5ad-46bc-8ed4-0969347b44d7",},
                    "responsive":false}');
try {  $response = $request->send();  
     echo $response->getBody();
    } 
catch (HttpException $ex) { 
    echo $ex;
}*/

$request = new HttpRequest();
$request->setUrl('https://eu1.make.com/api/v2/scenarios/111/run');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders([
  'Authorization' => 'Token abcdefab-1234-5678-abcd-112233445566'
]);

$request->setBody('{"data":{"Test input":"Test value","My array":["test 1","test 2"],"My collection":{"key":"value"}},"responsive":false}');

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}

?>
