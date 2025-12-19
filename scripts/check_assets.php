<?php
$base = 'http://localhost:8000';
$pages = [
    '/produto.html',
    '/produto-detalhes.html',
    '/index.html',
    '/carrinho.html',
    '/usuario/criar',
    '/politica.html',
    '/duvidas.html',
    '/sobre.html',
    '/Trocas.html'
];

function resolve_url($base, $page, $asset) {
    if (preg_match('#^https?://#i', $asset)) return $asset;
    if (strpos($asset, '/') === 0) return rtrim($base, '/') . $asset;
    $pageDir = dirname($page);
    if ($pageDir === '.' || $pageDir === '/') {
        return rtrim($base, '/') . '/' . ltrim($asset, '/');
    }
    return rtrim($base, '/') . rtrim($pageDir, '/') . '/' . ltrim($asset, '/');
}

function encode_url_path($url) {
    $parts = parse_url($url);
    if (!$parts) return $url;
    $scheme = $parts['scheme'] ?? 'http';
    $host = $parts['host'] ?? '';
    $port = isset($parts['port']) ? ':' . $parts['port'] : '';
    $path = $parts['path'] ?? '';
    $segments = explode('/', $path);
    $encoded = array_map(function($s){ return rawurlencode($s); }, $segments);
    $pathEnc = implode('/', $encoded);
    // preserve leading slash
    if (substr($path,0,1) === '/') $pathEnc = '/' . ltrim($pathEnc, '/');
    $query = isset($parts['query']) ? '?' . $parts['query'] : '';
    return $scheme . '://' . $host . $port . $pathEnc . $query;
}

$report = [];
foreach ($pages as $page) {
    $url = $base . $page;
    echo "Fetching $url\n";
    $html = @file_get_contents($url);
    if ($html === false) {
        $report[$page] = [ 'error' => "Falha ao obter $url" ];
        continue;
    }
    $dom = new DOMDocument();
    @$dom->loadHTML($html);
    $assets = [];
    foreach ($dom->getElementsByTagName('link') as $link) {
        $rel = $link->getAttribute('rel');
        if (stripos($rel, 'stylesheet') !== false) $assets[] = $link->getAttribute('href');
    }
    foreach ($dom->getElementsByTagName('script') as $script) {
        $src = $script->getAttribute('src');
        if ($src) $assets[] = $src;
    }
    foreach ($dom->getElementsByTagName('img') as $img) {
        $src = $img->getAttribute('src');
        if ($src) $assets[] = $src;
    }

    $pageReport = [];
    foreach ($assets as $asset) {
        $final = resolve_url($base, $page, $asset);
        $final = preg_replace('#([^:])/+#', '$1/', $final);
        if (preg_match('#^https?://#i', $final) && strpos($final, 'localhost') === false) {
            $finalEnc = $final; // don't encode external URLs
        } else {
            $finalEnc = encode_url_path($final);
        }
        $headers = @get_headers($finalEnc);
        $status = $headers ? $headers[0] : 'Sem resposta';
        $pageReport[] = [ 'asset' => $asset, 'url' => $finalEnc, 'status' => $status ];
    }
    $report[$page] = $pageReport;
}

// Print report
foreach ($report as $page => $data) {
    echo "\n== Página: $page ==\n";
    if (isset($data['error'])) {
        echo "  ERRO: " . $data['error'] . "\n";
        continue;
    }
    foreach ($data as $item) {
        echo "  " . $item['asset'] . " -> " . $item['url'] . " -> " . $item['status'] . "\n";
    }
}

echo "\nRelatório gerado.\n";
