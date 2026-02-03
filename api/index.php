<?php
header("Content-Type: application/json");
$data = ["status" => "online", "source" => "HK Paito", "numbers" => [1234, 5678, 9012]];
echo json_encode($data);
