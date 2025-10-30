<?php

namespace App\Koketsu\Rotas;

class Rotas
{
    public static function get()
    {
        return [ 
            "GET" => [
        // o caminho da URL o nome do controlle e o metodo do controle 

          '/register' => 'AuthController@register',
          '/login' => 'AuthController@login',
          '/logout' => 'AuthController@logout',
         '/admin/dashboard' => 'Admin\DashboardController@index',
                '/api/produtos' => 'PublicApiController@getProdutos',

        //Avaliação
        "/backend/avaliacao" => "AvaliacaoController@index",
        "/backend/avaliacao/criar" => "AvaliacaoController@viewCriarAvaliacao", 
        "/backend/avaliacao/listar" => "AvaliacaoController@viewListaravaliacao",
        "/backend/avaliacao/editar/{id}" => "AvaliacaoController@viewEditarAvaliacao", 
        "/backend/avaliacao/excluir/{id}" => "AvaliacaoController@viewExcluirAvaliacao",

       //Carrinho
          "/backend/carrinho" => "CarrinhoController@index",
        "/backend/carrinho/criar" => "CarrinhoController@viewCriarCarrinho",
        "/backend/carrinho/listar" => "CarrinhoController@viewListarCarrinho",
        "/backend/carrinho/editar/{id}" => "CarrinhoController@viewEditarCarrinho",
        "/backend/carrinho/excluir/{id}" => "CarrinhoController@viewExcluirCarrinho",

         //Imagens
         "/backend/Imagens" => "ImagemController@index",
        "/backend/Imagens/criar" => "ImagemController@viewCriarImagem",
        "/backend/Imagens/listar" => "ImagemController@viewListarImagens",
        "/backend/Imagens/editar/{id}" => "ImagemController@viewEditarImagem",
        "/backend/Imagens/excluir/{id}" => "ImagemController@viewExcluirImagem",

        ],
    "POST" => [

        '/api/pedidos' => 'PublicApiController@salvarPedido',

        //avaliacao
       "/backend/avaliacao/salvar" => "AvaliacaoController@salvarAvaliacao",
       "/backend/avaliacao/atualizar/{id}" => "AvaliacaoController@atualizarAvaliacao",
       "/backend/avaliacao/deletar/{id}" => "AvaliacaoController@deletarAvaliacao",
        
       //carrinho
       "/backend/carrinho/salvar" => "CarrinhoController@salvarCarrinho",
       "/backend/carrinho/atualizar/{id}" => "CarrinhoController@atualizarCarrinho",
       "/backend/carrinho/deletar/{id}" => "CarrinhoController@deletarCarrinho",
       "/backend/carrinho/edit/{id}" => "CarrinhoController@viewEditCarrinho",

        //imagens
        "/backend/Imagens/salvar" => "ImagemController@salvarImagem",
       "/backend/Imagens/atualizar/{id}" => "ImagemController@atualizarImagem",
       "/backend/Imagens/deletar/{id}" => "ImagemController@deletarImagem",

         //autenticação
       '/register' => 'AuthController@cadastrarUsuario',
        '/login' => 'AuthController@authenticar',


            ]
        ];
    }
}
