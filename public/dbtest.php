<?php
set_time_limit(10);

$host = getenv('DB_HOST');
$port = (int)getenv('DB_PORT');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

echo "Konek ke $host:$port...<br>";
flush();

mysqli_report(MYSQLI_REPORT_OFF);
$mysqli = mysqli_init();
mysqli_options($mysqli, MYSQLI_OPT_CONNECT_TIMEOUT, 5);
$conn = mysqli_real_connect($mysqli, $host, $user, $pass, $db, $port);

if (!$conn) {
    echo "❌ GAGAL: " . mysqli_connect_error();
} else {
    echo "✅ BERHASIL!";
    mysqli_close($mysqli);
}