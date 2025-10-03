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
}