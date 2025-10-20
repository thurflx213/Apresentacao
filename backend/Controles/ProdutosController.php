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
// index
public function index(){
 $resultado = $this->produtos->buscarProdutos();
 return $resultado;
}  
    

    public function viewProdutoUnico(int $id) {
        $dados = $this->produtos->buscarProdutoPorId($id);

        if ($dados) {

            View::render('produtos/detalhes', ['produto' => $dados]);
        } else {
        
            header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
            echo 'Produto não encontrado.';
        }
    }


 public function viewlistarProduto(){
 $dados = $this->produtos->paginacao();
 $total = $this->produtos->totaldeProdutos();
 view::render("produtos/index",
 ["produtos" => $dados['data'],
 "total_produtos" => $total[0],
 "total_inativos" => 22,
 "Total_ativos" => 12,
 'paginacao' => $dados
]
);
}

public function viewCriarProduto(){
 view::render("produtos/create");
}
public function viewEditarProduto(int $id){
  $dados = $this->produtos->buscarProdutoPorId($id);
var_dump($dados);
//  foreach($dados as $produtos){
// $dados = $produtos;
// }
 View::render('produtos/edit', ['produto' => $dados]);
}

public function viewexcluirProduto(){
 view::render("produto/delete");
}

public function atualizarProdutos(){
 echo "Atualizar usuario";
}
public function deletarUsuario(){
 echo "Deletar usuario";
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
 "Ativo", // Isso deve ser a imagem, não o status? Revise esta parte.
 isset($_POST["id_categoria"]) ? $_POST["id_categoria"] : null
)) {
 Redirect::redirecionarComMensagem("produto/listar", "success", "Produto criado com sucesso.");
} else {
 Redirect::redirecionarComMensagem("produto/criar", "error", "Erro ao criar produto.");
}
}
};
