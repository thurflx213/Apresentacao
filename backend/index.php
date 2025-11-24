<?php
// Front controller do backend
// Carrega o autoloader gerado pelo Composer
require __DIR__ . '/../vendor/autoload.php';

use App\Koketsu\Rotas\Rotas;

$router = new \Bramus\Router\Router();

$rotas = Rotas::get();
$router->setNamespace('App\\Koketsu\\Controles');

// Rota de teste simples
$router->get('/teste', function() {
    echo "✅ Rota de teste funcionando!";
});

foreach ($rotas as $metodoHttp => $rota) {
    foreach ($rota as $uri => $acao) {
        $metodo = strtolower($metodoHttp);
        $router->{$metodo}($uri, $acao);
    }
}

$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, Rota não Encontrada!';
});

$router->run();