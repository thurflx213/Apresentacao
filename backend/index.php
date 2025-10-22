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
$rotas = [ 
  "GET" => [
 // o caminho da URL o nome do controlle e o metodo do controle 
   //usuarios
  "/usuarios" => "UsuarioController@index",
  "/usuario/criar" => "UsuarioController@viewCriarUsuarios",
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
 "/itenspedidos/{id}" => "ItensPedidosController@viewItemPedidoUnico",
 "/itenspedidos/criar" => "ItensPedidosController@viewCriarItemPedido",
 "/itenspedidos/listar/{pagina}" => "ItensPedidosController@viewListarItemPedido",
 "/itenspedidos/editar/{id}" => "ItensPedidosController@viewEditarItemPedido",
 "/itenspedidos/excluir/{id}" => "ItensPedidosController@viewExcluirItemPedido",
 "/itenspedidos/{id}/relatorio/{data1}/{data2}" => "ItensPedidosController@relatorioitenspedidos",
 
 //Pedidos
 "/pedido" => "PedidosController@index",
 "/pedido/{id}" => "PedidosController@viewPedidoUnico",
 "/pedido/criar" => "PedidosController@viewCriarPedido",
 "/pedido/listar/{pagina}" => "PedidosController@viewListarPedido",
 "/pedido/editar/{id}" => "PedidosController@viewEditarPedido",
 "/pedido/excluir/{id}" => "PedidosController@viewExcluirPedido",
 "/pedido/{id}/relatorio/{data1}/{data2}" => "Pedidos@relatorioPedido",
 
 //Produtos
 "/produto" => "ProdutosController@index",
 "/produto/{id}" => "ProdutosController@viewProdutoUnico", 
 "/produto/criar" => "ProdutosController@viewCriarProduto",
 "/produto/listar/{pagina}" => "ProdutosController@viewlistarProduto",
 "/produto/editar/{id}" => "ProdutosController@viewEditarProduto",
 "/produto/excluir/{id}" => "ProdutosController@viewExcluirProdutos",
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
