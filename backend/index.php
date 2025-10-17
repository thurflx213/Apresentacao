<?php
namespace App;

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

use App\Koketsu\Rotas\Rotas;

use Bramus\Router\Router; // Adicionado: Assumindo o uso do Bramus/Router

// 3. Inicia o roteador
$router = new Router();

// -- Roteamento GET (Rotas de Visualização e Listagem) --

// Avaliação
$router->get('/backend/avaliacao', 'AvaliacaoController@index');
$router->get('/backend/avaliacao/criar', 'AvaliacaoController@viewCriarAvaliacoes');
$router->get('/backend/avaliacao/listar', 'AvaliacaoController@viewListarAvaliacoes');
$router->get('/backend/avaliacao/editar/{id}', 'AvaliacaoController@viewEditarAvaliacoes');
$router->get('/backend/avaliacao/excluir/{id}', 'AvaliacaoController@viewExcluirAvaliacoes');

// Carrinho
$router->get('/backend/carrinho', 'CarrinhoController@index');
$router->get('/backend/carrinho/criar', 'CarrinhoController@viewCriarCarrinho');
$router->get('/backend/carrinho/listar', 'CarrinhoController@viewListarCarrinho');
$router->get('/backend/carrinho/editar/{id}', 'CarrinhoController@viewEditarCarrinho');
$router->get('/backend/carrinho/excluir/{id}', 'CarrinhoController@viewExcluirCarrinho');

// Estoque_Movimentação
$router->get('/backend/EstoqueMovimentacao', 'EstoqueController@index');
$router->get('/backend/EstoqueMovimentacao/criar', 'EstoqueController@viewCriarEstoque_Movimentacao');
$router->get('/backend/EstoqueMovimentacao/listar', 'EstoqueController@viewListarEstoque_Movimentacao');
$router->get('/backend/EstoqueMovimentacao/editar/{id}', 'EstoqueController@viewEditarEstoque_Movimentacao');
$router->get('/backend/EstoqueMovimentacao/excluir/{id}', 'EstoqueController@viewExcluirEstoque_Movimentacao');

// Imagens
$router->get('/backend/Imagens', 'ImagensController@index');
$router->get('/backend/Imagens/criar', 'ImagensController@viewCriarImagem');
$router->get('/backend/Imagens/listar', 'ImagensController@viewListarImagem');
$router->get('/backend/Imagens/editar/{id}', 'ImagensController@viewEditarImagem');
$router->get('/backend/Imagens/excluir/{id}', 'ImagensController@viewExcluirImagem');


// -- Roteamento POST (Rotas de Ação e Submissão de Formulário) --

// avaliação
$router->get('/backend/avaliacao/salvar', 'AvaliacaoController@salvarAvaliacao');
$router->get('/backend/avaliacao/atualizar/{id}', 'AvaliacaoController@atualizarAvaliacao');
$router->get('/backend/avaliacao/deletar/{id}', 'AvaliacaoController@deletarAvaliacao');
 
// carrinho
$router->get('/backend/carrinho/salvar', 'CarrinhoController@salvarCarrinho');
$router->get('/backend/carrinho/atualizar/{id}', 'CarrinhoController@atualizarCarrinho');
$router->get('/backend/carrinho/deletar/{id}', 'CarrinhoController@deletarCarrinho');

// EstoqueMovimentacao
$router->get('/backend/EstoqueMovimentacao/salvar', 'EstoqueController@salvarEstoque_Movimentacao');
$router->get('/backend/EstoqueMovimentacao/atualizar/{id}', 'EstoqueController@atualizarEstoque_Movimentacao');
$router->get('/backend/EstoqueMovimentacao/deletar/{id}', 'EstoqueController@deletarEstoque_Movimentacao');

// imagens
$router->get('/backend/Imagem/salvar', 'ImagensController@salvarImagens');
$router->get('/backend/Imagem/atualizar/{id}', 'ImagensController@atualizarImagens');
$router->get('/backend/Imagem/deletar/{id}', 'ImagensController@deletarImagens');


// 4. Inicia o despacho (dispatch) do roteador
$router->run();

// 5. Tratamento de Erro 404 (Not Found)
if (!$router->found()) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo "<h1>404 Not Found</h1>";
    echo "<p>A página solicitada não foi encontrada.</p>";
}
