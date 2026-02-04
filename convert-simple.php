<?php
/**
 * Conversor WebP Simplificado - ImageMagick
 */

$imgDir = 'c:\Users\jever\OneDrive\Área de Trabalho\Apresentacao\frontend\img';
$quality = 85;
$converted = 0;
$failed = 0;

echo "═══════════════════════════════════════════════════════════════\n";
echo "CONVERSÃO PARA WEBP - Koketsu Grife\n";
echo "═══════════════════════════════════════════════════════════════\n\n";

// Imagens prioritárias
$critical = [
    'Banner 3 - Looks Completos KOKETSU 1920x720 (1).png',
    'COMP1.png',
    'COMP2.png',
    'COMP3.png',
    'polo 2.png',
    'polo 3.png',
];

echo "🔴 CRÍTICAS:\n";
foreach ($critical as $file) {
    $source = $imgDir . DIRECTORY_SEPARATOR . $file;
    if (!file_exists($source)) continue;
    
    $webpName = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $file);
    $target = $imgDir . DIRECTORY_SEPARATOR . $webpName;
    
    if (file_exists($target)) {
        $origSize = filesize($source) / (1024 * 1024);
        $webpSize = filesize($target) / (1024 * 1024);
        $savings = round((1 - ($webpSize / $origSize)) * 100);
        echo "✅ $webpName (%.2f → %.2f MB, $savings%% menor)\n";
        continue;
    }
    
    // Usar convert com cd para evitar problemas de paths
    $cmd = sprintf('cd "%s" && convert "%s" -quality %d -define webp:method=6 "%s"', 
        $imgDir, $file, $quality, $webpName);
    
    $result = shell_exec($cmd . ' 2>&1');
    
    if (file_exists($target)) {
        $origSize = filesize($source) / (1024 * 1024);
        $webpSize = filesize($target) / (1024 * 1024);
        $savings = round((1 - ($webpSize / $origSize)) * 100);
        echo "✅ $webpName ($origSize MB → $webpSize MB, $savings%% menor)\n";
        $converted++;
    } else {
        echo "❌ ERRO: $file\n";
        $failed++;
    }
}

echo "\n📊 IMAGENS GRANDES (>100KB):\n";
$files = glob("$imgDir/*.{jpg,jpeg,png}", GLOB_BRACE);
usort($files, function($a, $b) { return filesize($b) - filesize($a); });

foreach ($files as $source) {
    $file = basename($source);
    
    // Pular críticas e não utilizadas
    if (in_array($file, $critical)) continue;
    if (preg_match('/Homepage KOKETSU|Página Produto/i', $file)) {
        echo "⏭️  $file (não utilizado)\n";
        continue;
    }
    
    $size = filesize($source) / (1024 * 1024);
    if ($size < 0.1) continue;
    
    $webpName = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $file);
    $target = $imgDir . DIRECTORY_SEPARATOR . $webpName;
    
    if (file_exists($target)) continue;
    
    $cmd = sprintf('cd "%s" && convert "%s" -quality %d -define webp:method=6 "%s"', 
        $imgDir, $file, $quality, $webpName);
    
    $result = shell_exec($cmd . ' 2>&1');
    
    if (file_exists($target)) {
        $origSize = filesize($source) / (1024 * 1024);
        $webpSize = filesize($target) / (1024 * 1024);
        $savings = round((1 - ($webpSize / $origSize)) * 100);
        echo "✅ $webpName ($origSize MB → $webpSize MB, $savings%% menor)\n";
        $converted++;
    }
}

echo "\n═══════════════════════════════════════════════════════════════\n";
echo "RESUMO: $converted convertidas, $failed erros\n";
echo "═══════════════════════════════════════════════════════════════\n";
