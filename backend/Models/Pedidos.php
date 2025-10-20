<?php

class Pedidos {
  private $id_pedido;
  private $id_cliente;
  private $data_pedido;
  private $total_pedido;
  private $status_pedido;
  private $criado_em;
  private $atualizado_em;
  private $excluido_em;
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  // Buscar todos os pedidos ativos
  function buscarPedidos() {
    $sql = "SELECT * FROM tbl_pedidos WHERE excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Buscar pedido por ID
  function buscarPedidoPorId($id_pedido) {
    $sql = "SELECT * FROM tbl_pedidos 
            WHERE id_pedido = :id AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id_pedido);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Buscar pedidos de um cliente específico
  function buscarPedidosPorCliente($id_cliente) {
    $sql = "SELECT * FROM tbl_pedidos 
            WHERE id_cliente = :id_cliente AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Inserir novo pedido
  function inserirPedido($id_cliente, $data_pedido, $total_pedido, $status_pedido) {
    $sql = "INSERT INTO tbl_pedidos 
            (id_cliente, data_pedido, total_pedido, status_pedido, criado_em) 
            VALUES (:id_cliente, :data_pedido, :total_pedido, :status_pedido, NOW())";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_cliente', $id_cliente);
    $stmt->bindParam(':data_pedido', $data_pedido);
    $stmt->bindParam(':total_pedido', $total_pedido);
    $stmt->bindParam(':status_pedido', $status_pedido);
    if($stmt->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }

  // Atualizar pedido existente
  function atualizarPedido($id_pedido, $total_pedido, $status_pedido) {
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_pedidos SET 
            total_pedido = :total_pedido,
            status_pedido = :status_pedido,
            atualizado_em = :atualizado_em
            WHERE id_pedido = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':total_pedido', $total_pedido);
    $stmt->bindParam(':status_pedido', $status_pedido);
    $stmt->bindParam(':atualizado_em', $dataatual);
    $stmt->bindParam(':id', $id_pedido);
    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Excluir pedido
  function excluirPedido($id_pedido) {
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_pedidos SET excluido_em = :excluido_em 
            WHERE id_pedido = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':excluido_em', $dataatual);
    $stmt->bindParam(':id', $id_pedido);
    return $stmt->execute();
  }
}