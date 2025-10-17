<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Usuario;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Validadores\UsuarioValidador;
use App\Koketsu\Core\FileManager;
use App\Koketsu\Core\Flash;
use App\Koketsu\Core\Session;

class AuthController{
    private Usuario $usuarioModel;
    private Session $session;

    public function __construct(){
        $db = Database::getInstance();
        $this->usuarioModel = new Usuario($db);
        $this->session = new Session();
    }
    public function login(): void{
        View::render('auth/login');
    }

   public function register(): void {
    View::render('auth/register');
}

  public function logout(): void {
    $this->session->destroy();
    Redirect::redirecionarComMensagem('/login', 'success', 'Você saiu com segurança.');
}

  public function authenticar(): void {
    $email = $_POST['email_usuarios'] ?? null;
    $senha = $_POST['senha_usuarios'] ?? null;
    $usuario = $this->usuarioModel->checarCredenciais($email, $senha);
    if ($usuario) {
        session_regenerate_id(true);
        $this->session->set('usuario_id', $usuario['id_usuarios']);
        $this->session->set('usuario_nome', $usuario['nome_usuarios']);
        $this->session->set('usuario_tipo', $usuario['nivel_acesso']);
        redirect::redirectPara('/admin/dashboard');
    } else {
        redirect::redirecionarComMensagem('/login', 'error', 'E-mail ou senha incorretos.');
    }
}

  public function cadastrarUsuario(): void {
    
    $erros = UsuarioValidador::validarEntradas($_POST);

    if (!empty($erros)) {
        Redirect::redirecionarComMensagem('/register', 'erros', implode("<br>", $erros));
    }

    $nome = $_POST['nome_usuarios'] ?? null;
    $email = $_POST['email_usuarios'] ?? null;
    $senha = $_POST['senha_usuarios'] ?? null;
    $senha_confirm = $_POST['senha_confirm'] ?? null;
//var_dump($_POST);exit;
  if ($senha !== $senha_confirm) {
    Redirect::redirecionarComMensagem('/register', 'erros', 'As senhas não conferem.');
  }

  if (!empty($this->usuarioModel->buscarUsuariosPorEmail($email))) {
    Redirect::redirecionarComMensagem('/register', 'erros', 'Erro ao cadastrar, problema no seu e-mail.');
  }
 
  $novoUsuarioId = $this->usuarioModel->inserirUsuario($nome, $email, $senha, 'usuario', 'Ativo', 'null');

  if ($novoUsuarioId) {
    Redirect::redirecionarComMensagem('/login', 'success', 'Cadastro realizado! Por favor, faça o login.');
  } else {
    Redirect::redirecionarComMensagem('/register', 'error', 'Erro no servidor. Tente novamente.');
  }

}
}