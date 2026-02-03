<?php
namespace App\koketsu\Core;
use App\Koketsu\Core\EmailService;
class NotificacaoEmail{
    private EmailService $emailService;
    public function __construct(){
        $this->emailService = new EmailService();
    }
    public function esqueciASenha(string $email, string $token): void {
        $assunto = "Redefinição de Senha";
        $mensagem = "Clique no link abaixo para redefinir sua senha: ";
        $mensagem .= "http://localhost:4000/backend/redefinir-senha?token=" . urlencode($token);
        $this->emailService->send($email, $assunto, $mensagem);
    }
    public function boasVindas(string $email, string $nome): void {
        $assunto = "Bem-vindo ao Koketsu!";
        
        // Caminho do arquivo de template
        $templatePath = __DIR__ . '/../Views/Templates/emails/bem_vindo.php';
        
        if (file_exists($templatePath)) {
            ob_start();
            require $templatePath;
            $mensagem = ob_get_clean();
        } else {
            // Fallback caso o template não exista
            $mensagem = "<b><h2>Olá " . htmlspecialchars($nome) ."</h2></b>\n\n";
            $mensagem .= "<p>Obrigado por se cadastrar no site da Koketsu grife!!</p>\n\n";
            $mensagem .= "<p>Atenciosamente,\nEquipe Koketsu</p>";
        }

        $this->emailService->send($email, $assunto, $mensagem);
    }
    public function enviarEmailDeEsqueciASenha( array $userData ){
        
    }
}