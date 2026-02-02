<?php
namespace App\Koketsu;
require_once __DIR__ . '/../vendor/autoload.php';
use App\Koketsu\Rotas\Rotas;
if (!isset($_SESSION)) {
    session_start();
}

use Bramus\Router\Router;     
$router = new Router();

$rotas = Rotas::get();
$router->setNamespace('App\Koketsu\Controles');
$router->get('/backend/relatorios', 'Admin\RelatoriosController@index');
$router->get('/backend/relatorios/detalhado', 'Admin\RelatoriosController@relatorioDetalhado');
$router->get('/backend/relatorios/financeiro', 'Admin\RelatoriosController@relatorioFinanceiro');
$router->get('/backend/relatorios/produtos', 'Admin\RelatoriosController@relatorioProdutos');
$router->get('/backend/register', 'AuthController@register');
$router->post('/backend/pedido/listar', 'PedidosController@pesquisarPedido');
$router->get('/backend/pedido/listar', 'PedidosController@viewListarPedido'); 

foreach ($rotas as $metodohttp => $rota) {
    foreach ($rota as $uri => $acao) {
        $metodoBramus = strtolower($metodohttp);
        $router->{$metodoBramus}($uri, $acao);
    }
}
$router->set404(function() {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo '404, rota não encontrada';
});

$router->run();