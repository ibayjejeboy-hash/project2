<?php
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');

echo "HOST: $host | PORT: $port <br><br>";

// Test apakah port bisa dijangkau
$conn = @fsockopen($host, $port, $errno, $errstr, 5);
if ($conn) {
    echo "✅ Port $port BISA dijangkau!";
    fclose($conn);
} else {
    echo "❌ Port $port TIDAK bisa dijangkau: $errstr ($errno)";
}