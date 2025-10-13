<?php
// Define o namespace da aplicação
namespace App;

// 1. Carrega o autoloader do Composer (MANTENHA ISSO NO TOPO)
require_once __DIR__ . '/../vendor/autoload.php';

// Inicia a sessão
session_start();

// 2. Define o use correto para o roteador (Corrigido o namespace para o arquivo rotas.php)
use App\Koketsu\Rotas\Rotas; 

// 3. Inicia o roteador
$router = new Rotas();

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
$router->post('/backend/avaliacao/salvar', 'AvaliacaoController@salvarAvaliacao');
$router->post('/backend/avaliacao/atualizar/{id}', 'AvaliacaoController@atualizarAvaliacao');
$router->post('/backend/avaliacao/deletar/{id}', 'AvaliacaoController@deletarAvaliacao');
 
// carrinho
$router->post('/backend/carrinho/salvar', 'CarrinhoController@salvarCarrinho');
$router->post('/backend/carrinho/atualizar/{id}', 'CarrinhoController@atualizarCarrinho');
$router->post('/backend/carrinho/deletar/{id}', 'CarrinhoController@deletarCarrinho');

// EstoqueMovimentacao
$router->post('/backend/EstoqueMovimentacao/salvar', 'EstoqueController@salvarEstoque_Movimentacao');
$router->post('/backend/EstoqueMovimentacao/atualizar/{id}', 'EstoqueController@atualizarEstoque_Movimentacao');
$router->post('/backend/EstoqueMovimentacao/deletar/{id}', 'EstoqueController@deletarEstoque_Movimentacao');

// imagens
$router->post('/backend/Imagem/salvar', 'ImagensController@salvarImagens');
$router->post('/backend/Imagem/atualizar/{id}', 'ImagensController@atualizarImagens');
$router->post('/backend/Imagem/deletar/{id}', 'ImagensController@deletarImagens');


// 4. Inicia o despacho (dispatch) do roteador
$router->run();

// 5. Tratamento de Erro 404 (Not Found)
if (!$router->found()) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo "<h1>404 Not Found</h1>";
    echo "<p>A página solicitada não foi encontrada.</p>";
}
