<?php
namespace App\Koketsu\Core;

class View {
    public static function render($nomeView, $dados = []){
        extract($dados);
        require_once __DIR__."/../Views/Templates/partials/header.php";
        require_once __DIR__."/../Views/Templates/{$nomeView}.php";
        require_once __DIR__."/../Views/Templates/partials/footer.php";
    }
}