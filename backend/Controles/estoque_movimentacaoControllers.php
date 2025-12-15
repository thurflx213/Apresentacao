<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\EstoqueMovimentacao;
use App\Koketsu\Database\Database;

class EstoqueMovimentacaoController {
    public $Estoque_Movimentacao;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->Estoque_Movimentacao  = new EstoqueMovimentacao($this->db);
    }
    // index
    public function index() {
        $resultado = $this->Estoque_Movimentacao->buscarMovimentacoes();
        return $resultado;
    }

    //registrar

    // login

    //atualizar

    //deletar

    //
}