<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Usuario;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;

class UsuarioController {
    public $usuario;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
    }
    // index
    public function index(){
        $resultado = $this->usuario->buscarUsuarios();
        return $resultado;
    }
    
    public function viewListarUsuarios(){
        $dados = $this->usuario->buscarUsuarios();
        view::render("usuario/index",["usuarios" => $dados]);
    }

    public function viewCriarUsuarios(){
        view::render("usuario/create");
    }

    public function viewEditarUsuarios(){
         view::render("usuario/edit");
    }

    public function viewExcluirUsuarios(){
         view::render("usuario/delete");
    }

}