<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Categoria;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;

class CategoriasController {
    public $Categoria;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->Categoria = new Categoria($this->db);
    }
    // index
    public function index(){
        $resultado = $this->Categoria->buscarCategorias();
        return $resultado;
    }
     public function viewListarCategoria(){
        $dados = $this->Categoria->buscarCategorias();
        view::render("categoria/index",["categoria" => $dados]);
    }

    public function viewCriarCategoria(){
        view::render("categoria/create");
    }

    public function viewEditarCategoria(){
         view::render("categoria/edit");
    }

    public function viewExcluirCategoria(){
         view::render("categoria/delete");
    }
    public function salvarCategoria(){
       if($this->Categoria->inserirCategoria(
            $_POST["nome_categorias"],
            $_POST["descricao_categorias"],
            "Ativo"
        )){
            Redirect::redirecionarComMensagem("categoria/listar", "success", "Categoria criada com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("categoria/create", "error", "Erro ao criar categoria. Tente novamente.");
        }
    }

}