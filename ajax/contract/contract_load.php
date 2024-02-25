<?php
$offset = $_POST['offset'];
$limit = $_POST['limit'];
$songayhethan = $_POST['songayhethan'];
$trangthai = $_POST['trangthai'];
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://timbacsi.vn/api/quanlyhopdong',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
        "offset":"' . $offset . '",
        "limit":"' . $limit . '",
        "songayhethan": "' . $songayhethan . '",
        "trangthai": ' . $trangthai . '
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
    ),
));

$response = curl_exec($curl);
curl_close($curl);
$shorkey = json_decode($response);
$data = "";
$data = $shorkey->data;
header('Content-Type: application/json');
echo json_encode($data);
