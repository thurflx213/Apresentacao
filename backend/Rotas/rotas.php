<?php
namespace App\Koketsu\Rotas;

class Rotas
{
	public static function get()
	{
		return [ 
			"GET" => [
      
		  '/register' => 'AuthController@register',
		  '/login' => 'AuthController@login',
		  '/logout' => 'AuthController@logout',
         
		 '/admin/dashboard' => 'Admin\\DashboardController@index', 
         
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
		 "/backend/imagens" => "ImagemController@index",
		"/backend/imagens/criar" => "ImagemController@viewCriarImagem",
		"/backend/imagens/listar" => "ImagemController@viewListarImagens",
		"/backend/imagens/editar/{id}" => "ImagemController@viewEditarImagem",
		"/backend/imagens/excluir/{id}" => "ImagemController@viewExcluirImagem",

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
		"/backend/imagens/salvar" => "ImagemController@salvarImagem",
	   "/backend/imagens/atualizar/{id}" => "ImagemController@atualizarImagem",
	   "/backend/imagens/deletar/{id}" => "ImagemController@deletarImagem",

		 //autenticação
	   '/register' => 'AuthController@cadastrarUsuario',
		'/login' => 'AuthController@authenticar',


			]
		];
	}
}
