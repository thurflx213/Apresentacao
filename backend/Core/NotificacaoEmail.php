<?php
namespace App\Koketsu\Core;
use App\Koketsu\Core\EmailService;

class NotificacaoEmail
{
    private EmailService $emailService;

    public function __construct(?EmailService $emailService = null)
    {
        $this->emailService = $emailService ?? new EmailService();
    }

    public function esqueciASenha(string $email, string $token): void
    {
        $assunto = "Redefinição de Senha";
        $mensagem = "Clique no link abaixo para redefinir sua senha: ";
        $mensagem .= "http://localhost:4000/backend/redefinir-senha?token=" . urlencode($token);
        $this->emailService->send($email, $assunto, $mensagem);
    }

    public function boasVindas(string $email, string $nome): void
    {
        $assunto = "Bem-vindo ao Koketsu!";
        $mensagem = "<b><h2>Olá " . htmlspecialchars($nome) ."</h2></b>\n\n";
        $mensagem .= "<p>Obrigado por se cadastrar no site da Koketsu grife!!</p>\n\n";
        $mensagem .= "<p>Atenciosamente,\nEquipe Koketsu</p>";
        $this->emailService->send($email, $assunto, $mensagem);
    }

    public function notificarRecebimento(string $email, string $mensagem = null): bool
    {
        $assunto = 'Recebemos seu contato';
        $conteudo = $mensagem ?? "Obrigado por entrar em contato conosco. Em breve responderemos.";
        return $this->emailService->send($email, $assunto, $conteudo);
    }

    public function enviarEmailDeEsqueciASenha(array $userData)
    {
        // implementação conforme necessidade
    }
}