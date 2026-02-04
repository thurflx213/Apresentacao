<?php
namespace App\Koketsu\Controles;

use App\Koketsu\Models\Produtos;
use App\Koketsu\Models\Pedidos;
use App\Koketsu\Models\Usuario;
use App\Koketsu\Models\Categoria;
use App\Koketsu\Models\Cor;
use App\Koketsu\Models\Perfil;
use App\Koketsu\Models\Tamanho;
use App\Koketsu\Models\ItensPedidos;
use App\Koketsu\Models\Imagem;
use App\Koketsu\Models\Carrinho;
use App\Koketsu\Models\EstoqueMovimentacao;
use App\Koketsu\Database\Database;

class PublicApiController {
    private $produtosModel;
    private $pedidosModel;
    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
        $this->produtosModel = new Produtos($this->db);
        $this->pedidosModel = new Pedidos($this->db);
    }

    // ==================== PRODUTOS ====================
    public function getProdutos() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_produtos WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT * FROM tbl_produtos WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $dados = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        foreach ($dados as &$produto) {
            $produto['caminho_imagem'] = '/backend/upload/' . $produto['imagem_produtos'];
        }
        unset($produto);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $dados,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getProdutoById($id) {
        $id = (int)$id;
        $produto = $this->produtosModel->buscarPorId($id);
        
        header('Content-Type: application/json');
        if ($produto) {
            $produto['caminho_imagem'] = '/backend/upload/' . $produto['imagem_produtos'];
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $produto], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado']);
        }
        exit;
    }

    // ==================== PEDIDOS ====================
    public function getPedidos() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_pedidos WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados com JOIN para pegar o id_usuario
        $sql = "SELECT p.id_pedido, p.id_perfil, p.data_pedido, p.total_pedido, p.status_pedido, p.criado_em, p.atualizado_em, pf.id_usuarios 
                FROM tbl_pedidos p 
                LEFT JOIN tbl_perfil pf ON p.id_perfil = pf.id_perfil 
                WHERE p.excluido_em IS NULL 
                LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $pedidos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $pedidos,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getPedidoById($id) {
        $id = (int)$id;
        $pedido = $this->pedidosModel->buscarPedidoPorId($id);
        
        header('Content-Type: application/json');
        if ($pedido) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $pedido], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Pedido não encontrado']);
        }
        exit;
    }

    public function salvarPedido() {
        header('Content-Type: application/json');
        $carrinho = json_decode(file_get_contents('php://input'), true);
        if (empty($carrinho) || !is_array($carrinho)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Nenhum item recebido no carrinho.'
            ]);
            exit;
        }
        $novoPedidoId = $this->pedidosModel->inserirPedido($carrinho);
        if ($novoPedidoId) {
            http_response_code(201);
            echo json_encode([
                'status' => 'success',
                'message' => 'Pedido recebido com sucesso!',
                'id_pedido' => $novoPedidoId
            ]);
        } else {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => 'Ocorreu um erro ao processar seu pedido. Tente novamente.'
            ]);
        }
        exit;
    }

    public function createPedido() {
        return $this->salvarPedido();
    }

    // ==================== USUARIOS ====================
    public function getUsuarios() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_usuarios WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_usuarios, nome_usuarios, email_usuarios, nivel_acesso, foto_usuarios FROM tbl_usuarios WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $usuarios,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getUsuarioById($id) {
        $id = (int)$id;
        $sql = "SELECT id_usuarios, nome_usuarios, email_usuarios, nivel_acesso, foto_usuarios FROM tbl_usuarios WHERE id_usuarios = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($usuario) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $usuario], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Usuário não encontrado']);
        }
        exit;
    }

    public function createUsuario() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Usuário criado com sucesso']);
        exit;
    }

    // ==================== CATEGORIAS ====================
    public function getCategorias() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_categorias WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_categorias, nome_categorias FROM tbl_categorias WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $categorias = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $categorias,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getCategoriaById($id) {
        $id = (int)$id;
        $sql = "SELECT id_categorias, nome_categorias FROM tbl_categorias WHERE id_categorias = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $categoria = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($categoria) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $categoria], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Categoria não encontrada']);
        }
        exit;
    }

    public function createCategoria() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Categoria criada com sucesso']);
        exit;
    }

    // ==================== CORES ====================
    public function getCores() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_cores WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_cores, cor_cores FROM tbl_cores WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $cores = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $cores,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getCorById($id) {
        $id = (int)$id;
        $sql = "SELECT id_cores, cor_cores FROM tbl_cores WHERE id_cores = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $cor = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($cor) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $cor], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Cor não encontrada']);
        }
        exit;
    }

    public function createCor() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Cor criada com sucesso']);
        exit;
    }

    // ==================== PERFIS ====================
    public function getPerfis() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_perfil WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_perfil, endereco_perfil, id_usuarios FROM tbl_perfil WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $perfis = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $perfis,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getPerfilById($id) {
        $id = (int)$id;
        $sql = "SELECT id_perfil, endereco_perfil, id_usuarios FROM tbl_perfil WHERE id_perfil = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $perfil = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($perfil) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $perfil], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Perfil não encontrado']);
        }
        exit;
    }

    public function createPerfil() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Perfil criado com sucesso']);
        exit;
    }

    // ==================== TAMANHOS ====================
    public function getTamanhos() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_tamanhos WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_tamanhos, tamanho_tamanhos FROM tbl_tamanhos WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $tamanhos = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $tamanhos,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getTamanhoById($id) {
        $id = (int)$id;
        $sql = "SELECT id_tamanhos, tamanho_tamanhos FROM tbl_tamanhos WHERE id_tamanhos = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $tamanho = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($tamanho) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $tamanho], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Tamanho não encontrado']);
        }
        exit;
    }

    public function createTamanho() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Tamanho criado com sucesso']);
        exit;
    }

    // ==================== ITENS PEDIDOS ====================
    public function getItenspedidos() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_itens_pedidos WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_itens_pedidos, id_pedido, id_produto, quantidade, preco_unitario FROM tbl_itens_pedidos WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $itens = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $itens,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getItemPedidoById($id) {
        $id = (int)$id;
        $sql = "SELECT id_itens_pedidos, id_pedido, id_produto, quantidade, preco_unitario FROM tbl_itens_pedidos WHERE id_itens_pedidos = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $item = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($item) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $item], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Item de pedido não encontrado']);
        }
        exit;
    }

    public function createItemPedido() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Item de pedido criado com sucesso']);
        exit;
    }

    // ==================== AVALIAÇÕES ====================
    public function getAvaliacoes() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_avaliacoes WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_avaliacoes, id_cliente, id_produto, nota_avaliacoes, comentario_avaliacoes FROM tbl_avaliacoes WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $avaliacoes = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $avaliacoes,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getAvaliacaoById($id) {
        $id = (int)$id;
        $sql = "SELECT id_avaliacoes, id_cliente, id_produto, nota_avaliacoes, comentario_avaliacoes FROM tbl_avaliacoes WHERE id_avaliacoes = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $avaliacao = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($avaliacao) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $avaliacao], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Avaliação não encontrada']);
        }
        exit;
    }

    public function createAvaliacao() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Avaliação criada com sucesso']);
        exit;
    }

    // ==================== IMAGENS ====================
    public function getImagens() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_imagem WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_imagem, caminho_imagem, id_produto FROM tbl_imagem WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $imagens = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $imagens,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getImagemById($id) {
        $id = (int)$id;
        $sql = "SELECT id_imagem, caminho_imagem, id_produto FROM tbl_imagem WHERE id_imagem = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $imagem = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($imagem) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $imagem], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Imagem não encontrada']);
        }
        exit;
    }

    public function createImagem() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Imagem criada com sucesso']);
        exit;
    }

    // ==================== CARRINHO ====================
    public function getCarrinho() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_carrinho WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_carrinho, id_perfil, total_carrinho, status_carrinho FROM tbl_carrinho WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $carrinho = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $carrinho,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getCarrinhoById($id) {
        $id = (int)$id;
        $sql = "SELECT id_carrinho, id_perfil, total_carrinho, status_carrinho FROM tbl_carrinho WHERE id_carrinho = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $item = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($item) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $item], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Item do carrinho não encontrado']);
        }
        exit;
    }

    public function createCarrinho() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Item adicionado ao carrinho com sucesso']);
        exit;
    }

    // ==================== ESTOQUE ====================
    public function getEstoque() {
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $registros_por_pagina = 10;
        $offset = ($page - 1) * $registros_por_pagina;
        
        // Total de registros
        $sqlCount = "SELECT COUNT(*) as total FROM tbl_estoque_movimentacao WHERE excluido_em IS NULL";
        $stmtCount = $this->db->prepare($sqlCount);
        $stmtCount->execute();
        $total = $stmtCount->fetch(\PDO::FETCH_ASSOC)['total'];
        $total_paginas = ceil($total / $registros_por_pagina);
        
        // Dados paginados
        $sql = "SELECT id_estoque_movimentacao, id_produto, descricao_estoque_movimentacao, quantidade_estoque_movimentacao, data_estoque_movimentacao FROM tbl_estoque_movimentacao WHERE excluido_em IS NULL LIMIT " . intval($registros_por_pagina) . " OFFSET " . intval($offset);
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $estoque = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'data' => $estoque,
            'paginacao' => [
                'pagina_atual' => $page,
                'registros_por_pagina' => $registros_por_pagina,
                'total_registros' => $total,
                'total_paginas' => $total_paginas
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }

    public function getEstoqueById($id) {
        $id = (int)$id;
        $sql = "SELECT id_estoque_movimentacao, id_produto, descricao_estoque_movimentacao, quantidade_estoque_movimentacao, data_estoque_movimentacao FROM tbl_estoque_movimentacao WHERE id_estoque_movimentacao = ? AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $item = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        header('Content-Type: application/json');
        if ($item) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'data' => $item], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Movimentação de estoque não encontrada']);
        }
        exit;
    }

    public function createEstoque() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Movimentação de estoque criada com sucesso']);
        exit;
    }

    // ==================== CREATE GENÉRICO PARA PRODUTOS ====================
    public function createProduto() {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);
        if (empty($data)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
            exit;
        }
        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Produto criado com sucesso']);
        exit;
    }
}