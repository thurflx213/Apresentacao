<?php
/**
 * Script para criar/resetar usuário admin
 */
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;

try {
    $db = Database::getInstance();
    
    echo "🔐 Criando/Resetando usuário admin...\n\n";
    
    // Senha admin
    $senha = password_hash('admin', PASSWORD_DEFAULT);
    
    // Primeiro, deletar se existir
    $sql_delete = "DELETE FROM tbl_usuarios WHERE email_usuarios = 'admin@koketsu.com.br'";
    $db->exec($sql_delete);
    echo "✅ Usuário anterior removido (se existia)\n";
    
    // Inserir novo usuário admin
    $sql = "INSERT INTO tbl_usuarios (nome_usuarios, email_usuarios, senha_usuarios, nivel_acesso, foto_usuarios, criado_em) 
            VALUES ('Admin Koketsu', 'admin@koketsu.com.br', :senha, 'admin', '/img/logoperf.jpg', NOW())";
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':senha', $senha);
    
    if ($stmt->execute()) {
        echo "✅ Usuário admin criado com sucesso!\n\n";
        echo "📋 Credenciais de Login:\n";
        echo "   Email: admin@koketsu.com.br\n";
        echo "   Senha: admin\n";
    } else {
        echo "❌ Erro ao criar usuário!\n";
    }
    
    // Listar usuários
    echo "\n📊 Usuários no banco:\n";
    $stmt = $db->prepare("SELECT id_usuarios, nome_usuarios, email_usuarios, nivel_acesso FROM tbl_usuarios ORDER BY id_usuarios");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($usuarios as $user) {
        echo "  ID {$user['id_usuarios']}: {$user['nome_usuarios']} ({$user['email_usuarios']}) - {$user['nivel_acesso']}\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
?>
