<?php
/**
 * Conversor de Imagens para WebP
 * Utiliza ImageMagick (convert) ou cwebp para conversão automática
 * Mantém arquivo original como fallback
 */

class WebPConverter {
    private $imgDir;
    private $quality = 85;
    private $method = null;
    private $converted = 0;
    private $skipped = 0;
    private $failed = 0;
    
    public function __construct($imgDir, $quality = 85) {
        $this->imgDir = rtrim($imgDir, '/\\') . DIRECTORY_SEPARATOR;
        $this->quality = $quality;
        $this->detectMethod();
        
        if (!$this->method) {
            throw new Exception("ImageMagick (convert) ou cwebp não encontrados");
        }
    }
    
    /**
     * Detecta qual ferramenta está disponível
     */
    private function detectMethod() {
        // Forçar ImageMagick (mais estável em Windows)
        $this->method = 'imagemagick';
        echo "✅ Usando ImageMagick (convert) para conversão\n\n";
    }
    
    /**
     * Inicia conversão em lote
     */
    public function convertAll() {
        echo "═══════════════════════════════════════════════════════════════\n";
        echo "CONVERSÃO DE IMAGENS PARA WEBP\n";
        echo "═══════════════════════════════════════════════════════════════\n\n";
        
        // Imagens prioritárias (críticas)
        $criticalImages = [
            'Banner 3 - Looks Completos KOKETSU 1920x720 (1).png',
            'COMP1.png',
            'COMP2.png',
            'COMP3.png',
            'polo 2.png',
            'polo 3.png',
        ];
        
        // Converter imagens críticas
        echo "🔴 CONVERTENDO IMAGENS CRÍTICAS:\n";
        echo str_repeat("─", 80) . "\n";
        foreach ($criticalImages as $filename) {
            if (file_exists($this->imgDir . $filename)) {
                $this->convertFile($filename);
            }
        }
        
        echo "\n";
        echo "🟠 CONVERTENDO OUTRAS IMAGENS PNG/JPG:\n";
        echo str_repeat("─", 80) . "\n";
        
        // Converter todas as outras imagens PNG e JPG grandes
        $files = glob($this->imgDir . '*.{jpg,jpeg,png}', GLOB_BRACE);
        
        foreach ($files as $file) {
            $basename = basename($file);
            
            // Pular imagens críticas (já convertidas)
            if (in_array($basename, $criticalImages)) {
                continue;
            }
            
            // Pular imagens não utilizadas
            if (preg_match('/Homepage KOKETSU|Página Produto/i', $basename)) {
                echo "⏭️  PULANDO (não utilizado): {$basename}\n";
                $this->skipped++;
                continue;
            }
            
            $size = filesize($file) / (1024 * 1024);
            
            // Converter apenas imagens maiores que 100KB
            if ($size > 0.1) {
                $this->convertFile($basename);
            }
        }
        
        $this->printSummary();
    }
    
    /**
     * Converte um arquivo individual
     */
    private function convertFile($filename) {
        $source = $this->imgDir . $filename;
        $webpName = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $filename);
        $target = $this->imgDir . $webpName;
        
        // Pular se WebP já existe
        if (file_exists($target)) {
            $origSize = filesize($source) / (1024 * 1024);
            $webpSize = filesize($target) / (1024 * 1024);
            $savings = (1 - ($webpSize / $origSize)) * 100;
            echo sprintf("✅ JÁ EXISTE: %s → %s (%.2f MB → %.2f MB, %.0f%% menor)\n", 
                $filename, $webpName, $origSize, $webpSize, $savings);
            $this->skipped++;
            return;
        }
        
