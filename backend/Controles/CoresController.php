<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Cores;
use App\Koketsu\Database\Database;

class CoresController {
    public $cores;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->cores = new Cores($this->db);
    }
    // index
    public function index(){
        $resultado = $this->cores->buscarCores();
        return $resultado;
    }
}