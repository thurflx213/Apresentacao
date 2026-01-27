<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;

try {
    $db = Database::getInstance();
    
    // Testar conexão
    $stmt = $db->prepare("SELECT 1");
    $stmt->execute();
    
    echo "✅ Conexão com banco de dados estabelecida com sucesso!\n\n";
    
    // Listar tabelas
    $stmt = $db->prepare("SHOW TABLES");
    $stmt->execute();
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    echo "📊 Tabelas no banco de dados:\n";
    foreach ($tables as $table) {
        echo "  ✓ $table\n";
    }
    
    echo "\n✨ Projeto pronto para usar!\n";
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
?>
