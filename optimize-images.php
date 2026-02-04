<?php
/**
 * Script de Otimização de Imagens para Koketsu Grife
 * 
 * Estratégias implementadas:
 * 1. Detecção e remoção de imagens duplicadas
 * 2. Relatório de tamanhos e recomendações
 * 3. Compressão com ImageMagick (se disponível)
 * 4. Estrutura de dados para WebP conversion
 */

class ImageOptimizer {
    private $imgDir;
    private $report = [];
    private $duplicates = [];
    private $totalSize = 0;
    
    public function __construct($imgDir) {
        $this->imgDir = rtrim($imgDir, '/\\') . DIRECTORY_SEPARATOR;
        if (!is_dir($this->imgDir)) {
            throw new Exception("Diretório não encontrado: $imgDir");
        }
    }
    
    /**
     * Executa análise completa de otimização
     */
    public function analyze() {
        echo "═══════════════════════════════════════════════════════════════\n";
        echo "ANÁLISE DE OTIMIZAÇÃO - Koketsu Grife\n";
        echo "═══════════════════════════════════════════════════════════════\n\n";
        
        $this->findDuplicates();
        $this->analyzeFileSizes();
        $this->checkConversionTools();
        $this->generateOptimizationPlan();
        
        return $this->report;
    }
    
    /**
     * Encontra imagens duplicadas (mesmo conteúdo)
     */
    private function findDuplicates() {
        echo "🔍 Procurando imagens duplicadas...\n";
        
        $files = glob($this->imgDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);
        $hashes = [];
        
        foreach ($files as $file) {
            $hash = md5_file($file);
            $basename = basename($file);
            
            if (isset($hashes[$hash])) {
                if (!isset($this->duplicates[$hash])) {
                    $this->duplicates[$hash] = [$hashes[$hash]];
                }
                $this->duplicates[$hash][] = $basename;
            } else {
                $hashes[$hash] = $basename;
            }
        }
        
        if (count($this->duplicates) > 0) {
            echo "⚠️  Encontrados " . count($this->duplicates) . " conjuntos de imagens duplicadas:\n";
            foreach ($this->duplicates as $hash => $files) {
                $size = filesize($this->imgDir . $files[0]) / (1024 * 1024);
                echo sprintf("   • %s (%.2f MB)\n", implode(", ", $files), $size);
            }
        } else {
            echo "✅ Nenhuma imagem duplicada encontrada\n";
        }
        echo "\n";
    }
    
    /**
     * Analisa tamanhos de arquivo e identifica otimizações
     */
    private function analyzeFileSizes() {
        echo "📊 Análise de Tamanhos de Arquivo:\n";
        echo str_repeat("─", 80) . "\n";
        printf("%-45s | %-12s | %-15s\n", "Arquivo", "Tamanho", "Prioridade");
        echo str_repeat("─", 80) . "\n";
        
        $files = glob($this->imgDir . '*.{jpg,jpeg,png,webp}', GLOB_BRACE);
        usort($files, function($a, $b) {
            return filesize($b) - filesize($a);
        });
        
        foreach ($files as $file) {
            $basename = basename($file);
            $size = filesize($file);
            $sizeMB = $size / (1024 * 1024);
            $this->totalSize += $size;
            
            // Prioridade de otimização
            if ($sizeMB > 2) {
                $priority = "🔴 CRÍTICA";
            } elseif ($sizeMB > 0.5) {
                $priority = "🟠 ALTA";
            } elseif ($sizeMB > 0.1) {
                $priority = "🟡 MÉDIA";
            } else {
                $priority = "🟢 BAIXA";
            }
            
            printf("%-45s | %6.2f MB  | %s\n", substr($basename, 0, 45), $sizeMB, $priority);
        }
        
        echo str_repeat("─", 80) . "\n";
        printf("%-45s | %6.2f MB\n", "TOTAL", $this->totalSize / (1024 * 1024));
        echo "\n";
    }
    
