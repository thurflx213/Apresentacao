<?php
namespace App\Koketsu\Core;
use App\Koketsu\Core\EmailService;

class NotificacaoEmail{
 private EmailService $emailService;
 public function __construct(){
    $this->emailService = new EmailService();
 }
 public function esqueciASenha(string $email, string $token): void {
    $assunto = "Redefinação de Senha";
    $mensagem = "Clique no link para redefinir sua senha: ";
    $mensagem .= "https://seusite.com/redefinir-senha?token=" . urlencode($token);
    $this->emailService->send($email, $assunto, $mensagem);
 }
 public function boasVindas(string $email, string $nome): void {
    $assunto = "Bem=vindo ao Koketsu!";
    $mensagem = "<b><h2>Olá " . htmlspecialchars($nome) . "</h2></b>,\n\n";
    $mensagem .= "<p>Obrigado por se registrar no Kipedreiro. !</p>\n\n";
    $mensagem .= "<p>Atenciosamente, \nEquipe Kipedreiro</p>";
    $this->emailService->send($email, $assunto, $mensagem);

}
public function notificarRecebimentoContato(string $email, string $mensagem): void
    {
        $assunto = "Obrigado por fazer parte das novidades da Koketsu!";
        $mensagem = "
            <h2>Olá, {$email}!</h2>
            <p>Recebemos sua mensagem de contato e gostaríamos de confirmar o recebimento.\n</p>
            <p>Agora você receberá informações de pré-vendas, novidadades e promoções\n</p>
            <p>Obrigado por entrar em contato!\n</p>
            <p>Atenciosamente,<br>A Equipe Koketsu\n</p>
        ";
        
       $this->emailService->send($email, $assunto, $mensagem);
   
        }
}