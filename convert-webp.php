<?php
/**
 * Script para converter imagens para WebP
 * Uso: php convert-webp.php
 */

// Diretório de imagens
$imgDir = __DIR__ . '/frontend/img';
$supportedFormats = ['jpg', 'jpeg', 'png'];
$quality = 85; // 0-100, 80-85 é ideal para WebP

// Verificar se GD está habilitado
if (!extension_loaded('gd')) {
    die("❌ Extensão GD do PHP não está habilitada.\n");
}

echo "🔄 Iniciando conversão de imagens para WebP...\n\n";

$converted = 0;
$failed = 0;

// Percorrer diretório
$files = scandir($imgDir);

foreach ($files as $file) {
    $path = $imgDir . '/' . $file;
    
    // Ignorar diretórios e arquivos especiais
    if (is_dir($path) || strpos($file, '.') === 0) {
        continue;
    }
    
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $name = pathinfo($file, PATHINFO_FILENAME);
    
    // Apenas processar imagens suportadas
    if (!in_array($ext, $supportedFormats)) {
        continue;
    }
    
    $webpPath = $imgDir . '/' . $name . '.webp';
    
    // Não converter se já existe
    if (file_exists($webpPath)) {
        echo "⏭️  Pulando: $file (WebP já existe)\n";
        continue;
    }
    
    // Carregar imagem
    $image = null;
    
    switch ($ext) {
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($path);
            break;
        case 'png':
            $image = imagecreatefrompng($path);
            // Preservar transparência
            imagepalettetotruecolor($image);
            imagealphablending($image, false);
            imagesavealpha($image, true);
            break;
    }
    
    if ($image === false) {
        echo "❌ Erro ao carregar: $file\n";
        $failed++;
        continue;
    }
    
    // Converter para WebP
    if (imagewebp($image, $webpPath, $quality)) {
        $oldSize = filesize($path);
        $newSize = filesize($webpPath);
        $savings = round((1 - $newSize / $oldSize) * 100, 1);
        
        echo "✅ Convertido: $file → {$name}.webp (-{$savings}%)\n";
        $converted++;
    } else {
        echo "❌ Erro ao converter: $file\n";
        $failed++;
    }
    
    unset($image);
}

echo "\n📊 Resumo:\n";
echo "   Convertidas: $converted\n";
echo "   Erros: $failed\n";
echo "\n✨ Conversão concluída!\n";
?>
