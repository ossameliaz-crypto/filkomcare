<?php
$source = __DIR__;
$destination = __DIR__ . '/../filkomcare-production.zip';

$zip = new ZipArchive();
if ($zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
    die("Failed to create zip\n");
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$exclude = ['~[\\\\/]node_modules[\\\\/]~', '~[\\\\/]\.git[\\\\/]~', '~filkomcare-production\.zip~', '~zip_project\.php~'];

foreach ($iterator as $file) {
    $filepath = str_replace('\\', '/', $file->getPathname());
    $skip = false;
    foreach ($exclude as $pattern) {
        if (preg_match($pattern, $filepath)) {
            $skip = true;
            break;
        }
    }
    
    if ($skip) continue;

    $localPath = substr($filepath, strlen(str_replace('\\', '/', $source)) + 1);
    
    if ($file->isDir()) {
        $zip->addEmptyDir($localPath);
    } else {
        $zip->addFile($filepath, $localPath);
    }
}

$zip->close();
echo "Zip created successfully: $destination\n";
