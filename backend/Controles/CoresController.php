<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Cor;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Core\FileManager;

class CoresController {
    public $cores;
    public $db;
    public $gerenciarImagem;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->cores = new Cor($this->db);
        $this->gerenciarImagem = new FileManager('upload');
    }
    // index
    public function index(){
        $resultado = $this->cores->buscarCores();
        return $resultado;
    }
     public function viewListarCores(){
        $dados = $this->cores->buscarCores();
        view::render("cores/index",["cores" => $dados]);
    }

    public function viewCriarCor(){
        view::render("cores/create");
    }

    public function viewEditarCor(int $id){
        $dados = $this->cores->buscarCoresPorIdProduto($id);
       var_dump($dados);
       foreach($dados as $cores){
        $dados = $cores;
       }
       view::render("cores/edit", ["cor" => $dados]);
    }

    public function viewExcluirCor(int $id){
         view::render("cores/delete", ["id_cores" => $id]);
    }

    public function relatorioCores($id, $data1, $data2){
     view::render("cores/relatorio",
           ["id" => $id, "data1" => $data1, "data2" => $data2]
      );
    }

    public function salvarCor(){
       if($this->cores->inserirCor(
            $_POST["id_produto"],
            $_POST["cor_cores"],
            $_POST["quantidade_cores"],
            "Ativo"
        )){
            Redirect::redirecionarComMensagem("cor/listar", "success", "Cor criada com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("cor/create", "error", "Erro ao criar cor. Tente novamente.");
        }
    }
    public function atualizarCor(){
        echo "Atualizar cor";
    }
    public function deletarCor(){
        echo "Deletar cor";
    }  
}