        try {
            if ($this->method === 'cwebp') {
                $this->convertWithCwebp($source, $target, $filename, $webpName);
            } else {
                $this->convertWithImageMagick($source, $target, $filename, $webpName);
            }
        } catch (Exception $e) {
            echo "❌ ERRO ao converter {$filename}: " . $e->getMessage() . "\n";
            $this->failed++;
        }
    }
    
    /**
     * Conversão usando cwebp
     */
    private function convertWithCwebp($source, $target, $filename, $webpName) {
        $escapedSource = escapeshellarg($source);
        $escapedTarget = escapeshellarg($target);
        $quality = $this->quality;
        
        // cwebp usa quality 0-100 (padrão 75)
        $cmd = "cwebp -q $quality $escapedSource -o $escapedTarget 2>&1";
        $output = shell_exec($cmd);
        
        if (!file_exists($target) || filesize($target) == 0) {
            throw new Exception($output ?: "Falha na conversão");
        }
        
        $origSize = filesize($source) / (1024 * 1024);
        $webpSize = filesize($target) / (1024 * 1024);
        $savings = (1 - ($webpSize / $origSize)) * 100;
        
        echo sprintf("✅ CONVERTIDO: %s → %s (%.2f MB → %.2f MB, %.0f%% menor)\n", 
            $filename, $webpName, $origSize, $webpSize, $savings);
        $this->converted++;
    }
    
    /**
     * Conversão usando ImageMagick convert
     */
    private function convertWithImageMagick($source, $target, $filename, $webpName) {
        $escapedSource = escapeshellarg($source);
        $escapedTarget = escapeshellarg($target);
        $quality = $this->quality;
        
        // ImageMagick convert usa quality 1-100
        $cmd = "convert $escapedSource -quality $quality -define webp:method=6 $escapedTarget 2>&1";
        $output = shell_exec($cmd);
        
        if (!file_exists($target) || filesize($target) == 0) {
            throw new Exception($output ?: "Falha na conversão");
        }
        
        $origSize = filesize($source) / (1024 * 1024);
        $webpSize = filesize($target) / (1024 * 1024);
        $savings = (1 - ($webpSize / $origSize)) * 100;
        
        echo sprintf("✅ CONVERTIDO: %s → %s (%.2f MB → %.2f MB, %.0f%% menor)\n", 
            $filename, $webpName, $origSize, $webpSize, $savings);
        $this->converted++;
    }
    
    /**
     * Exibe resumo final
     */
    private function printSummary() {
        echo "\n" . str_repeat("═", 80) . "\n";
        echo "RESUMO DA CONVERSÃO\n";
        echo str_repeat("═", 80) . "\n";
        echo sprintf("✅ Convertidas:  %d imagens\n", $this->converted);
        echo sprintf("⏭️  Puladas:     %d imagens (já existem em WebP ou não utilizadas)\n", $this->skipped);
        echo sprintf("❌ Com erro:    %d imagens\n", $this->failed);
        echo "\n";
        
        if ($this->converted > 0) {
            // Calcular economia total
            $totalOrigSize = 0;
            $totalWebpSize = 0;
            
            $files = glob($this->imgDir . '*.webp');
            foreach ($files as $webpFile) {
                $origExt = preg_replace('/\.webp$/', '', basename($webpFile));
                
                // Tentar encontrar arquivo original
                foreach (['.png', '.jpg', '.jpeg'] as $ext) {
                    $origFile = $this->imgDir . $origExt . $ext;
                    if (file_exists($origFile)) {
                        $totalOrigSize += filesize($origFile);
                        $totalWebpSize += filesize($webpFile);
                        break;
                    }
                }
            }
            
            if ($totalOrigSize > 0) {
                $savings = (1 - ($totalWebpSize / $totalOrigSize)) * 100;
                echo sprintf("💾 Economia total estimada: %.2f%% de redução\n", $savings);
                echo sprintf("   Original: %.2f MB → WebP: %.2f MB\n", 
                    $totalOrigSize / (1024 * 1024), 
                    $totalWebpSize / (1024 * 1024));
            }
        }
        
        echo "\n✨ PRÓXIMAS ETAPAS:\n";
        echo "   1. As picture tags já estão implementadas no HTML\n";
        echo "   2. O navegador automaticamente vai usar .webp quando disponível\n";
        echo "   3. JPEG/PNG servem como fallback para navegadores antigos\n";
    }
}

// Executar conversão
try {
    $converter = new WebPConverter('c:\Users\jever\OneDrive\Área de Trabalho\Apresentacao\frontend\img');
    $converter->convertAll();
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
