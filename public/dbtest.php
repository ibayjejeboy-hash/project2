<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');

echo "HOST: $host | PORT: $port<br>";
echo "DB: $db | USER: $user<br><br>";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
        $user, $pass,
        [
            PDO::ATTR_TIMEOUT         => 5,
            PDO::ATTR_CONNECT_TIMEOUT => 5,
        ]
    );
    echo "✅ KONEK BERHASIL!";
} catch (Exception $e) {
    echo "❌ GAGAL: " . $e->getMessage();
}