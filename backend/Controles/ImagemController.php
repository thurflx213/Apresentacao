<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Imagem;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Core\FileManager;


class ImagemController {
    public Imagem $imagem;
    public $db;
    public $gerenciarImagens;

    public function __construct() {
        $this->db = Database::getInstance();
    $this->imagem = new Imagem($this->db);
        $this->gerenciarImagens = new FileManager("uploads/imagens"); 
    }

    public function index(){
        $resultado = $this->imagem->buscarImagens();
        return $resultado;
    }

    public function viewListarImagens($pagina){
        $dados = $this->imagem->paginacao($pagina); 
        View::render('imagem/index', [
            "imagens" => $dados['data'],
            'paginacao' => $dados
        ]);
    }

    public function viewCriarImagem(){
        View::render("imagem/create");
    }

    public function viewEditarImagem(int $id){
       $dados = $this->imagem->buscarImagemPorId($id);

       if (empty($dados)) {
           Redirect::redirecionarComMensagem("imagem/listar", "error", "Imagem não encontrada.");
           return;
       }

       View::render("imagem/edit", ["imagem" => $dados]);
    }

    public function viewExcluirImagem($id){
          View::render("imagem/delete", ["id_imagem" => $id]);
    }

    /**
     * Processa o upload do arquivo e salva o caminho no banco de dados.
     */
    public function salvarImagem() {
        if (empty($_FILES['caminho_imagem']) || $_FILES['caminho_imagem']['error'] === UPLOAD_ERR_NO_FILE) {
            Redirect::redirecionarComMensagem("imagem/create", "error", "Nenhum arquivo de imagem enviado.");
            return;
        }

        try {
            // 1. Tenta fazer o upload do arquivo usando o método correto (salvarArquivo)
            // Define um subdiretório baseado no ano/mês para organização
            $subDiretorio = date('Y/m');
            $caminho_imagem = $this->gerenciarImagens->salvarArquivo($_FILES['caminho_imagem'], $subDiretorio);
            
            // 2. Coleta os dados do formulário
            // Usa 0 para IDs que podem ser nulos no banco, se não forem enviados
            $id_produto = $_POST["id_produto"] ?? 0;
            $id_cor = $_POST["id_cor"] ?? 0;
            $id_tamanho = $_POST["id_tamanho"] ?? 0;
            $descricao = $_POST["descricao_imagem"] ?? null;

            $novoId = $this->imagem->inserirImagem(
                $id_produto,
                $id_cor,
                $id_tamanho,
                $caminho_imagem,
                $descricao
            );

            if ($novoId !== false) {
                Redirect::redirecionarComMensagem("imagens/listar", "success", "Imagem enviada e registrada com sucesso!");
            } else {
                
                $this->gerenciarImagens->delete($caminho_imagem);
                Redirect::redirecionarComMensagem("imagens/create", "error", "Erro ao registrar no banco. Arquivo excluído.");
            }
        } catch (\Exception $e) {
        
            Redirect::redirecionarComMensagem("imagens/create", "error", "Falha no upload: " . $e->getMessage());
        }
    }
    
    public function atualizarImagem() {
        if (empty($_POST["id_imagem"])) {
            Redirect::redirecionarComMensagem("imagens/listar", "error", "ID da imagem não fornecido para atualização.");
            return;
        }
        
        $id_imagem = (int)$_POST["id_imagem"];
        $dadosAtuais = $this->imagem->buscarImagemPorId($id_imagem);

        if (!$dadosAtuais) {
            Redirect::redirecionarComMensagem("imagens/listar", "error", "Imagem não encontrada.");
            return;
        }

        $caminho_imagem = $dadosAtuais['caminho_imagem'];
        $id_produto = $_POST["id_produto"] ?? 0;
        $id_cor = $_POST["id_cor"] ?? 0;
        $id_tamanho = $_POST["id_tamanho"] ?? 0;
        $descricao = $_POST["descricao_imagem"] ?? null;

        // Tenta fazer o upload do novo arquivo, se houver
        if (!empty($_FILES['caminho_imagem']) && $_FILES['caminho_imagem']['error'] == UPLOAD_ERR_OK) {
            try {
                $subDiretorio = date('Y/m');
                $novoCaminho = $this->gerenciarImagens->salvarArquivo($_FILES['caminho_imagem'], $subDiretorio);
                
                // Exclui o arquivo antigo e atualiza o caminho
                $this->gerenciarImagens->delete($dadosAtuais['caminho_imagem']); 
                $caminho_imagem = $novoCaminho;

            } catch (\Exception $e) {
                 Redirect::redirecionarComMensagem("imagens/edit/{$id_imagem}", "error", "Falha no upload do novo arquivo: " . $e->getMessage());
                return;
            }
        }

        $sucesso = $this->imagem->atualizarImagem(
            $id_imagem,
            $id_produto,
            $id_cor,
            $id_tamanho,
            $caminho_imagem,
            $descricao
        );

        if ($sucesso) {
            Redirect::redirecionarComMensagem("imagens/listar", "success", "Imagem atualizada com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("imagens/edit/{$id_imagem}", "error", "Erro ao atualizar a imagem.");
        }
    }
    
    /**
     * Exclui o registro do banco de dados e o arquivo físico.
     */
    public function deletarImagem() {
        if (empty($_POST["id_imagem"])) {
            Redirect::redirecionarComMensagem("imagens/listar", "error", "ID da imagem não fornecido para exclusão.");
            return;
        }
        
        $id_imagem = (int)$_POST["id_imagem"];
        $dadosAtuais = $this->imagem->buscarImagemPorId($id_imagem);
        
        if (!$dadosAtuais) {
            Redirect::redirecionarComMensagem("imagens/listar", "error", "Imagem não encontrada.");
            return;
        }
        
        // 1. Tenta excluir o registro do banco
        $sucesso = $this->imagem->excluirImagem($id_imagem);

        if ($sucesso) {
            // 2. Se o DB foi excluído, exclui o arquivo físico
            $this->gerenciarImagens->delete($dadosAtuais['caminho_imagem']); 
            Redirect::redirecionarComMensagem("imagens/listar", "success", "Imagem e arquivo excluídos com sucesso!");
        } else {
            Redirect::redirecionarComMensagem("imagens/delete/{$id_imagem}", "error", "Erro ao excluir a imagem do banco.");
        }
    }
}
