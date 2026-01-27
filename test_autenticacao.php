<?php
/**
 * Script para testar autenticação
 */
require_once __DIR__ . '/vendor/autoload.php';

use App\Koketsu\Database\Database;
use App\Koketsu\Models\Usuario;

try {
    $db = Database::getInstance();
    $usuarioModel = new Usuario($db);
    
    // Testar com credenciais de admin
    $email = 'admin@koketsu.com.br';
    $senha = 'admin';
    
    echo "🔐 Testando autenticação...\n";
    echo "Email: $email\n";
    echo "Senha: $senha\n\n";
    
    // Buscar usuário
    $usuarios = $usuarioModel->buscarUsuariosPorEmail($email);
    
    if (empty($usuarios)) {
        echo "❌ Usuário não encontrado no banco!\n";
        echo "\n📊 Usuários cadastrados:\n";
        
        $stmt = $db->prepare("SELECT id_usuarios, email_usuarios, nivel_acesso FROM tbl_usuarios LIMIT 5");
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($users as $user) {
            echo "  - ID: {$user['id_usuarios']}, Email: {$user['email_usuarios']}, Tipo: {$user['nivel_acesso']}\n";
        }
    } else {
        echo "✅ Usuário encontrado!\n";
        $usuario = $usuarios[0];
        
        echo "ID: {$usuario['id_usuarios']}\n";
        echo "Nome: {$usuario['nome_usuarios']}\n";
        echo "Email: {$usuario['email_usuarios']}\n";
        echo "Tipo: {$usuario['nivel_acesso']}\n";
        
        // Testar senha
        if (password_verify($senha, $usuario['senha_usuarios'])) {
            echo "\n✅ Senha CORRETA!\n";
        } else {
            echo "\n❌ Senha INCORRETA!\n";
            echo "Hash no banco: {$usuario['senha_usuarios']}\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "\n";
}
?>
