<?php
// Set zona waktu ke Asia/Jakarta (WIB)
date_default_timezone_set("Asia/Jakarta");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

$target_url = "https://www.dlhntb.org"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36");

$html = curl_exec($ch);

preg_match_all('/\b\d{6}\b/', $html, $matches);
$data_raw = isset($matches[0]) ? array_values(array_unique($matches[0])) : [];

echo json_encode([
    "status" => "success",
    "type" => "HK 6D",
    "last_result" => !empty($data_raw) ? $data_raw[0] : "Pending",
    "paito_list" => array_slice($data_raw, 0, 50),
    "updated_at" => date("d-m-Y H:i:s") // Sekarang akan mengikuti jam WIB
]);
