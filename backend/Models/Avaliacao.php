<?php
namespace App\Koketsu\Models;
use PDO;
class Avaliacao {
    private $id_avaliacoes;
    private $id_produto;
    private $id_cliente;
    private $nota_avaliacoes;
    private $comentario_avaliacoes;
    private $data_avaliacao_avaliacoes;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Buscar todas as avaliações (não excluídas)
    public function buscarAvaliacoes() {
        $sql = "SELECT * FROM tbl_avaliacoes WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar avaliações de um produto específico
    public function buscarPorProduto($id_produto) {
        $sql = "SELECT * FROM tbl_avaliacoes WHERE id_produto = :id_produto AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar avaliações de um cliente específico
    public function buscarPorCliente($id_cliente) {
        $sql = "SELECT * FROM tbl_avaliacoes WHERE id_cliente = :id_cliente AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Inserir nova avaliação
    public function inserirAvaliacao($id_produto, $id_cliente, $nota, $comentario) {
        $sql = "INSERT INTO tbl_avaliacoes 
                (id_produto, id_cliente, nota_avaliacoes, comentario_avaliacoes, data_avaliacao_avaliacoes, criado_em)
                VALUES (:id_produto, :id_cliente, :nota, :comentario, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':comentario', $comentario);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Atualizar avaliação existente
    public function atualizarAvaliacao($id_avaliacoes, $nota, $comentario) {
        $sql = "UPDATE tbl_avaliacoes 
                SET nota_avaliacoes = :nota,
                    comentario_avaliacoes = :comentario,
                    atualizado_em = NOW()
                WHERE id_avaliacoes = :id_avaliacoes AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_avaliacoes', $id_avaliacoes);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':comentario', $comentario);

        return $stmt->execute();
    }

    // Exclusão lógica da avaliação
    public function excluirAvaliacao($id_avaliacoes) {
        $sql = "UPDATE tbl_avaliacoes SET excluido_em = NOW() WHERE id_avaliacoes = :id_avaliacoes";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_avaliacoes', $id_avaliacoes);

        return $stmt->execute();
    }

    // Paginacao para uso em controllers/admin
    public function paginacao(int $pagina = 1, int $por_pagina = 30): array
    {
        $totalQuery = "SELECT COUNT(*) FROM `tbl_avaliacoes` WHERE excluido_em IS NULL";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `tbl_avaliacoes` WHERE excluido_em IS NULL LIMIT :limit OFFSET :offset";
        $dataStmt = $this->db->prepare($dataQuery);
        $dataStmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
        $dataStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $dataStmt->execute();
        $dados = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

        return [
            'data' => $dados,
            'total' => (int) $total_de_registros,
            'por_pagina' => (int) $por_pagina,
            'pagina_atual' => (int) $pagina,
            'total_paginas' => (int) ceil($total_de_registros / $por_pagina)
        ];
    }

    public function totalDeAvaliacoes(): int
    {
        $sql = "SELECT COUNT(*) FROM tbl_avaliacoes WHERE excluido_em IS NULL";
        $stmt = $this->db->query($sql);
        return (int) $stmt->fetchColumn();
    }

    public function buscarAvaliacoesInativos(): int
    {
        $sql = "SELECT COUNT(*) FROM tbl_avaliacoes WHERE excluido_em IS NOT NULL";
        $stmt = $this->db->query($sql);
        return (int) $stmt->fetchColumn();
    }

    public function buscarAvaliacoesAtivos(): int
    {
        $sql = "SELECT COUNT(*) FROM tbl_avaliacoes WHERE excluido_em IS NULL";
        $stmt = $this->db->query($sql);
        return (int) $stmt->fetchColumn();
    }
}
