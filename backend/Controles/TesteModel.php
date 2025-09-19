<?php

require_once __DIR__ . '/../Models/Perfil.php';
require_once __DIR__ . '/../Database/Database.php';

$perfil = new Perfil($db);

// $resultado =$categoria->atualizarCategoria(1, 'Camisetas', 'Categoria de roupas');
$resultado =$perfil->buscarUsuariosInativos();
var_dump($resultado);
