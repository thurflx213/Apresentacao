<?php 
namespace App\Koketsu\Controllers\Admin;
use App\Koketsu\Core\Redirect;

abstract class PedreiroController extends AuthenticatedController{
    public function __construct(){
        parent::__construct();
            if ($this->session->get('usuario_tipo') !== 'Pedreiro'){
            Redirect::redirecionarComMensagem(
                'admin/dashboard',
                'error',
                'Você não tem permissão para acessar está area.'
            );
            }
        }
    }
