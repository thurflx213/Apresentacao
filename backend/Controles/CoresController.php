<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Cor;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;

class CoresController {
    public $cores;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->cores = new Cor($this->db);
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

    public function viewEditarCor(){
         view::render("cores/edit");
    }

    public function viewExcluirCor(){
         view::render("cores/delete");
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
}