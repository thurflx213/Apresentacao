<?php
namespace App\Koketsu\Controllers;

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
        $this->db = Database::getInstance();
        $this->usuario = new Usuario($this->db);
        $this->gerenciarImagem = new FileManager('upload');
    }
    // index
    public function index(){
        $resultado = $this->usuario->buscarUsuarios();
       var_dump($resultado);
    }

    public function viewListarUsuarios(){
        $dados = $this->usuario->buscarUsuarios();
        View::render("usuario/index",["usuarios" => $dados]);
    }

    public function viewCriarUsuarios(){
        View::render("usuario/create");
    }

    public function viewEditarUsuarios(int $id){
       $dados = $this->usuario->buscarUsuariosPorId($id);
       var_dump($dados);
       foreach($dados as $usuario){
        $dados = $usuario;
       }
         View::render("usuario/edit", ["usuario"=> $dados]);
    }

    public function viewExcluirUsuarios($id){
         View::render("usuario/delete", ["id"=> $id]);
    }
    public function relatorioUsuario($id, $data1, $data2){
        View::render("usuario/relatorio",
        ["id"=> $id, "data1"=> $data1, "data2"=> $data2]);
    }

    public function salvarUsuario(){
        $erros = UsuarioValidador::ValidarEntradas($_POST);
        if(!empty($erros)){
            Redirect::redirecionarComMensagem("usuario/criar", "error", implode("<br>", $erros));
        }
        $imagem = $this->gerenciarImagem->salvarArquivo($_FILES['imagem'],'usuario');
        if($this->usuario->inserirUsuario(
        $_POST = ["nome_usuario"],
        $_POST = ["email_usuario"],
        $_POST = ["senha_usuario"],
        $_POST = ["tipo_usuario"],
        "Ativo",
        $imagem
        )){
            Redirect::redirecionarComMensagem("usuario/listar", "success", "Usuário criado com sucesso.");
        } else {
            Redirect::redirecionarComMensagem("usuario/criar", "error", "Erro ao criar usuário.");
        }
    }
    public function atualizarUsuario(){
        echo "Atualizar usuario";
    }
    public function deletarUsuario(){
        echo "Deletar usuario";
    }  
}