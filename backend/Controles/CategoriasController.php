<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Categoria;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;

class CategoriasController {
    public $categorias;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->categorias = new Categoria($this->db);
    }
    // index
    public function index(){
        $resultado = $this->categorias->buscarCategorias();
        return $resultado;
    }
     public function viewListarCategoria(){
        $dados = $this->categorias->buscarCategorias();
        view::render("categoria/index",["categorias" => $dados]);
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

}