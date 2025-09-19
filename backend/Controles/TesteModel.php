<?php

require_once __DIR__ . '/../Models/Perfil.php';
require_once __DIR__ . '/../Database/Database.php';

$perfil = new Perfil($db);
$resultado = $perfil -> restaurarPerfil(1);
//$resultado = $perfil->deletarPerfil(1);
// $resultado =$categoria->atualizarCategoria(1, 'Camisetas', 'Categoria de roupas');
//$resultado =$perfil->buscarUsuarioInativoPorId(1);
//$resultado = $perfil -> ativarPerfil(1);
var_dump($resultado);
