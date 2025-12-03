<?php

namespace App\Koketsu\Rotas;

class Rotas
{
    public static function get()
    {
       
        return [ 
             "GET" => [
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
        '/api/usuarios' => 'APIUsuarioController@getUsuarios',
        '/api/usuarios/{pagina}' => 'APIUsuarioController@getUsuarios',

        //Itens pedidos
        "/itenspedidos" => "ItensPedidosController@index",
        "/itenspedidos/criar" => "ItensPedidosController@viewCriarItemPedido",
        "/itenspedidos/listar" => "ItensPedidosController@viewListarItemPedido",
        "/itenspedidos/listar/{id}" => "ItensPedidosController@viewItemPedidoUnico",
        "/itenspedidos/listar/{pagina}" => "ItensPedidosController@viewlistaritenspedidos",
        "/itenspedidos/editar/{id}" => "ItensPedidosController@viewEditarItemPedido",
        "/itenspedidos/excluir/{id}" => "ItensPedidosController@viewExcluirItemPedido",
        "/itenspedidos/{id}/relatorio/{data1}/{data2}" => "ItensPedidosController@relatorioitenspedidos",
        //Pedidos
        "/pedido" => "PedidosController@index",
        "/pedido/criar" => "PedidosController@viewCriarPedidos",
        "/pedido/listar" => "PedidosController@viewListarPedido",
        "/pedido/listar/{id}" => "PedidosController@viewPedidoUnico",
        "/pedido/editar/{id}" => "PedidosController@viewEditarPedido",
        "/pedido/excluir/{id}" => "PedidosController@viewExcluirPedido",
         "/pedido/{id}/relatorio/{data1}/{data2}" => "Pedidos@relatorioPedido",
          
        //Produtos
        "/produto" => "ProdutosController@index",
        "/produto/criar" => "ProdutosController@viewCriarProduto",
        "/produto/listar" => "ProdutosController@viewlistarProduto",
        "/produto/listar/{id}" => "ProdutosController@viewProdutoUnico",
        "/produto/listar/{pagina}" => "ProdutosController@viewlistarProduto",
        "/produto/editar/{id}" => "ProdutosController@viewEditarProdutos",
        "/produto/excluir/{id}" => "ProdutosController@viewExcluirProduto",
        "/produto/{id}/relatorio/{data1}/{data2}" => "ProdutosController@relatorioProduto",
        "/relatorios" => "RelatoriosController@exibirRelatorios",
        '/api/produtos' => 'PublicApiController@getProdutos',
        
    ],
    "POST" => [
        //usuarios
        "/usuario/salvar" => "UsuarioController@salvarUsuario",
       "/usuario/atualizar/{id}" => "UsuarioController@atualizarUsuario",
       "/usuario/deletar/{id}" => "UsuarioController@deletarUsuario",
        '/register' => 'AuthController@cadastrarUsuario',
       '/login' => 'AuthController@authenticar',
        '/api/usuarios' => 'APIUsuarioController@getUsuarios',
        '/api/usuarios/{pagina}' => 'APIUsuarioController@getUsuarios',
        //itens pedidos
       "/itenspedidos/salvar" => "ItensPedidosController@salvarItemPedido",
       "/itenspedidos/atualizar/{id}" => "ItensPedidosController@atualizarItemPedido",
       "/itenspedidos/deletar/{id}" => "ItensPedidosController@deletarItemPedido",
       //Pedidos
         "/pedido/salvar" => "PedidosController@salvarPedido",
       "/pedido/atualizar/{id}" => "PedidosController@atualizarPedidos",
       "/pedido/deletar/{id}" => "PedidosController@viewExcluirPedido",
        "/backend/pedido/listar" => "PedidosController@pesquisarPedido",
       //produtos
        "/produto/salvar" => "ProdutosController@salvarProduto",
       "/produto/atualizar/{id}" => "ProdutosController@atualizarProdutos",
       "/produto/deletar/{id}" => "ProdutosController@viewExcluirProduto",
        '/api/produtos' => 'PublicApiController@getProdutos',
    // Post para cadastro
       "/register" => "AuthController@cadastrarUsuario", 
  ]
 ];
    }
}
