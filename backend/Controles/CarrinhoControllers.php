<?php
namespace App\backend\controllers;

use App\backend\model\Carrinho;
use App\backend\database\Database;

class CarrinhoController {
    private $carrinho;
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->carrinho = new Carrinho($this->db);
    }

    public function index() {
        return $this->carrinho->buscarCarrinhos();
    }
}
