<?php

class ItensPedidos {
  private $id_itens_pedidos;
  private $id_pedido;
  private $id_produto;
  private $quantidade;
  private $preco_unitario;
  private $criado_em;
  private $atualizado_em;
  private $excluido_em;
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  // Buscar todos os itens pedidos ativos
  function buscarItensPedidos() {
    $sql = "SELECT * FROM tbl_itens_pedidos WHERE excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Buscar itens de um pedido específico
  function buscarItensPorPedido($id_pedido) {
    $sql = "SELECT * FROM tbl_itens_pedidos 
            WHERE id_pedido = :id_pedido AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_pedido', $id_pedido);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Inserir item de pedido
  function inserirItemPedido($id_pedido, $id_produto, $quantidade, $preco_unitario) {
    $sql = "INSERT INTO tbl_itens_pedidos 
            (id_pedido, id_produto, quantidade, preco_unitario, criado_em) 
            VALUES (:id_pedido, :id_produto, :quantidade, :preco_unitario, NOW())";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_pedido', $id_pedido);
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':preco_unitario', $preco_unitario);
    if($stmt->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }

  // Atualizar item de pedido
  function atualizarItemPedido($id_itens_pedidos, $quantidade, $preco_unitario) {
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_itens_pedidos SET 
            quantidade = :quantidade,
            preco_unitario = :preco_unitario,
            atualizado_em = :atualizado_em
            WHERE id_itens_pedidos = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':preco_unitario', $preco_unitario);
    $stmt->bindParam(':atualizado_em', $dataatual);
    $stmt->bindParam(':id', $id_itens_pedidos);
    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Excluir (soft delete) item de pedido
  function excluirItemPedido($id_itens_pedidos) {
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_itens_pedidos SET excluido_em = :excluido_em 
            WHERE id_itens_pedidos = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':excluido_em', $dataatual);
    $stmt->bindParam(':id', $id_itens_pedidos);
    return $stmt->execute();
  }
}

