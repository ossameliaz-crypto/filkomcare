<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$url = env('GOOGLE_SHEET_WEBHOOK_URL');
echo "URL: " . $url . "\n";

$response = Illuminate\Support\Facades\Http::post($url, [
    'report_id' => 'RPT-TEST',
    'user_name' => 'Test User',
    'user_nim' => '123',
    'service' => 'Chat Konseling',
    'topic' => 'Test',
    'description' => 'Test desc',
    'date' => '2026-05-28',
    'time' => '10:00',
    'status' => 'Menunggu'
]);

echo "STATUS: " . $response->status() . "\n";
echo "BODY: " . $response->body() . "\n";
