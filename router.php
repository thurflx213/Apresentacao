<?php
// router.php

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$frontendDir = __DIR__ . '/frontend';
$pagesDir = $frontendDir . '/pages';

// Se a rota for a raiz, serve o index.html da pasta pages
if ($path === '/' || $path === '') {
    $indexPath = $pagesDir . '/index.html';
    if (file_exists($indexPath)) {
        include $indexPath;
        return true;
    }
}

// Se for uma página HTML, tenta servir a partir de frontend/pages
if (substr($path, -5) === '.html') {
    $pagePath = $pagesDir . $path;
    if (file_exists($pagePath)) {
        include $pagePath;
        return true;
    }
}

// Serve arquivos estáticos a partir de frontend (css, js, imagens)
$requestedPath = realpath($frontendDir . $path);
$frontendRoot = realpath($frontendDir);
if ($requestedPath && $frontendRoot && strpos($requestedPath, $frontendRoot) === 0 && is_file($requestedPath)) {
    $ext = strtolower(pathinfo($requestedPath, PATHINFO_EXTENSION));
    $mimeTypes = [
        'css' => 'text/css',
        'js' => 'application/javascript',
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'webp' => 'image/webp',
        'svg' => 'image/svg+xml',
        'gif' => 'image/gif',
        'woff' => 'font/woff',
        'woff2' => 'font/woff2'
    ];
    if (isset($mimeTypes[$ext])) {
        header('Content-Type: ' . $mimeTypes[$ext]);
    }
    readfile($requestedPath);
    return true;
}

// Se a rota for para a API ou Backend, redireciona para o index do backend
if (strpos($path, '/api/') === 0 || strpos($path, '/backend/') === 0 || strpos($path, '/admin/') === 0 || strpos($path, '/login') === 0 || strpos($path, '/register') === 0) {
    // Corrige o path para o router Bramus funcionar corretamente
    // O Bramus espera que a execução venha do index.php, então o base folder pode confundir
    // Mas vamos apenas incluir o backend/index.php
    require_once __DIR__ . '/backend/index.php';
    exit;
}

// Para qualquer outra coisa não encontrada, 404
http_response_code(404);
echo "404 Not Found";
