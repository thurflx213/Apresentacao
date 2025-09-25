<?php
namespace App\Koketsu\controles;

use App\Koketsu\Models\Tamanho;
use App\Koketsu\Database\Database;

class TamanhoController {
    public $tamanho;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->tamanho = new Tamanho($this->db);
    }
    // index
    public function index(){
        $resultado = $this->tamanho->buscarTamanhos();
        return $resultado;
    }
}