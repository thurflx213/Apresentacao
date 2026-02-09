<?php
$files = glob("*.html");
$header = '<?php
$configFile = __DIR__ . "/backend/Config/settings.json";
if (file_exists($configFile)) {
    $config = json_decode(file_get_contents($configFile), true);
    if (!empty($config["manutencao"])) {
        if (!isset($_SESSION)) session_start();
        if (($_SESSION["usuario_tipo"] ?? "") !== "admin") {
            include __DIR__ . "/backend/Views/Templates/manutencao.php";
            exit;
        }
    }
}
?>';

foreach ($files as $file) {
    echo "Processing $file...\n";
    $content = file_get_contents($file);
    // Replace .html links with .php links
    $content = str_replace('.html', '.php', $content);
    $newName = str_replace('.html', '.php', $file);
    file_put_contents($newName, $header . $content);
    unlink($file);
}
echo "Done!\n";
