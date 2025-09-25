<?php
namespace App\apresentacao\controllers;

use App\apresentacao\Models\avaliacao;
use App\apresentacao\Database\database;

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