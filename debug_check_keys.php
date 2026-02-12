<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();
echo "--- DEBUG KEYS ---\n";

$stmt = $db->query("SELECT * FROM tbl_perfil LIMIT 1");
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    print_r(array_keys($row));
} else {
    echo "Tabela vazia.\n";
}
echo "--- FIM ---\n";
