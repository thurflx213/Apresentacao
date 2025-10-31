<?php
namespace App\backend\controllers;

use App\backend\models\Avaliacao;
use App\backend\Database\Database;

class AvaliacaoController {
    public $avaliacao;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->avaliacao  = new Avaliacao($this->db);
    }
    // index
    public function index() {
        $resultado = $this->avaliacao->buscarAvaliacoes();
        return $resultado;
    }

    //registrar

    // login

    //atualizar

    //deletar

    //
}