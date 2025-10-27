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
          "/backend/carrinho" => "CarrinhoControllers@index",
        "/backend/carrinho/criar" => "CarrinhoControllers@viewCriarCarrinho",
        "/backend/carrinho/listar" => "CarrinhoControllers@viewListarCarrinho",
        "/backend/carrinho/editar/{id}" => "CarrinhoControllers@viewEditarCarrinho",
        "/backend/carrinho/excluir/{id}" => "CarrinhoControllers@viewExcluirCarrinho",

        //Estoque_Movimentação
         "/backend/EstoqueMovimentacao" => "Estoque_MovimentacaoControllers@index",
        "/backend/EstoqueMovimentacao/criar" => "Estoque_MovimentacaoControllers@viewCriarEstoque_Movimentacao",
        "/backend/EstoqueMovimentacao/listar" => "Estoque_MovimentacaoControllers@viewListarEstoque_Movimentacao",
        "/backend/EstoqueMovimentacao/editar/{id}" => "Estoque_MovimentacaoControllers@viewEditarEstoque_Movimentacao",
        "/backend/EstoqueMovimentacao/excluir/{id}" => "Estoque_MovimentacaoControllers@viewExcluirEstoque_Movimentacao",

         //Imagens
         "/backend/Imagens" => "ImagemControllers@index",
        "/backend/Imagens/criar" => "ImagemControllers@viewCriarImagem",
        "/backend/Imagens/listar" => "ImagemControllers@viewListarImagens",
        "/backend/Imagens/editar/{id}" => "ImagemControllers@viewEditarImagem",
        "/backend/Imagens/excluir/{id}" => "ImagemControllers@viewExcluirImagem",

        ],
    "POST" => [

        '/api/pedidos' => 'PublicApiController@salvarPedido',

        //avaliacao
       "/backend/avaliacao/salvar" => "AvaliacaoController@salvarAvaliacao",
       "/backend/avaliacao/atualizar/{id}" => "AvaliacaoController@atualizarAvaliacao",
       "/backend/avaliacao/deletar/{id}" => "AvaliacaoController@deletarAvaliacao",
        
       //carrinho
       "/backend/carrinho/salvar" => "CarrinhoControllers@salvarCarrinho",
       "/backend/carrinho/atualizar/{id}" => "CarrinhoControllers@atualizarCarrinho",
       "/backend/carrinho/deletar/{id}" => "CarrinhoControllers@deletarCarrinho",

       //EstoqueMovimentacao
       "/backend/EstoqueMovimentacao/salvar" => "Estoque_MovimentacaoControllers@salvarEstoqueMovimentacao",
       "/backend/EstoqueMovimentacao/atualizar/{id}" => "Estoque_MovimentacaoControllers@atualizarEstoqueMovimentacao",
       "/backend/EstoqueMovimentacao/deletar/{id}" => "Estoque_MovimentacaoControllers@deletarEstoqueMovimentacao",

        //imagens
        "/backend/Imagem/salvar" => "ImagemControllers@salvarImagem",
       "/backend/Imagem/atualizar/{id}" => "ImagemControllers@atualizarImagem",
       "/backend/Imagem/deletar/{id}" => "ImagemControllers@deletarImagem",

         //autenticação
       '/register' => 'AuthController@cadastrarUsuario',
        '/login' => 'AuthController@authenticar',


            ]
        ];
    }
}