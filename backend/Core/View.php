<?php
namespace App\Koketsu\Core;

class View {
    public static function render($nomeView, $dados = []){
        extract($dados);
<<<<<<< HEAD
        require_once __DIR__."/../Views/Templates/partials/header.php";
        require_once __DIR__."/../Views/Templates/{$nomeView}.php";
        require_once __DIR__."/../Views/Templates/partials/footer.php";
=======
        require_once __DIR__."/../Views/templates/partials/header.php";
        require_once __DIR__."/../Views/templates/{$nomeView}.php";
        require_once __DIR__."/../Views/templates/partials/footer.php";
>>>>>>> 02824c7afd4b0d59fc71b10b5aa03004e6fcd33d
    }
}