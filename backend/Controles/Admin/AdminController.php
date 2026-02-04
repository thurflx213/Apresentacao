<?php 
namespace App\Koketsu\Controles\Admin;
use App\Koketsu\Core\Redirect;

abstract class AdminController extends AuthenticatedController{
    public function __construct(){
        parent::__construct();
            if ($_SESSION['usuario_tipo'] ?? null !== 'admin'){
            Redirect::redirecionarComMensagem(
                'admin/dashboard',
                'error',
                'Você não tem permissão para acessar está area.'
            );
            }
        }
    }
