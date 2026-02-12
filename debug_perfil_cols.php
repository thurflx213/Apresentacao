<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();

echo "--- DEBUG COLS ---\n";

$tables = ['tbl_perfil', 'tbl_usuarios', 'tbl_avaliacoes'];

foreach($tables as $t) {
    echo "Tabela: $t\n";
    try {
        $stmt = $db->query("DESCRIBE $t");
        $cols = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($cols as $c) {
            echo " - {$c['Field']} ({$c['Type']})\n";
        }
    } catch (Exception $e) {
        echo "Erro ao descrever tabela: " . $e->getMessage() . "\n";
    }
    echo "\n";
}
