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

        //Itens pedidos
        "/itenspedidos" => "ItensPedidosController@index",
        "/itenspedidos/criar" => "ItensPedidosController@viewCriarItemPedido",
        "/itenspedidos/listar" => "ItensPedidosController@viewListarItemPedido",
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
        "/produto/criar" => "ProdutosController@viewCriarProdutos",
        "/produto/listar" => "ProdutosController@viewListarProdutos",
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
    }
}
