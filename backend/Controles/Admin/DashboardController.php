<?php
namespace App\Koketsu\Controles\Admin;

use App\Koketsu\Core\View;
use App\Koketsu\Database\Database;
use App\Koketsu\Models\Usuario;


class DashboardController extends AuthenticatedController{
    public $usuario;
    public $db;
    public function __construct() {
        parent::__construct();
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
    }
    public function index(): void{
        $dados = $this->usuario->buscarUsuarios();
        View::render('admin/dashboard/index', [
            'nomeUsuario' => $this->session->get('usuarios_nome'),
            'Tipo' => $this->session->get('usuarios_tipo'),
            'usuarios' => $dados
        ]);
    }
}