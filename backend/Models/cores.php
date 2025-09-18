<?php

class Cor {
  private $id_cores;
  private $id_produto;
  private $cor_cores;
  private $quantidade_cores;
  private $criado_em;
  private $atualizado_em;
  private $excluido_em;
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  // Método para buscar todas as cores não excluídas
  function buscarCores() {
    $sql = "SELECT * FROM tbl_cores WHERE excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Método para buscar cores por produto
  function buscarCoresPorIdProduto($id_produto) {
    $sql = "SELECT * FROM tbl_cores WHERE id_produto = :id_produto AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Método para inserir uma nova cor
  function inserirCor($id_produto, $cor, $quantidade) {
    $sql = "INSERT INTO tbl_cores (id_produto, cor_cores, quantidade_cores) 
            VALUES (:id_produto, :cor, :quantidade)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->bindParam(':cor', $cor);
    $stmt->bindParam(':quantidade', $quantidade);
    if ($stmt->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }

  // Método para atualizar uma cor existente
  function atualizarCor($id_cores, $id_produto, $cor, $quantidade) {
    $dataAtual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_cores SET 
        id_produto = :id_produto, 
        cor_cores = :cor, 
        quantidade_cores = :quantidade, 
        atualizado_em = :atualizado 
        WHERE id_cores = :id_cores AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_cores', $id_cores);
    $stmt->bindParam(':id_produto', $id_produto);
    $stmt->bindParam(':cor', $cor);
    $stmt->bindParam(':quantidade', $quantidade);
    $stmt->bindParam(':atualizado', $dataAtual);
     if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }
  

  // Método para deletar (soft delete) uma cor
  function deletarCor($id_cores) {
    $dataAtual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_cores SET excluido_em = :excluido WHERE id_cores = :id_cores";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_cores', $id_cores);
    $stmt->bindParam(':excluido', $dataAtual);
    return $stmt->execute();
  }
}
