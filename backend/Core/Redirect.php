<?php
namespace App\Koketsu\Core;
use App\Koketsu\Core\Flash;

class Redirect{
    public static function redirecionarPara($url){
<<<<<<< HEAD
        header("Location: /backend/".$url);
        exit;
=======
        header("Location: /backend".$url);
>>>>>>> a5b89a898fd8dfa1e2b47cad3611aa66256912b4
    }

    public static function redirecionarComMensagem($url, $type, $message){
        
        Flash::set($type, $message);
        self::redirecionarPara($url);

    }
    public static function voltarPaginaAnteriorComMensagem($type, $message){
        $url = $_SERVER['HTTP_REFERER'] ?? '/';
        self::redirecionarComMensagem($url, $type, $message);
    }
}