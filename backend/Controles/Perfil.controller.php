<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Perfil;
use App\Koketsu\Database\Database;

class PerfilController {
    public $perfil;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->perfil = new Perfil($this->db);
    }
    // index
    public function index(){
        $resultado = $this->perfil->buscarPerfis();
        return $resultado;
    }
}