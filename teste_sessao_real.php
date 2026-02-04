<?php
session_start();
echo "ID do usuário em sessão: " . ($_SESSION['usuario_id'] ?? 'NÃO DEFINIDO') . "\n";
echo "Nome do usuário em sessão: " . ($_SESSION['usuario_nome'] ?? 'NÃO DEFINIDO') . "\n";
echo "Todos os dados de sessão:\n";
print_r($_SESSION);
?>
