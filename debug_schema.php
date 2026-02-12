<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();

echo "--- DEBUG SCHEMA ---\n";

$tables = ['tbl_usuarios', 'tbl_perfil', 'tbl_pedidos', 'tbl_itens_pedidos'];

foreach($tables as $t) {
    echo "Tabela: $t\n";
    $stmt = $db->query("DESCRIBE $t");
    $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($cols as $c) {
        echo " - {$c['Field']} ({$c['Type']})\n";
    }
    echo "\n";
}
