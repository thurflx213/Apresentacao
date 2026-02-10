<?php
namespace App\Koketsu\Core;

class View {
    public static function render($nomeView, $dados = [], $layout = true){
        extract($dados);
        if ($layout) {
            require_once __DIR__."/../Views/templates/partials/header.php";
        }
        require_once __DIR__."/../Views/templates/{$nomeView}.php";
        if ($layout) {
            require_once __DIR__."/../Views/templates/partials/footer.php";
        }
    }
}