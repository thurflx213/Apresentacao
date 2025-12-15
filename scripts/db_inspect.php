<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\Koketsu\Database\Database;

echo "DB inspect started\n";
try {
    $pdo = Database::getConnection();
} catch (Throwable $e) {
    echo "Failed to get connection: " . $e->getMessage() . "\n";
    exit(1);
}

$tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
if (!$tables) {
    echo "No tables found.\n";
    exit(0);
}

echo "Found " . count($tables) . " tables:\n";
foreach ($tables as $t) {
    try {
        $cnt = $pdo->query("SELECT COUNT(*) as c FROM `$t`")->fetch(PDO::FETCH_ASSOC)['c'];
    } catch (Exception $e) {
        $cnt = 'error';
    }
    printf("- %s: %s rows\n", $t, $cnt);
}

exit(0);
