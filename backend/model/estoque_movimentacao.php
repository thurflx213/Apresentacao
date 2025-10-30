<?php
namespace App\Koketsu\Model;
use PDO;

class EstoqueMovimentacao {
    private $id_estoque_movimentacao;
    private $id_produto;
    private $tipo_estoque_movimentacao;
    private $quantidade_estoque_movimentacao;
    private $data_movimentacao_estoque_movimentacao;
    private $descricao_estoque_movimentacao;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function buscarEstoqueMovimentacao() {
        $sql = "SELECT * FROM tbl_estoque_movimentacao WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorProduto($id_produto) {
        $sql = "SELECT * FROM tbl_estoque_movimentacao 
                WHERE id_produto = :id_produto AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function buscarEstoqueMovimentacaoPorId($id_estoque_movimentacao) {
        $sql = "SELECT * FROM tbl_estoque_movimentacao 
                WHERE id_estoque_movimentacao = :id AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_estoque_movimentacao);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function inserirMovimentacao($id_produto, $tipo, $quantidade, $descricao = null) {
        $sql = "INSERT INTO tbl_estoque_movimentacao 
                (id_produto, tipo_estoque_movimentacao, quantidade_estoque_movimentacao, 
                 data_movimentacao_estoque_movimentacao, descricao_estoque_movimentacao, criado_em)
                VALUES (:id_produto, :tipo, :quantidade, NOW(), :descricao, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':descricao', $descricao);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    
    public function atualizarMovimentacao($id_estoque_movimentacao, $quantidade = null, $descricao = null) {
        $updates = [];

        if ($quantidade !== null) {
            $updates[] = "quantidade_estoque_movimentacao = :quantidade";
        }
        if ($descricao !== null) {
            $updates[] = "descricao_estoque_movimentacao = :descricao";
        }

        if (empty($updates)) {
            return true;
        }

        $sql = "UPDATE tbl_estoque_movimentacao SET ";
        $sql .= implode(', ', $updates);
        $sql .= ", atualizado_em = NOW() WHERE id_estoque_movimentacao = :id AND excluido_em IS NULL";

        $stmt = $this->db->prepare($sql);
        if ($quantidade !== null) {
            $stmt->bindParam(':quantidade', $quantidade);
        }
        if ($descricao !== null) {
            $stmt->bindParam(':descricao', $descricao);
        }
        $stmt->bindParam(':id', $id_estoque_movimentacao);

        return $stmt->execute();
    }

    public function excluirMovimentacao($id_estoque_movimentacao) {
        $sql = "UPDATE tbl_estoque_movimentacao SET excluido_em = NOW() WHERE id_estoque_movimentacao = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_estoque_movimentacao);
        return $stmt->execute();
    }

    /**
     * @deprecated Use inserirMovimentacao() em vez disso.
     * Esta função estava aninhada incorretamente.
     */
    public function salvarMovimentacao($id_produto, $tipo, $quantidade, $data, $descricao = null) {
        $sql = "INSERT INTO tbl_estoque_movimentacao 
                (id_produto, tipo_estoque_movimentacao, quantidade_estoque_movimentacao, 
                 data_movimentacao_estoque_movimentacao, descricao_estoque_movimentacao, criado_em)
                VALUES (:id_produto, :tipo, :quantidade, :data, :descricao, NOW())";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':quantidade', $quantidade);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':descricao', $descricao);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
   
    public function paginacao(int $pagina = 1, int $por_pagina = 10): array{
       
        $totalQuery = "SELECT COUNT(*) FROM `tbl_estoque_movimentacao` WHERE excluido_em IS NULL";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        
        $offset = ($pagina - 1) * $por_pagina;

        // Seleção dos dados ATIVOS para a página atual
        $dataQuery = "SELECT * FROM `tbl_estoque_movimentacao` WHERE excluido_em IS NULL LIMIT :limit OFFSET :offset";
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
}
