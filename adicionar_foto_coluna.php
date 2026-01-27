<?php
/**
 * Script para adicionar coluna de foto ao banco de dados
 */

use App\Koketsu\Database\Database;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $db = Database::getInstance();
    
    // Verificar se coluna existe
    $stmt = $db->prepare("SHOW COLUMNS FROM tbl_usuarios LIKE 'foto_usuarios'");
    $stmt->execute();
    
    if ($stmt->rowCount() == 0) {
        // Coluna não existe, adicionar
        $sql = "ALTER TABLE tbl_usuarios ADD COLUMN foto_usuarios VARCHAR(255) NULL DEFAULT '/img/logoperf.jpg' AFTER senha_usuarios";
        $db->exec($sql);
        echo "✅ Coluna 'foto_usuarios' adicionada com sucesso!\n";
    } else {
        echo "✅ Coluna 'foto_usuarios' já existe.\n";
    }
    
    // Listar estrutura da tabela
    $stmt = $db->prepare("DESCRIBE tbl_usuarios");
    $stmt->execute();
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n📊 Estrutura da tabela tbl_usuarios:\n";
    foreach ($columns as $col) {
        echo "  - {$col['Field']}: {$col['Type']}\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
?>
