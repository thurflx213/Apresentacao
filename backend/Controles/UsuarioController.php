<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Usuario;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Validadores\UsuarioValidador;
use App\Koketsu\Core\FileManager;

class UsuarioController {
    public $usuario;
    public $db;
    public $gerenciarImagem;
    
    public function __construct() {
        $this->db = database::getInstance();
        $this->usuario = new Usuario($this->db);
        $this->gerenciarImagem = new FileManager('upload'); 
    }

    public function viewListarUsuarios($pagina = 1){
    $dados = $this->usuario->paginacao($pagina);
    $total = $this->usuario->totalDeUsuarios();
    $total_inativos = $this->usuario->buscarUsuariosInativos($pagina);
    $total_ativos = $this->usuario->buscarUsuariosAtivos($pagina);
    View::render('usuario/index', 
    [
        "usuarios" => $dados['data'],
        "total_usuarios" => $total,
        "total_inativos" => $total_inativos,
        "total_ativos" => $total_ativos,
        'paginacao' => $dados
    ] 
  );
  
    }

    public function index(){
        Redirect::redirecionarPara("/usuario/listar");
    }

    public function viewCriarUsuarios(){
        View::render("usuario/criar");
    }
    public function salvarUsuario(){
        $erros = UsuarioValidador::ValidarEntradas($_POST);
        
        if(!empty($erros)){
            Redirect::redirecionarComMensagem("/usuario/criar", "error", implode("<br>", $erros));
            return;
        }
        $imagem = $this->gerenciarImagem->salvarArquivo($_FILES['imagem'],'usuario'); 
        
        $nome = $_POST['nome_usuario'] ?? '';
        $email = $_POST['email_usuario'] ?? '';
        $senha = $_POST['senha_usuario'] ?? '';
        $tipo = $_POST['tipo_usuario'] ?? 'cliente'; 
        
        if($this->usuario->inserirUsuario(
            $nome,
            $email,
            $senha,
            $tipo,
            $imagem // Passa o caminho da imagem ou null/false
        )){
            Redirect::redirecionarComMensagem("/usuario/listar", "success", "Usuário criado com sucesso.");
        } else {
            Redirect::redirecionarComMensagem("/usuario/criar", "error", "Erro ao criar usuário. Tente novamente.");
        }
    }
    
    // VIEW DE EDIÇÃO
    public function viewEditarUsuarios(int $id){
        $usuario = $this->usuario->buscarUsuariosPorId($id);
        if(!$usuario){
            Redirect::redirecionarComMensagem("/usuario/listar", "error", "Usuário não encontrado.");
            return;
        }
        View::render("usuario/editar", ["usuario" => $usuario]);
    }

    public function atualizarUsuario(int $id){
    
        Redirect::redirecionarComMensagem("/usuario/listar", "success", "Usuário atualizado com sucesso.");
    }
    
    // VIEW DE EXCLUSÃO
    public function viewExcluirUsuarios(int $id){
        $usuario = $this->usuario->buscarUsuariosPorId($id);
        if(!$usuario){
            Redirect::redirecionarComMensagem("/usuario/listar", "error", "Usuário não encontrado.");
            return;
        }
        View::render("usuario/excluir", ["usuario" => $usuario]);
    }

    public function deletarUsuario(int $id){
    
        if($this->usuario->excluirUsuario($id)){
            Redirect::redirecionarComMensagem("/usuario/listar", "success", "Usuário excluído com sucesso.");
        } else {
            Redirect::redirecionarComMensagem("/usuario/listar", "error", "Erro ao excluir usuário.");
        }
    }
    
    // Métodos de Relatório (A implementação fica aqui)
    public function relatorioUsuario(int $id, string $data1, string $data2){
        // Lógica de relatório
        echo "Relatório do usuário ID: $id de $data1 a $data2";
    }

}