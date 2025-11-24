<?php
namespace App\Koketsu\Models;
use PDO;

class Carrinho {
    private $id_carrinho;
    private $id_cliente;
    private $data_pedido_carrinho;
    private $total_carrinho;
    private $status_carrinho;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // --- Métodos de Contagem ---

    /**
     * Retorna a contagem total de carrinhos ATIVOS.
     */
    public function totalDeCarrinhos(): int {
        $totalQuery = "SELECT COUNT(*) FROM tbl_carrinho WHERE excluido_em IS NULL";
        $totalStmt = $this->db->query($totalQuery);
        return (int) $totalStmt->fetchColumn();
    }

    /**
     * Retorna a contagem de carrinhos ATIVOS (não excluídos).
     */
    public function buscarCarrinhosAtivos(): int {
        return $this->totalDeCarrinhos(); // Reutiliza a contagem de ativos
    }

    /**
     * Retorna a contagem de carrinhos INATIVOS (excluídos logicamente).
     */
    public function buscarCarrinhosInativos(): int {
        $totalQuery = "SELECT COUNT(*) FROM tbl_carrinho WHERE excluido_em IS NOT NULL";
        $totalStmt = $this->db->query($totalQuery);
        return (int) $totalStmt->fetchColumn();
    }

    // --- Métodos de Busca de Dados ---

    /**
     * Busca todos os carrinhos ATIVOS (não excluídos).
     */
    public function buscarCarrinhos() {
        $sql = "SELECT * FROM tbl_carrinho WHERE excluido_em IS NULL ORDER BY data_pedido_carrinho DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Busca um único carrinho ATIVO pelo ID.
     * Renomeado de 'buscarPorId' para 'buscarCarrinhoPorId' para consistência.
     */
    public function buscarCarrinhoPorId($id_carrinho) {
        $sql = "SELECT * FROM tbl_carrinho WHERE id_carrinho = :id_carrinho AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Busca carrinhos de um cliente específico (apenas ativos).
     */
    public function buscarPorCliente($id_cliente) {
        $sql = "SELECT * FROM tbl_carrinho WHERE id_cliente = :id_cliente AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    // --- Métodos de Paginação ---

    /**
     * Pagina os carrinhos ATIVOS.
     */
    public function paginacao(int $pagina = 1, int $por_pagina = 10): array {
        // CORRIGIDO: Agora usa tbl_carrinho e filtra por excluido_em IS NULL
        $totalQuery = "SELECT COUNT(*) FROM `tbl_carrinho` WHERE excluido_em IS NULL";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        
        $offset = ($pagina - 1) * $por_pagina;
        
        $dataQuery = "SELECT * FROM `tbl_carrinho` WHERE excluido_em IS NULL ORDER BY data_pedido_carrinho DESC LIMIT :limit OFFSET :offset";
        $dataStmt = $this->db->prepare($dataQuery);
        
        $dataStmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
        $dataStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $dataStmt->execute();
        
        $dados = $dataStmt->fetchAll(PDO::FETCH_ASSOC);
        $lastPage = ceil($total_de_registros / $por_pagina);
    
        return [
            'data' => $dados,
            'total' => (int) $total_de_registros,
            'por_pagina' => (int) $por_pagina,
            'pagina_atual' => (int) $pagina,
            'ultima_pagina' => (int) $lastPage,
            'de' => $offset + 1,
            'para' => $offset + count($dados)
        ];
    }

    // --- Métodos de CRUD (Baseados em Carrinho/Pedido) ---

    /**
     * Insere um novo carrinho/pedido.
     */
    public function inserirCarrinho(int $id_cliente, float $total_carrinho, string $status_carrinho = 'Aberto'): int|false {
        $sql = "INSERT INTO tbl_carrinho 
                (id_cliente, total_carrinho, status_carrinho, data_pedido_carrinho, criado_em)
                VALUES (:id_cliente, :total, :status, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total_carrinho);
        $stmt->bindParam(':status', $status_carrinho);

        if ($stmt->execute()) {
            return (int) $this->db->lastInsertId();
        }
        return false;
    }
    
    /**
     * Atualiza o carrinho (status e/ou total).
     */
    public function atualizarCarrinho(int $id_carrinho, ?float $total_carrinho = null, ?string $status_carrinho = null): bool {
        $setParts = [];
        if ($total_carrinho !== null) $setParts[] = "total_carrinho = :total";
        if ($status_carrinho !== null) $setParts[] = "status_carrinho = :status";
        
        // Se nada para atualizar, retorna true (considerado sucesso)
        if (empty($setParts)) return true;

        $setParts[] = "atualizado_em = NOW()";
        $sql = "UPDATE tbl_carrinho SET " . implode(', ', $setParts) . " WHERE id_carrinho = :id_carrinho AND excluido_em IS NULL";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
        if ($total_carrinho !== null) $stmt->bindParam(':total', $total_carrinho);
        if ($status_carrinho !== null) $stmt->bindParam(':status', $status_carrinho);

        return $stmt->execute();
    }

    /**
     * Exclusão lógica (soft delete) do carrinho.
     */
    public function deletarCarrinho(int $id_carrinho): bool {
        $sql = "UPDATE tbl_carrinho SET excluido_em = NOW() WHERE id_carrinho = :id_carrinho";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);

        return $stmt->execute();
    }
}
