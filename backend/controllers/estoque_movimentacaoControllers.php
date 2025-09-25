<?php
namespace App\apresentacao\controllers;

use App\apresenacao\Models\estoque_movimentacao;
use App\apresentacao\Database\database;

class EstoqueMovimentacaoController {
    public $estoque_movimentacao;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->estoque_movimentacao  = new estoque_movimentacao($this->db);
    }
    // index
    public function index() {
        $resultado = $this->estoque_movimentacao->buscarEstoqueMovimentacoes();
        return $resultado;
    }

    //registrar

    // login

    //atualizar

    //deletar

    //
}