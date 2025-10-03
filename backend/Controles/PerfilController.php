<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Perfil;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;

class PerfilController {
    public $perfil;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->perfil = new Perfil($this->db);
    }
    // index
    public function index(){
        $resultado = $this->perfil->buscarPerfis(2);
        return $resultado;
    }
     public function viewListarPerfis(){
        $dados = $this->perfil->buscarPerfis(2);
        view::render("perfil/index",["perfis" => $dados]);
    }

    public function viewCriarPerfil(){
        view::render("perfil/create");
    }

    public function viewEditarPerfil(){
         view::render("perfil/edit");
    }

    public function viewExcluirPerfil(){
         view::render("perfil/delete");
    }
}