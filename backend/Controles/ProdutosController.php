<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Produtos;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;


class ProdutosController {
public $produtos;
public $db;

public function __construct() {
$this->db = Database::getInstance();
$this->produtos = new Produtos($this->db);
}

// index: Retorna a lista de produtos (geralmente usado por APIs internas)
public function index(){
$resultado = $this->produtos->buscarProdutos();
return $resultado;
} 
  

// viewProdutoUnico: Exibe os detalhes de um produto específico
public function viewProdutoUnico(int $id) {
  $dados = $this->produtos->buscarProdutoPorId($id);

  if ($dados) {
    View::render('produtos/detalhes', ['produto' => $dados]);
  } else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    echo 'Produto não encontrado.';
  }
}


// viewlistarProduto: Exibe a lista de produtos com paginação para a view
public function viewlistarProduto(){
$dados = $this->produtos->paginacao();
// Assumindo que totaldeProdutos() retorna um array e o total está no índice 0
$total = $this->produtos->totaldeProdutos(); 
view::render("produtos/index",
[
  "produtos" => $dados['data'],
  "total_produtos" => $total[0],
  "total_inativos" => 22, // Dados de exemplo, você pode buscar os reais
  "Total_ativos" => 12,   // Dados de exemplo, você pode buscar os reais
  'paginacao' => $dados
]
);
}


public function viewCriarProduto(){
view::render("produtos/create");
}

public function viewEditarProduto(int $id){
 $dados = $this->produtos->buscarProdutoPorId($id);

View::render('produtos/edit', ['produto' => $dados]);
}


public function viewExcluirProduto(){
view::render("produto/delete");
}


public function atualizarProdutos(){

if ($this->produtos->atualizarProduto(
  $_POST["id_produto"], 
  $_POST["nome_produtos"],
  $_POST["descricao_produtos"],
  $_POST["preco_produtos"],
  $_POST["estoque_produtos"],
  $_POST["status_produtos"], // Ex: 'Ativo' ou 'Inativo'
  isset($_POST["id_categoria"]) ? $_POST["id_categoria"] : null
)) {
  Redirect::redirecionarComMensagem("produto/listar", "success", "Produto atualizado com sucesso.");
} else {
  Redirect::redirecionarComMensagem("produto/editar/" . $_POST["id_produto"], "error", "Erro ao atualizar produto.");
}
}


public function deletarProduto(int $id){

if ($this->produtos->excluirProduto($id)) {
  Redirect::redirecionarComMensagem("produto/listar", "success", "Produto excluído com sucesso.");
} else {
  Redirect::redirecionarComMensagem("produto/listar", "error", "Erro ao excluir produto.");
}
} 
public function relatorioProduto($id, $data1, $data2){
View::render("produto/relatorio",
["id"=> $id, "data1"=> $data1, "data2"=> $data2]);
}


public function salvarProduto() {

if ($this->produtos->inserirProduto(
  $_POST["nome_produtos"],
  $_POST["descricao_produtos"],
  $_POST["preco_produtos"],
  $_POST["estoque_produtos"],
  "Ativo", 
  isset($_POST["id_categoria"]) ? $_POST["id_categoria"] : null
)) {
  Redirect::redirecionarComMensagem("produto/listar", "success", "Produto criado com sucesso.");
} else {
  Redirect::redirecionarComMensagem("produto/criar", "error", "Erro ao criar produto.");
}
}
}