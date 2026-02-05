<?php
$apiUrl = "https://" . $_SERVER['HTTP_HOST'] . "/api-data"; 
$response = file_get_contents($apiUrl);
$data = json_decode($response, true);
$paito_raw = $data['paito_list'] ?? [];
$paito_mingguan = array_chunk($paito_raw, 7);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Paito Warna HK 6D</title>
    <link rel="stylesheet" href="/assets/style-paito.css">
    <script src="https://cdnjs.cloudflare.com"></script>
</head>
<body class="home custom-background">
    <div id="container">
        <div id="top-bar"><h2>Paito HK Lotto</h2></div>
        <div id="content" style="padding:10px;">
            <!-- Tool Warna -->
            <div class="menu2" id="colormenu">
                <button id="btnSubmit">Hapus</button>
                <div id="color-selector">
                    <div class="color Aqua" data-color="#00ffff" style="background:#00ffff"></div>
                    <div class="color Gold" data-color="#ffd700" style="background:#ffd700"></div>
                    <div class="color eraser" data-color="transparent" style="background:#fff; border:1px solid #000;"></div>
                </div>
            </div>

            <!-- Tabel 6D -->
            <div style="overflow-x:auto;">
                <table id="drawing-table" border="1">
                    <thead>
                        <tr><th colspan="6">Senin</th><th colspan="6">Selasa</th><th colspan="6">Rabu</th><th colspan="6">Kamis</th><th colspan="6">Jumat</th><th colspan="6">Sabtu</th><th colspan="6">Minggu</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($paito_mingguan as $minggu): ?>
                        <tr>
                            <?php for ($i=0; $i<7; $i++): 
                                $val = $minggu[$i] ?? "000000";
                                $d = str_split($val); // Pecah 6 digit
                            ?>
                                <td class="asux"><?= $d[0] ?></td><td class="asux"><?= $d[1] ?></td>
                                <td class="asu"><?= $d[2] ?></td><td class="asu"><?= $d[3] ?></td>
                                <td class="asu"><?= $d[4] ?></td><td class="asu"><?= $d[5] ?></td>
                            <?php endfor; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Input Cari -->
            <div style="text-align:center; margin-top:20px;">
                <form id="myForm">
                    <input id="asc" class="cari" maxlength="1" placeholder="as">
                    <input id="kopc" class="cari" maxlength="1" placeholder="kop">
                    <input id="kepalac" class="cari" maxlength="1" placeholder="kep">
                    <input id="ekorc" class="cari" maxlength="1" placeholder="ekr">
                </form>
            </div>
        </div>
    </div>
    <script src="/assets/paito.js"></script>
</body>
</html>