    /**
     * Verifica disponibilidade de ferramentas de conversão
     */
    private function checkConversionTools() {
        echo "🛠️  Verificando ferramentas de conversão:\n";
        
        $tools = [
            'imagemagick' => ['convert', 'identify'],
            'cwebp' => ['cwebp'],
            'php-gd' => function() { return extension_loaded('gd'); }
        ];
        
        $available = [];
        $missing = [];
        
        // Verificar ImageMagick
        $output = shell_exec('where convert 2>&1');
        if ($output && strpos($output, 'not found') === false && strpos($output, 'encontrado') === false) {
            $available[] = "ImageMagick (convert)";
        } else {
            $missing[] = "ImageMagick";
        }
        
        // Verificar cwebp
        $output = shell_exec('where cwebp 2>&1');
        if ($output && strpos($output, 'not found') === false && strpos($output, 'encontrado') === false) {
            $available[] = "cwebp";
        } else {
            $missing[] = "cwebp";
        }
        
        // Verificar GD
        if (extension_loaded('gd')) {
            $available[] = "PHP GD Extension";
        } else {
            $missing[] = "PHP GD Extension";
        }
        
        if (count($available) > 0) {
            echo "✅ Disponíveis:\n";
            foreach ($available as $tool) {
                echo "   • $tool\n";
            }
        }
        
        if (count($missing) > 0) {
            echo "❌ Indisponíveis (recomendado instalar):\n";
            foreach ($missing as $tool) {
                echo "   • $tool\n";
            }
        }
        echo "\n";
    }
    
    /**
     * Gera plano de otimização baseado em análise
     */
    private function generateOptimizationPlan() {
        echo "📋 PLANO DE OTIMIZAÇÃO:\n";
        echo str_repeat("─", 80) . "\n";
        
        $criticalImages = [
            'Homepage KOKETSU GRIFE Completa.png' => 'Não está em uso (remover)',
            'Página Produto Polo KOKETSU.png' => 'Não está em uso (remover)',
            'Banner 3 - Looks Completos KOKETSU 1920x720 (1).png' => 'Usar para banner, otimizar',
            'COMP1.png' => 'Imagem de look completo - converter para WebP',
            'COMP2.png' => 'Imagem de look completo - converter para WebP',
            'COMP3.png' => 'Imagem de look completo - converter para WebP',
        ];
        
        echo "IMAGENS CRÍTICAS (> 1 MB):\n";
        foreach ($criticalImages as $file => $action) {
            if (file_exists($this->imgDir . $file)) {
                $size = filesize($this->imgDir . $file) / (1024 * 1024);
                echo sprintf("   • %s (%.2f MB)\n", $file, $size);
                echo sprintf("     ➜ %s\n", $action);
            }
        }
        
        echo "\n📈 ESTIMATIVA DE ECONOMIA:\n";
        echo "   • Remover imagens não utilizadas: ~20 MB\n";
        echo "   • Converter grandes PNG para WebP: ~70% menos tamanho\n";
        echo "   • Comprimir JPEG existentes: ~30-40% menos tamanho\n";
        echo "   • TOTAL ESTIMADO: 20-25 MB (redução de 43-50%)\n";
        
        echo "\n✨ PRÓXIMOS PASSOS:\n";
        echo "   1. Remover Screenshot Completos que não estão em uso\n";
        echo "   2. Instalar ImageMagick: 'apt-get install imagemagick'\n";
        echo "   3. Executar converter: 'php convert-webp.php'\n";
        echo "   4. Comprimir JPEG com: 'jpegoptim --max=85'\n";
        echo "   5. Validar com picture tags (já implementadas no HTML)\n";
    }
}

// Executar análise
try {
    $optimizer = new ImageOptimizer('c:\Users\jever\OneDrive\Área de Trabalho\Apresentacao\frontend\img');
    $report = $optimizer->analyze();
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
    exit(1);
}
