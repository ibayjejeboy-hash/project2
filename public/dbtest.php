<?php
set_time_limit(10);

$host = getenv('DB_HOST');
$port = (int)getenv('DB_PORT');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

echo "Host: $host | Port: $port | DB: $db | User: $user<br><br>";

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_TIMEOUT         => 5,
        PDO::ATTR_CONNECT_TIMEOUT => 5,
        PDO::ATTR_ERRMODE         => PDO::ERRMODE_EXCEPTION,
    ]);
    echo "✅ DB KONEK!<br><br>";

    // Cek tabel users
    $rows = $pdo->query("SELECT email FROM users LIMIT 5")->fetchAll();
    if (count($rows) === 0) {
        echo "⚠️ Tabel users KOSONG — belum ada data!";
    } else {
        foreach ($rows as $r) echo "👤 " . $r['email'] . "<br>";
    }
} catch (Exception $e) {
    echo "❌ GAGAL: " . $e->getMessage();
}