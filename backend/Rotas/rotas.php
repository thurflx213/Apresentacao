<?php

namespace App\Koketsu\Rotas;

class Rotas
{
    public static function get()
    {
        return [ 
            "GET" => [
        // o caminho da URL    o nome do controlle e o metodo do controle 

        //Avaliação
        "/backend/avaliacao" => "AvaliacaoController@index",
        "/backend/avaliacao/criar" => "AvaliacaoController@viewCriarAvaliacoes",
        "/backend/avaliacao/listar" => "AvaliacaoController@viewListarAvaliacoes",
        "/backend/avaliacao/editar/{id}" => "AvaliacaoController@viewEditarAvaliacoes",
        "/backend/avaliacao/excluir/{id}" => "AvaliacaoController@viewExcluirAvaliacoes",

       //Carrinho
          "/backend/carrinho" => "CarrinhoController@index",
        "/backend/carrinho/criar" => "CarrinhoController@viewCriarCarrinho",
        "/backend/carrinho/listar" => "CarrinhoController@viewListarCarrinho",
        "/backend/carrinho/editar/{id}" => "CarrinhoController@viewEditarCarrinho",
        "/backend/carrinho/excluir/{id}" => "CarrinhoController@viewExcluirCarrinho",

        //Estoque_Movimentação
         "/backend/EstoqueMovimentacao" => "EstoqueController@index",
        "/backend/EstoqueMovimentacao/criar" => "EstoqueController@viewCriarEstoque_Movimentacao",
        "/backend/EstoqueMovimentacao/listar" => "EstoqueController@viewListarEstoque_Movimentacao",
        "/backend/EstoqueMovimentacao/editar/{id}" => "EstoqueController@viewEditarEstoque_Movimentacao",
        "/backend/EstoqueMovimentacao/excluir/{id}" => "EstoqueController@viewExcluirEstoque_Movimentacao",

         //Imagens
         "/backend/Imagens" => "ImagensController@index",
        "/backend/Imagens/criar" => "ImagensController@viewCriarImagem",
        "/backend/Imagens/listar" => "ImagensController@viewListarImagem",
        "/backend/Imagens/editar/{id}" => "ImagensController@viewEditarImagem",
        "/backend/Imagens/excluir/{id}" => "ImagensController@viewExcluirImagem",

        ],
    "POST" => [
        //avaliacao
       "/backend/avaliacao/salvar" => "AvaliacaoController@salvarAvaliacao",
       "/backend/avaliacao/atualizar/{id}" => "AvaliacaoController@atualizarAvaliacao",
       "/backend/avaliacao/deletar/{id}" => "AvaliacaoController@deletarAvaliacao",
        
       //carrinho
       "/backend/carrinho/salvar" => "CarrinhoController@salvarCarrinho",
       "/backend/carrinho/atualizar/{id}" => "CarrinhoController@atualizarCarrinho",
       "/backend/carrinho/deletar/{id}" => "CarrinhoController@deletarCarrinho",

       //EstoqueMovimentacao
       "/backend/EstoqueMovimentacao/salvar" => "EstoqueController@salvarEstoque_Movimentacao",
       "/backend/EstoqueMovimentacao/atualizar/{id}" => "EstoqueController@atualizarEstoque_Movimentacao",
       "/backend/EstoqueMovimentacao/deletar/{id}" => "EstoqueController@deletarEstoque_Movimentacao",

        //imagens
         "/backend/Imagem/salvar" => "ImagensController@salvarImagens",
       "/backend/Imagem/atualizar/{id}" => "ImagensController@atualizarImagens",
       "/backend/Imagem/deletar/{id}" => "ImagensController@deletarImagens",

            ]
        ];
    }
}
