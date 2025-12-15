<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Avaliacao;
use App\Koketsu\Database\Database;
use App\Koketsu\Core\View;
use App\Koketsu\Core\Redirect;
use App\Koketsu\Core\Session;

class AvaliacaoController
{
    private $avaliacao;
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
        $this->avaliacao = new Avaliacao($this->db);
    }

    // retorna lista (usado por API ou por outros consumidores)
    public function index()
    {
        return $this->avaliacao->buscarAvaliacoes();
    }

    // view para listar avaliações no admin
    public function viewListarAvaliacoes($pagina = 1)
    {
        if (empty($pagina) || $pagina <= 0) {
            $pagina = 1;
        }

        $dados = $this->avaliacao->paginacao($pagina);
        $total = $this->avaliacao->totalDeAvaliacoes();
        $total_inativos = $this->avaliacao->buscarAvaliacoesInativos();
        $total_ativos = $this->avaliacao->buscarAvaliacoesAtivos();

        View::render('avaliacao/index', [
            'avaliacoes' => $dados['data'],
            'total_avaliacoes' => $total,
            'total_inativos' => $total_inativos,
            'total_ativos' => $total_ativos,
            'paginacao' => $dados,
        ]);
    }

    // criar view
    public function viewCriarAvaliacoes()
    {
        View::render('avaliacao/create');
    }

    // salvar avaliação (POST)
    public function salvarAvaliacao()
    {
        $nota = isset($_POST['nota_avaliacoes']) ? (int) $_POST['nota_avaliacoes'] : null;
        $comentario = $_POST['comentario_avaliacoes'] ?? null;
        $id_produto = isset($_POST['id_produto']) ? (int) $_POST['id_produto'] : null;

        if (!$id_produto || !$nota) {
            Redirect::redirecionarComMensagem('/backend/avaliacao/criar', 'error', 'Produto e nota são obrigatórios.');
        }

        $session = new Session();
        $id_cliente = $session->get('usuario_id') ?? 1;

        if ($this->avaliacao->inserirAvaliacao($id_produto, $id_cliente, $nota, $comentario)) {
            Redirect::redirecionarComMensagem('/backend/avaliacao/listar', 'success', 'Avaliação salva com sucesso.');
        }

        Redirect::redirecionarComMensagem('/backend/avaliacao/criar', 'error', 'Erro ao salvar avaliação.');
    }

    // atualizar (POST)
    public function atualizarAvaliacao($id)
    {
        $nota = isset($_POST['nota_avaliacoes']) ? (int) $_POST['nota_avaliacoes'] : null;
        $comentario = $_POST['comentario_avaliacoes'] ?? null;

        if ($this->avaliacao->atualizarAvaliacao((int) $id, $nota, $comentario)) {
            Redirect::redirecionarComMensagem('/backend/avaliacao/listar', 'success', 'Avaliação atualizada.');
        }

        Redirect::redirecionarComMensagem('/backend/avaliacao/editar/' . $id, 'error', 'Erro ao atualizar avaliação.');
    }

    // deletar (POST)
    public function deletarAvaliacao($id)
    {
        if ($this->avaliacao->excluirAvaliacao((int) $id)) {
            Redirect::redirecionarComMensagem('/backend/avaliacao/listar', 'success', 'Avaliação excluída.');
        }
        Redirect::redirecionarComMensagem('/backend/avaliacao/listar', 'error', 'Erro ao excluir avaliação.');
    }

    // view editar
    public function viewEditarAvaliacoes($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM tbl_avaliacoes WHERE id_avaliacoes = :id AND excluido_em IS NULL');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$dados) {
            Redirect::redirecionarComMensagem('/backend/avaliacao/listar', 'error', 'Avaliação não encontrada.');
        }
        View::render('avaliacao/edit', ['avaliacoes' => $dados]);
    }

    // view excluir (confirmação)
    public function viewExcluirAvaliacoes($id)
    {
        $stmt = $this->db->prepare('SELECT * FROM tbl_avaliacoes WHERE id_avaliacoes = :id AND excluido_em IS NULL');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$dados) {
            Redirect::redirecionarComMensagem('/backend/avaliacao/listar', 'error', 'Avaliação não encontrada.');
        }
        View::render('avaliacao/delete', ['avaliacoes' => $dados]);
    }
}