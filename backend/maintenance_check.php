<?php
$configFile = __DIR__ . '/backend/Config/settings.json';
if (file_exists($configFile)) {
    $config = json_decode(file_get_contents($configFile), true);
    if (!empty($config['manutencao'])) {
        // Permitir admin logar
        if (!isset($_SESSION)) session_start();
        if (($_SESSION['usuario_tipo'] ?? '') !== 'admin') {
            include __DIR__ . '/backend/Views/Templates/manutencao.php';
            exit;
        }
    }
}
?>
