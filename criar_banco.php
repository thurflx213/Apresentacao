<?php
/**
 * Script para criar o banco de dados automaticamente
 * Execute: php criar_banco.php
 */

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'koketsu';

try {
    // Conectar ao MySQL sem especificar banco de dados
    $conn = new PDO("mysql:host={$host}", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✓ Conectado ao MySQL\n";
    
    // Criar banco de dados
    $conn->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Banco de dados 'koketsu' criado ou já existe\n";
    
    // Selecionar banco de dados
    $conn->exec("USE `{$database}`");
    
    // Criar tabelas diretamente
    $tables = [
        "DROP TABLE IF EXISTS tbl_usuarios",
        "CREATE TABLE tbl_usuarios (
          id_usuarios INT PRIMARY KEY AUTO_INCREMENT,
          nome_usuarios VARCHAR(255) NOT NULL,
          email_usuarios VARCHAR(255) NOT NULL UNIQUE,
          senha_usuarios VARCHAR(255) NOT NULL,
          nivel_acesso ENUM('admin', 'usuario', 'moderador') DEFAULT 'usuario',
          excluido_em DATETIME NULL,
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
          atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_categorias",
        "CREATE TABLE tbl_categorias (
          id_categorias INT PRIMARY KEY AUTO_INCREMENT,
          nome_categorias VARCHAR(255) NOT NULL,
          descricao_categorias TEXT,
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
          atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_tamanhos",
        "CREATE TABLE tbl_tamanhos (
          id_tamanhos INT PRIMARY KEY AUTO_INCREMENT,
          tamanho VARCHAR(50) NOT NULL,
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_cores",
        "CREATE TABLE tbl_cores (
          id_cores INT PRIMARY KEY AUTO_INCREMENT,
          cor_cores VARCHAR(100) NOT NULL,
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_perfis",
        "CREATE TABLE tbl_perfis (
          id_perfis INT PRIMARY KEY AUTO_INCREMENT,
          nome_perfis VARCHAR(255) NOT NULL,
          descricao_perfis TEXT,
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_produtos",
        "CREATE TABLE tbl_produtos (
          id_produtos INT PRIMARY KEY AUTO_INCREMENT,
          nome_produtos VARCHAR(255) NOT NULL,
          descricao_produtos TEXT,
          preco_produtos DECIMAL(10, 2),
          id_categorias INT,
          id_tamanhos INT,
          id_cores INT,
          imagem_url VARCHAR(255),
          estoque INT DEFAULT 0,
          ativo BOOLEAN DEFAULT TRUE,
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
          atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_imagens",
        "CREATE TABLE tbl_imagens (
          id_imagens INT PRIMARY KEY AUTO_INCREMENT,
          id_produtos INT,
          url_imagens VARCHAR(255) NOT NULL,
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_pedidos",
        "CREATE TABLE tbl_pedidos (
          id_pedidos INT PRIMARY KEY AUTO_INCREMENT,
          id_usuarios INT NOT NULL,
          id_perfis INT NOT NULL,
          data_pedido DATE,
          total_pedido DECIMAL(10, 2),
          status_pedido ENUM('pendente', 'confirmado', 'enviado', 'entregue', 'cancelado') DEFAULT 'pendente',
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP,
          atualizado_em DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_itens_pedidos",
        "CREATE TABLE tbl_itens_pedidos (
          id_itens_pedidos INT PRIMARY KEY AUTO_INCREMENT,
          id_pedidos INT NOT NULL,
          id_produtos INT NOT NULL,
          quantidade INT NOT NULL,
          preco_unitario DECIMAL(10, 2),
          nome_produto VARCHAR(255),
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_avaliacoes",
        "CREATE TABLE tbl_avaliacoes (
          id_avaliacoes INT PRIMARY KEY AUTO_INCREMENT,
          id_usuarios INT NOT NULL,
          id_produtos INT NOT NULL,
          nota INT,
          comentario TEXT,
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "DROP TABLE IF EXISTS tbl_estoque_movimentacao",
        "CREATE TABLE tbl_estoque_movimentacao (
          id_estoque_movimentacao INT PRIMARY KEY AUTO_INCREMENT,
          id_produtos INT NOT NULL,
          tipo_movimentacao ENUM('entrada', 'saida') NOT NULL,
          quantidade INT NOT NULL,
          motivo VARCHAR(255),
          criado_em DATETIME DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
        
        "INSERT IGNORE INTO tbl_usuarios (nome_usuarios, email_usuarios, senha_usuarios, nivel_acesso, criado_em) 
         VALUES ('Admin Koketsu', 'admin@koketsu.com.br', '\$2y\$10\$N9qo8uLOickgx2ZMRZoMyeIjZAgcg7b3XeKeUxWdeS86E36P4/TVm', 'admin', NOW())",
    ];
    
    foreach ($tables as $sql) {
        try {
            $conn->exec($sql);
            echo "✓ " . substr(trim($sql), 0, 40) . "...\n";
        } catch (Exception $e) {
            echo "⚠ Aviso: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n✅ Banco de dados criado com sucesso!\n";
    echo "📊 Tabelas criadas:\n";
    echo "  - tbl_usuarios\n";
    echo "  - tbl_categorias\n";
    echo "  - tbl_tamanhos\n";
    echo "  - tbl_cores\n";
    echo "  - tbl_perfis\n";
    echo "  - tbl_produtos\n";
    echo "  - tbl_imagens\n";
    echo "  - tbl_pedidos\n";
    echo "  - tbl_itens_pedidos\n";
    echo "  - tbl_avaliacoes\n";
    echo "  - tbl_estoque_movimentacao\n";
    echo "\n👤 Usuário admin criado:\n";
    echo "  Email: admin@koketsu.com.br\n";
    echo "  Senha: admin\n";
    
} catch (PDOException $e) {
    die("❌ Erro de conexão: " . $e->getMessage() . "\n");
}
?>
