<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Usuario;
use App\Koketsu\Database\Database;

class UsuarioController {
    public $usuario;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
    }
    // index
    public function index(){
        $resultado = $this->usuario->buscarUsuarios();
        return $resultado;
    }
}