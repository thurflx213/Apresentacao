<?php
namespace App\apresentacao\controllers;

use App\apresenacao\Models\Carrinho;
use App\apresentacao\Database\database;

class CarrinhoController {
    public $Carrinho;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->Carrinho  = new Carrinho($this->db);
    }
    // index
    public function index() {
        $resultado = $this->Carrinho->buscarCarrinhos();
        return $resultado;
    }

    //registrar

    // login

    //atualizar

    //deletar

    //
}