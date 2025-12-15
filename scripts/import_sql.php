<?php
// Script simples para importar um dump SQL via PDO (usa config do projeto)
require_once __DIR__ . '/../vendor/autoload.php';

use App\Koketsu\Database\Config;
use App\Koketsu\Database\Database;

echo "Importador SQL iniciado\n";
$config = Config::get();
try {
    $pdo = Database::getConnection();
} catch (Throwable $e) {
    echo "Erro ao obter conexão PDO: " . $e->getMessage() . "\n";
    exit(1);
}

$sqlFile = __DIR__ . '/../.vscode/koketsu.sql';
if (!file_exists($sqlFile)) {
    echo "Arquivo SQL não encontrado: $sqlFile\n";
    exit(1);
}

$content = file_get_contents($sqlFile);
if ($content === false) {
    echo "Falha ao ler o arquivo SQL\n";
    exit(1);
}

// Remover linhas de comentário iniciadas por -- para evitar statements vazios
$lines = preg_split("/\r?\n/", $content);
$filtered = [];
foreach ($lines as $line) {
    $trim = trim($line);
    if ($trim === '' ) continue;
    if (strpos($trim, '--') === 0) continue;
    $filtered[] = $line;
}
$content = implode("\n", $filtered);

// Separar por ponto e vírgula seguido de quebra de linha (aproximação simples)
$statements = preg_split('/;\s*\n/', $content);

echo "Total aproximado de statements: " . count($statements) . "\n";

$failed = 0;
$i = 0;
foreach ($statements as $stmt) {
    $i++;
    $sql = trim($stmt);
    if ($sql === '') continue;
    // Adiciona ; se necessário para execução de algumas engines (não obrigatório)
    try {
        $pdo->exec($sql);
    } catch (PDOException $e) {
        $failed++;
        echo "[ERRO] Statement #$i: " . substr($sql, 0, 200) . "...\n";
        echo "       PDOException: " . $e->getMessage() . "\n";
    }
}

echo "Import finished. Failed statements: $failed\n";

if ($failed > 0) exit(2);
exit(0);
