<?php
namespace App\Koketsu;
require __DIR__ ."/../vendor/autoload.php";
use App\Koketsu\Rotas\Rotas;

use Bramus\Router\Router;
$router = new Router();

$rotas = Rotas::get();
$router->setNamespace('\App\Koketsu\Controllers');
                    //metodoHttp =GET POST    rota= URL
foreach ($rotas as $metodoHttp => $rota) {
    foreach ($rota as $uri => $acao) {
        $metodoBramus = strtolower($metodoHttp);
        $router->{$metodoBramus}($uri, $acao); //a mágica acontece aqui
    }
}
$router->set404(function () {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, Rota não Encontrada!';
});

$router->run();