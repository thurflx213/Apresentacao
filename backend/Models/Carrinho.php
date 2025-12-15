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

    // Buscar todos os carrinhos (não excluídos)
    public function buscarCarrinhos() {
        $sql = "SELECT * FROM tbl_carrinho WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Buscar carrinhos de um cliente específico
    public function buscarPorCliente($id_cliente) {
        $sql = "SELECT * FROM tbl_carrinho WHERE id_cliente = :id_cliente AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Buscar carrinho por ID
    public function buscarPorId($id_carrinho) {
        $sql = "SELECT * FROM tbl_carrinho WHERE id_carrinho = :id_carrinho AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_carrinho', $id_carrinho);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}
