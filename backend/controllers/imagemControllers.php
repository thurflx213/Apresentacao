<?php
namespace App\apresentacao\controllers;

use App\apresentacao\Models\Imagem;
use App\apresentacao\Database\Database;

class ImagemController {
    public $imagem;
    public $db;
    public function __construct() {
        $this->db = Database::getInstance();
        $this->imagem  = new Imagem($this->db);
    }
    // index
    public function index() {
        $resultado = $this->imagem->buscarImagens();
        return $resultado;
    }

    //registrar

    // login

    //atualizar

    //deletar

    //
}