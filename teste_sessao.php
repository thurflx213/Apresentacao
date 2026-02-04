<?php
session_start();
$_SESSION['id_usuarios'] = 1; // Simula um usuário logado

echo "ID do Usuário em Sessão: " . $_SESSION['id_usuarios'];
?>
