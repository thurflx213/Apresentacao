<?php

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

    // Buscar todos os carrinhos (não excluídos)
    public function buscarCarrinhos() {
        $sql = "SELECT * FROM tbl_carrinho WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar carrinhos de um cliente específico
    public function buscarPorCliente($id_cliente) {
        $sql = "SELECT * FROM tbl_carrinho WHERE id_cliente = :id_cliente AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar carrinho por ID
    public function buscarPorId($id_carrinho) {
        $sql = "SELECT * FROM tbl_carrinho WHERE id_carrinho = :id_carrinho AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_carrinho', $id_carrinho);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inserir novo carrinho
    public function inserirCarrinho($id_cliente, $total_carrinho, $status_carrinho = 'aberto') {
        $sql = "INSERT INTO tbl_carrinho 
                (id_cliente, data_pedido_carrinho, total_carrinho, status_carrinho, criado_em)
                VALUES (:id_cliente, NOW(), :total_carrinho, :status_carrinho, NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':total_carrinho', $total_carrinho);
        $stmt->bindParam(':status_carrinho', $status_carrinho);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Atualizar carrinho (total ou status)
    public function atualizarCarrinho($id_carrinho, $total_carrinho = null, $status_carrinho = null) {
        $sql = "UPDATE tbl_carrinho SET ";
        $updates = [];
        
        if ($total_carrinho !== null) {
            $updates[] = "total_carrinho = :total_carrinho";
        }
        if ($status_carrinho !== null) {
            $updates[] = "status_carrinho = :status_carrinho";
        }

        $sql .= implode(', ', $updates);
        $sql .= ", atualizado_em = NOW() WHERE id_carrinho = :id_carrinho AND excluido_em IS NULL";

        $stmt = $this->db->prepare($sql);
        if ($total_carrinho !== null) {
            $stmt->bindParam(':total_carrinho', $total_carrinho);
        }
        if ($status_carrinho !== null) {
            $stmt->bindParam(':status_carrinho', $status_carrinho);
        }
        $stmt->bindParam(':id_carrinho', $id_carrinho);

        return $stmt->execute();
    }

    // Exclusão lógica do carrinho
    public function excluirCarrinho($id_carrinho) {
        $sql = "UPDATE tbl_carrinho SET excluido_em = NOW() WHERE id_carrinho = :id_carrinho";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_carrinho', $id_carrinho);
        return $stmt->execute();
    }
}
