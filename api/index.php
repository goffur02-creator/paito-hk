<?php
header("Content-Type: application/json");
$target_url = "https://www.dlhntb.org"; 
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
$html = curl_exec($ch);
curl_close($ch);
preg_match_all('/\b\d{6}\b/', $html, $matches);
$data_6d = array_values(array_unique($matches[0]));
echo json_encode([
    "status" => "success",
    "type" => "HK 6D",
    "last_result" => $data_6d[0] ?? "N/A",
    "paito_list" => array_slice($data_6d, 0, 30)
]);
