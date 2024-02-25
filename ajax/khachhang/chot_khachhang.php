<?php

$tendv = $_POST['tendv'];
$dtdaidien = $_POST['dtdaidien'];
$tendaidien = $_POST['tendaidien'];
$diachi = $_POST['diachi'];
$msxa = $_POST['msxa'];
$dtcongtacvien = $_POST['dtcongtacvien'];
$ngaykichhoat = $_POST['ngaykichhoat'];
$data = array(
    "tendv" => $tendv,
    "dtdaidien" => $dtdaidien,
    "tendaidien" => $tendaidien,
    "diachi" => $diachi,
    "msxa" => $msxa,
    "dtcongtacvien" => $dtcongtacvien,
    "ngaykichhoat" => $ngaykichhoat
);
$data_string = json_encode($data);
$value = array(
    "user" => "0907678234",
    "pass" => "123",
);
$value_string = json_encode($value);
$curl = curl_init();
// Get token
curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://egpp.vn/api_tmdt/api/Login',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $value_string,
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Cookie: PHPSESSID=7ccf35f234c79ccb437b4e8516ffe40c'
    ),
));

$response = curl_exec($curl);
$result = (array) json_decode($response);
curl_close($curl);
if ($result['token'] != '') {
    //Active EGPP
    $token = $result['token'];
    $http_token =  array(
        'Authorization: bearer ' . $token,
        'Content-Type: application/json',
        'Cookie: PHPSESSID=7ccf35f234c79ccb437b4e8516ffe40c'
    );
    $curl_add_kh = curl_init();
    curl_setopt_array($curl_add_kh, array(
        CURLOPT_URL => 'https://egpp.vn/api_tmdt/api/active',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $data_string,
        CURLOPT_HTTPHEADER => $http_token
    ));

    $response_add_kh = curl_exec($curl_add_kh);
    $result_add_kh = (array)json_decode($response_add_kh);
    curl_close($curl_add_kh);
    if ($result_add_kh['code'] == '404') {
        echo $result_add_kh['code'];
    } else {
        echo $result_add_kh['msdv'];
    }
}
