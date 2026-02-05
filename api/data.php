<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$target_url = "https://www.dlhntb.org"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");

$html = curl_exec($ch);
curl_close($ch);

// Ambil angka 6 digit unik
preg_match_all('/\b\d{6}\b/', $html, $matches);
$data_raw = isset($matches[0]) ? array_values(array_unique($matches[0])) : [];

echo json_encode([
    "status" => "success",
    "paito_list" => array_slice($data_raw, 0, 100)
]);
