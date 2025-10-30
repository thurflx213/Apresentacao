<?php
namespace App\Koketsu;
require __DIR__ ."/../vendor/autoload.php";
use App\Koketsu\Rotas\Rotas;

use Bramus\Router\Router;
$router = new \Bramus\Router\Router();

$rotas = Rotas::get();
$router->setNamespace('\App\Koketsu\Controllers');
                   
foreach ($rotas as $metodoHttp => $rota) {
    foreach ($rota as $uri => $acao) {
        $metodoBramus = strtolower($metodoHttp);
        $router->{$metodoBramus}($uri, $acao); 
    }
}
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, Rota não Encontrada!';
});

$router->run();