<?php
namespace App\Koketsu\Validadores;

class UsuarioValidador {
    public static function ValidarEntradas(array $dados): array {
        $erros = [];

        $nome = trim($dados['nome_usuarios'] ?? '');
        $email = trim($dados['email_usuarios'] ?? '');
        $senha = $dados['senha_usuarios'] ?? '';

        if ($nome === '') {
            $erros[] = "O campo nome é obrigatório.";
        }

        if ($email === '') {
            $erros[] = "O campo email é obrigatório.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erros[] = "O campo email deve ser um email válido.";
        }

        if ($senha === '') {
            $erros[] = "O campo senha é obrigatório.";
        } elseif (strlen($senha) < 6) {
            $erros[] = "O campo senha deve ter pelo menos 6 caracteres.";
        }

        return $erros;
    }
}