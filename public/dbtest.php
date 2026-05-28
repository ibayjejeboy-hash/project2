<?php
$timeout = 5;
$host = getenv('DB_HOST') ?: 'tidak ada';
$port = getenv('DB_PORT') ?: '3306';
$db   = getenv('DB_DATABASE') ?: 'tidak ada';
$user = getenv('DB_USERNAME') ?: 'tidak ada';
$pass = getenv('DB_PASSWORD') ?: 'tidak ada';

echo "<h3>ENV yang terbaca:</h3>";
echo "DB_HOST: $host <br>";
echo "DB_PORT: $port <br>";
echo "DB_DATABASE: $db <br>";
echo "DB_USERNAME: $user <br>";
echo "<hr>";

echo "<h3>Test koneksi PDO:</h3>";
try {
    $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
    $options = [
        PDO::ATTR_TIMEOUT => $timeout,
        PDO::ATTR_CONNECT_TIMEOUT => $timeout,
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "✅ BERHASIL KONEK KE DATABASE!";
} catch (Exception $e) {
    echo "❌ GAGAL: " . $e->getMessage();
}