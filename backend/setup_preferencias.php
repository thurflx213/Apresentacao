<?php
require_once __DIR__ . '/Database/Config.php';
require_once __DIR__ . '/Database/database.php';

use App\Koketsu\Database\Database;

try {
    $db = Database::getInstance();
    
    $sql = "CREATE TABLE IF NOT EXISTS tbl_preferencias (
        id_preferencia INT AUTO_INCREMENT PRIMARY KEY,
        id_usuarios INT NOT NULL,
        tamanho_camiseta VARCHAR(5),
        tamanho_calca VARCHAR(5),
        tamanho_calcado VARCHAR(5),
        notif_pedidos TINYINT(1) DEFAULT 1,
        notif_ofertas TINYINT(1) DEFAULT 1,
        notif_whatsapp TINYINT(1) DEFAULT 0,
        dois_fatores_ativo TINYINT(1) DEFAULT 0,
        atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (id_usuarios) REFERENCES tbl_usuarios(id_usuarios) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    
    $db->exec($sql);
    echo "Tabela 'tbl_preferencias' criada ou já existente com sucesso!\n";
    
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage() . "\n";
    exit(1);
}
