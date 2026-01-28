<?php
namespace App\Koketsu\Controles\Cliente;

use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Core\FileManager;
use App\Koketsu\Database\Database;
use App\Koketsu\Models\Usuario;
use App\Koketsu\Controles\Admin\AuthenticatedController;

class DashboardController extends AuthenticatedController{
    public $usuario;
    public $db;
    public $gerenciarImagem;
    
    public function __construct() {
        parent::__construct();
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
        $this->gerenciarImagem = new FileManager('upload');
    }
    
    public function index(): void{
       // $dados = $this->usuario->buscarUsuarios();
        View::render('cliente/dashboard/index', [
            'nomeUsuario' => $this->session->get('usuario_nome'),
            'usuarioId' => $this->session->get('usuario_id'),
            'Tipo' => $this->session->get('usuario_tipo'),
            
        ]);
    }

    public function viewEditarCliente(int $id){
        $dados = $this->usuario->buscarPorID($id);
        if (!$dados) {
            Redirect::redirecionarComMensagem("/backend/cliente/dashboard", "error", "Cliente não encontrado.");
        }
        View::render("cliente/editar", ["usuario" => $dados]);
    }

    public function atualizarCliente(int $id) {
        $usuario = $this->usuario->buscarPorID($id);
        if (!$usuario) {
            Redirect::redirecionarComMensagem("/backend/cliente/dashboard", "error", "Cliente não encontrado.");
        }

        $nome = $_POST['nome_usuarios'] ?? '';
        $email = $_POST['email_usuarios'] ?? '';
        $senha = $_POST['senha_usuarios'] ?? '';
        $confirmarSenha = $_POST['confirmar_senha'] ?? '';

        // Validações
        if (empty($nome)) {
            Redirect::redirecionarComMensagem("/backend/cliente/editar/$id", "error", "Nome é obrigatório.");
        }

        if (empty($email)) {
            Redirect::redirecionarComMensagem("/backend/cliente/editar/$id", "error", "Email é obrigatório.");
        }

        if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            Redirect::redirecionarComMensagem("/backend/cliente/editar/$id", "error", "Email inválido.");
        }

        // Se uma nova senha foi fornecida
        if (!empty($senha)) {
            if (strlen($senha) < 6) {
                Redirect::redirecionarComMensagem("/backend/cliente/editar/$id", "error", "Senha deve ter no mínimo 6 caracteres.");
            }

            if ($senha !== $confirmarSenha) {
                Redirect::redirecionarComMensagem("/backend/cliente/editar/$id", "error", "As senhas não conferem.");
            }
        }

        // Processar imagem
        $fotoCaminho = $usuario['foto_usuarios'];
        if (isset($_FILES['foto_usuarios']) && $_FILES['foto_usuarios']['error'] == 0) {
            $fotoCaminho = $this->gerenciarImagem->salvarArquivo($_FILES['foto_usuarios'], 'usuarios');
        }

        // Atualizar usuário
        $senhaHash = empty($senha) ? $usuario['senha_usuarios'] : password_hash($senha, PASSWORD_DEFAULT);

        $sql = "UPDATE tbl_usuarios SET 
                nome_usuarios = :nome,
                email_usuarios = :email,
                senha_usuarios = :senha,
                foto_usuarios = :foto,
                atualizado_em = NOW()
                WHERE id_usuarios = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->bindParam(':foto', $fotoCaminho);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            // Atualizar sessão
            $this->session->set('usuario_nome', $nome);
            if (!empty($fotoCaminho)) {
                $this->session->set('foto_usuarios', $fotoCaminho);
            }

            Redirect::redirecionarComMensagem("/backend/cliente/dashboard", "success", "Perfil atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/backend/cliente/editar/$id", "error", "Erro ao atualizar perfil. Tente novamente.");
        }
    }
}