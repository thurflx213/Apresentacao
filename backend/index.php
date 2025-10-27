<?php
namespace App\Koketsu;
require_once __DIR__ . '/../vendor/autoload.php';
if (!isset($_SESSION)) {
  session_start();
 }
use App\Koketsu\Rotas\Rotas;
use Bramus\Router\Router;


$router = new Router();
$router->setNamespace('\App\Koketsu\Controles');
$router->get('/backend/register', 'AuthController@register');
$router->post('/backend/register', 'AuthController@cadastrarUsuario');
$rotas = [ 
  "GET" => [
 // o caminho da URL o nome do controlle e o metodo do controle 
   //usuarios
   // o caminho da URL    o nome do controlle e o metodo do controle 
        //usuarios
        "/usuario/criar" => "UsuarioController@viewCriarUsuarios",
        "/usuario/listar" => "UsuarioController@viewListarUsuarios",
        "/usuario/listar/{pagina}" => "UsuarioController@viewListarUsuarios",
        "/usuario/editar/{id}" => "UsuarioController@viewEditarUsuarios",
        "/usuario/excluir/{id}" => "UsuarioController@viewExcluirUsuarios",
        "/usuario/{id}/relatorio/{data1}/{data2}" => "UsuarioController@relatorioUsuario",
        '/register' => 'AuthController@register',
        '/login' => 'AuthController@login',
        '/logout' => 'AuthController@logout',
        '/admin/dashboard' => 'Admin\DashboardController@index',

        //Itens pedidos
        "/itenspedidos" => "ItensPedidosController@index",
        "/itenspedidos/criar" => "ItensPedidosController@viewCriarItemPedido",
        "/itenspedidos/listar" => "ItensPedidosController@viewListarItemPedido",
        "/itenspedidos/listar/{pagina}" => "ItensPedidosController@viewlistaritenspedidos",
        "/itenspedidos/editar/{id}" => "ItensPedidosController@viewEditarItemPedido",
        "/itenspedidos/excluir/{id}" => "ItensPedidosController@viewExcluirItemPedido",
        "/itenspedidos/{id}/relatorio/{data1}/{data2}" => "ItensPedidosController@relatorioitenspedidos",
        //Pedidos
        "/pedido" => "PedidosController@index",
        "/pedido/criar" => "PedidosController@viewCriarPedido",
        "/pedido/listar" => "PedidosController@viewListarPedido",
        "/pedido/editar/{id}" => "PedidosController@viewEditarPedido",
        "/pedido/excluir/{id}" => "PedidosController@viewExcluirPedido",
         "/pedido/{id}/relatorio/{data1}/{data2}" => "Pedidos@relatorioPedido",
        //Produtos
        "/produto" => "ProdutosController@index",
        "/produto/criar" => "ProdutosController@viewCriarProduto",
        "/produto/listar" => "ProdutosController@viewlistarProduto",
        "/produto/listar/{pagina}" => "ProdutosController@viewlistarProduto",
        "/produto/editar/{id}" => "ProdutosController@viewEditarProduto",
        "/produto/excluir/{id}" => "ProdutosController@viewExcluirProduto",
        "/produto/{id}/relatorio/{data1}/{data2}" => "ProdutosController@relatorioProduto",
    ],
    "POST" => [
        //usuarios
        "/usuario/salvar" => "UsuarioController@salvarUsuario",
       "/usuario/atualizar/{id}" => "UsuarioController@atualizarUsuario",
       "/usuario/deletar/{id}" => "UsuarioController@deletarUsuario",
        '/register' => 'AuthController@cadastrarUsuario',
       '/login' => 'AuthController@authenticar',
        //itens pedidos
       "/itenspedidos/salvar" => "ItensPedidosController@salvarItemPedido",
       "/itenspedidos/atualizar/{id}" => "ItensPedidosController@atualizarItemPedido",
       "/itenspedidos/deletar/{id}" => "ItensPedidosController@deletarItemPedido",
       //Pedidos
         "/pedido/salvar" => "PedidosController@salvarPedido",
       "/pedido/atualizar/{id}" => "PedidosController@atualizarPedido",
       "/pedido/deletar/{id}" => "PedidosController@deletarPedido",
       //produtos
        "/produto/salvar" => "ProdutosController@salvarProduto",
       "/produto/atualizar/{id}" => "ProdutosController@atualizarProduto",
       "/produto/deletar/{id}" => "ProdutosController@deletarProduto",

  ]
 ];



foreach ($rotas as $metodoHttp => $rota){
 foreach ($rota as $uri => $acao){
 $metodoBramus = strtolower($metodoHttp);
 $router->{$metodoBramus}($uri, $acao);
 }
}

$router->set404(function() {
 header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
 echo '404, Rota não Encontrada!';
});

$router->run();
