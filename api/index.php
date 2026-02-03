<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Sumber yang lebih stabil untuk rekap 6D
$target_url = "https://www.dlhntb.org"; 

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $target_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Lewati verifikasi SSL jika error
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36");

$html = curl_exec($ch);
// curl_close($ch); // DIHAPUS agar tidak muncul pesan Deprecated/Usang

// Regex yang lebih teliti untuk menangkap angka 6 digit di dalam tabel
preg_match_all('/\b\d{6}\b/', $html, $matches);

// Ambil hasil unik dan bersihkan
$data_raw = isset($matches[0]) ? array_values(array_unique($matches[0])) : [];

echo json_encode([
    "status" => "success",
    "type" => "HK 6D",
    "last_result" => !empty($data_raw) ? $data_raw[0] : "Pending",
    "paito_list" => array_slice($data_raw, 0, 50),
    "updated_at" => date("d-m-Y H:i:s")
]);
