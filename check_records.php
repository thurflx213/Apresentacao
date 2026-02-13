<?php
require_once __DIR__ . '/vendor/autoload.php';
use App\Koketsu\Database\Database;

$db = Database::getInstance();
$stmt = $db->query("SELECT count(*) FROM tbl_preferencias");
$count = $stmt->fetchColumn();
echo "Total records in tbl_preferencias: $count\n";

if ($count > 0) {
    $stmt = $db->query("SELECT * FROM tbl_preferencias LIMIT 5");
    var_dump($stmt->fetchAll(PDO::FETCH_ASSOC));
}
