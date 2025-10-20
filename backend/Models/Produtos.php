<?php

class Produtos {
  private $id_produto;
  private $nome_produtos;
  private $descricao_produtos;
  private $preco_produtos;
  private $estoque_produtos;
  private $imagem_produtos;
  private $id_categoria;
  private $criado_em;
  private $atualizado_em;
  private $excluido_em;
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  // Buscar todos os produtos ativos
  function buscarProdutos() {
    $sql = "SELECT * FROM tbl_produtos WHERE excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Buscar produto específico pelo ID
  function buscarProdutoPorId($id_produto) {
    $sql = "SELECT * FROM tbl_produtos 
            WHERE id_produto = :id AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id_produto);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  // Inserir novo produto
  function inserirProduto($nome, $descricao, $preco, $estoque, $imagem, $id_categoria) {
    $sql = "INSERT INTO tbl_produtos 
            (nome_produtos, descricao_produtos, preco_produtos, estoque_produtos, imagem_produtos, id_categoria, criado_em)
            VALUES (:nome, :descricao, :preco, :estoque, :imagem, :id_categoria, NOW())";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':id_categoria', $id_categoria);
    if($stmt->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }

  // Atualizar produto existente
  function atualizarProduto($id_produto, $nome, $descricao, $preco, $estoque, $imagem, $id_categoria) {
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_produtos SET 
            nome_produtos = :nome,
            descricao_produtos = :descricao,
            preco_produtos = :preco,
            estoque_produtos = :estoque,
            imagem_produtos = :imagem,
            id_categoria = :id_categoria,
            atualizado_em = :atualizado_em
            WHERE id_produto = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque);
    $stmt->bindParam(':imagem', $imagem);
    $stmt->bindParam(':id_categoria', $id_categoria);
    $stmt->bindParam(':atualizado_em', $dataatual);
    $stmt->bindParam(':id', $id_produto);
    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Excluir (soft delete) produto
  function excluirProduto($id_produto) {
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_produtos SET excluido_em = :excluido_em 
            WHERE id_produto = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':excluido_em', $dataatual);
    $stmt->bindParam(':id', $id_produto);
    return $stmt->execute();
  }
}