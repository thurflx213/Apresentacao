<?php
namespace App\Koketsu\Controles\Admin;

use App\Koketsu\Core\Session;
use App\Koketsu\Core\Redirect;

abstract class AuthenticatedController{
    protected Session $session;
    public function __construct(){
        $this->session = new Session();
        if (!$this->session->has('usuario_id')) {
            redirect::redirecionarComMensagem(
                'login',
                'error',
                'Você precisa estar logado para acessar a página.'
            );
        }
    }
}