<?php
namespace App\Koketsu\Controllers\Admin;

use App\Koketsu\Core\Session;
use App\Koketsu\Core\Flash;
use App\Koketsu\Core\Redirect;

abstract class AuthenticatedController{
    protected Session $session;
    public function __construct() {
        $this->session = new Session();
        if (!$this->session->has('usuario_id')) {
            Redirect::redirecionarComMensagem(
                'login',
                'error',
                'Você precisa estar logado para acessar esta página.'
                );
        }
    }
}