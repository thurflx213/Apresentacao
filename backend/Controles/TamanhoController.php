<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Tamanho;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;

class TamanhoController {
    public $tamanho;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->tamanho = new Tamanho($this->db);
    }
    // index
    public function index(){
        $resultado = $this->tamanho->buscarTamanhos();
        return $resultado;
    }
     public function viewListarTamanhos(){
        $dados = $this->tamanho->buscarTamanhos();
        view::render("tamanho/index",["tamanhos" => $dados]);
    }

    public function viewCriarTamanho(){
        view::render("tamanho/create");
    }

    public function viewEditarTamanho(){
         view::render("tamanho/edit");
    }

    public function viewExcluirTamanho(){
         view::render("tamanho/delete");
    }
    public function salvarTamanho(){
       if($this->tamanho->inserirTamanho(
            $_POST["id_produto"],
            $_POST["tamanho_tamanhos"],
            $_POST["quantidade_tamanho"],
            "Ativo"
        )){
            Redirect::redirecionarComMensagem("tamanho/listar", "success", "Tamanho criado com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("tamanho/create", "error", "Erro ao criar tamanho. Tente novamente.");
        }
    }
}