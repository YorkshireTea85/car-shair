<?php

$curl = curl_init();

$vrn_data = [
    'registrationNumber' => htmlspecialchars($_POST['vrn_input']),
    ];
$vrn_json = json_encode($vrn_data);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://driver-vehicle-licensing.api.gov.uk/vehicle-enquiry/v1/vehicles",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $vrn_json,
    //SSL TEMPORARILY DISABLED - INVESTIGATE SSL CERTIFICATE ON SERVER 
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_HTTPHEADER => array(
        "x-api-key: ybKWABlcb03iGBIwKXHj18pYEIX3wTRR7B5ku4aA",
        "Content-Type: application/json"
    ),
));

$response = curl_exec($curl);

if ($response !== false) {
    
    $info = curl_getinfo($curl);

    if ($info['http_code'] !== 200) {
        $dvla_data = null;
    } else {
        $dvla_data = json_decode($response, true);
    }

curl_close($curl);
}