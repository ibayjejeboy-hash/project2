<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$key = config('services.gemini.key');
echo "Key: " . substr($key, 0, 5) . "...\n";

$response = Illuminate\Support\Facades\Http::get('https://generativelanguage.googleapis.com/v1beta/models?key=' . $key);

$data = $response->json();
foreach($data['models'] as $m) {
    if(strpos($m['name'], 'gemini') !== false) {
        echo $m['name'] . "\n";
    }
}
