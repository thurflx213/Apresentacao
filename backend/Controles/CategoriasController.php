<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Categorias;
use App\Koketsu\Database\Database;

class CategoriasController {
    public $categorias;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->categorias = new Categorias($this->db);
    }
    // index
    public function index(){
        $resultado = $this->categorias->buscarCategorias();
        return $resultado;
    }
}