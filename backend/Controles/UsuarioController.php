<?php
namespace App\Koketsu\controles;


use App\Koketsu\Controles\Admin\AdminController;
use App\Koketsu\Models\Usuario;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Core\FileManager;
use App\Koketsu\Validadores\UsuarioValidador;
use App\Koketsu\Controles\Admin\AuthenticatedController;

class UsuarioController extends AdminController{
    public $usuario;
    public $db;
    public $gerenciarImagem;
    public function __construct() {
        parent::__construct();
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
        $this->gerenciarImagem = new FileManager('upload');
    }
    // index

    public function viewListarUsuarios($pagina = 1){
    $dados = $this->usuario->paginacao($pagina);
    $total = $this->usuario->totalDeUsuarios();
    $total_inativos = $this->usuario->buscarUsuariosInativos($pagina);
    $total_ativos = $this->usuario->buscarUsuariosAtivos($pagina);
    view::render('usuario/index', 
    [
        "usuarios" => $dados['data'],
        "total_usuarios" => $total,
        "total_inativos" => $total_inativos,
        "total_ativos" => $total_ativos,
        'paginacao' => $dados
    ] 
  );
    }

    public function viewCriarUsuarios(){
        View::render("usuario/create");
    }

    public function viewEditarUsuarios(int $id){
        $dados = $this->usuario->buscarUsuariosPorId($id);
       foreach($dados as $usuario){
        $dados = $usuario;
       }
       View::render("usuario/edit", ["usuario" => $dados]);
    }

    public function viewExcluirUsuarios($id){
         $dados = $this->usuario->buscarUsuariosPorId($id);
       foreach($dados as $usuario){
        $dados = $usuario;
        }
         View::render("usuario/delete",["usuario" => $dados]);
    }
    public function relatorioUsuario($id, $data1, $data2){
     View::render("usuario/relatorio",
           ["id" => $id, "data1" => $data1, "data2" => $data2]
      );
    }
    public function salvarUsuario(){
        $erros = UsuarioValidador::ValidarEntradas($_POST);
        if(!empty($erros)){
            Redirect::redirecionarComMensagem("usuario/criar", "error", implode("<br>", $erros));
            
        }
        $imagem = $this->gerenciarImagem->salvarArquivo($_FILES['imagem'], 'usuario');
       if($this->usuario->inserirUsuario(
            $_POST["nome_usuario"],
            $_POST["email_usuario"],
            $_POST["senha_usuario"],
            $_POST["nivel_acesso"],
            "Ativo",
            $imagem
        )){
            Redirect::redirecionarComMensagem("usuario/listar", "success", "Usuário criado com sucesso!");
        }else{
            Redirect::redirecionarComMensagem("usuario/create", "error", "Erro ao criar usuário. Tente novamente.");
        }
    }
    public function viewEditarUsuario(int $id) {
        $usuario = $this->usuario->buscarPorID($id);
        if (!$usuario) {
            Redirect::redirecionarComMensagem("usuario/listar", "error", "Serviço não encontrado.");
        }
        
        View::render("usuario/edit", ["usuario" => $usuario]);
    }
       public function atualizarUsuario(){
        $id = (int)$_POST['id_usuarios'];
        $nome = $_POST['nome_usuarios'];
        $email = $_POST['email_usuarios'];
        $senha = $_POST['senha_usuarios'];
        $tipo = $_POST['nivel_acesso'];
        $imagem = null;

        if (isset($_FILES['foto_usuario']) && $_FILES['foto_usuario']['error'] == 0 && !empty($_FILES['foto_usuario']['name'])) {
            $imagem = $this->gerenciarImagem->salvarArquivo($_FILES['foto_usuario'], 'usuarios');
        }
        if ($this->usuario->atualizarUsuario($id, $nome, $email, $senha, $tipo, $imagem)) {
            Redirect::redirecionarComMensagem("/usuario/listar", "success", "Usuário atualizado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/usuario/editar" . $id, "error", "Erro ao atualizar usuário.");
        }
    }
    public function viewExcluirUsuario(int $id) {
        $usuario = $this->usuario->buscarPorID($id);
        if (!$usuario) {
            Redirect::redirecionarComMensagem("/usuario/listar", "error", "Usuario não encontrado.");
        }

        View::render("/usuario/delete", ["usuario" => $usuario]);
    }
    public function deletarUsuario(){
        $id = (int)$_POST['id_usuarios'];
        if ($this->usuario->deletarUsuario($id)) {
            Redirect::redirecionarComMensagem("/usuario/listar", "success", "Usuario inativado com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("/usuario/listar", "error", "Erro ao inativar usuario.");
        }
    }
    
}
