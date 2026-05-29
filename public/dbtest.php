<?php
// ... kode konek PDO sebelumnya ...

// Cek tabel users
$stmt = $pdo->query("SELECT email FROM users LIMIT 5");
$users = $stmt->fetchAll();
foreach($users as $u) {
    echo $u['email'] . "<br>";
}