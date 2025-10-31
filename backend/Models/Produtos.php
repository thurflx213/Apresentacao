<?php

namespace App\Koketsu\Models;
use PDO;

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
  public function buscarProdutosAtivos(){
        $sql = "SELECT id_produto, nome_produtos, preco_produtos, imagem_produtos FROM tbl_produtos WHERE excluido_em is null";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

 function buscarProdutoPorId($id) {
    $sql = "SELECT * FROM tbl_produtos
            WHERE id_produto = :id_produto AND excluido_em IS NULL"; 
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_produto', $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function buscarPorID(int $id){
        $sql = "SELECT * FROM tbl_produtos WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function paginacao(int $pagina = 1, int $porPagina = 50){
        $offset = ($pagina - 1) * $porPagina;
        $sql = "SELECT * FROM tbl_produtos
                LIMIT :offset, :porPagina";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalStmt = $this->db->query("SELECT COUNT(*) FROM tbl_produtos");
        $total = $totalStmt->fetchColumn();
        $totalPaginas = ceil($total / $porPagina);

        return [
            'data' => $dados,
            'total' => (int) $total,
            'por_pagina' => (int) $porPagina,
            'pagina_atual' => (int) $pagina,
            'total_paginas' => (int) $totalPaginas
        ];
    }
    function totalDeProdutos() {
    $sql = "SELECT COUNT(*) AS total FROM tbl_produtos";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_COLUMN);
}
  // Inserir novo produto
  function inserirProduto(string $nome, string $descricao, string $imagem) {
    $sql = "INSERT INTO tbl_produtos 
            (nome_produtos, descricao_produtos,imagem_produtos, excluido_em, criado_em)
            VALUES (:nome, :descricao, :imagem, 'Ativo', NOW())";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':imagem', $imagem);
    if($stmt->execute()) {
      return $this->db->lastInsertId();
    } else {
      return false;
    }
  }

  // Atualizar produto existente
  // Arquivo: backend/Models/Produtos.php

// Função atualizarProduto
public function atualizarProduto(string $id_produto, string $nome, string $descricao, string $preco, string $estoque, ?string $imagem, string $id_categoria) {
    $sql = "UPDATE tbl_produtos
    SET nome_produtos = :nome,
    descricao_produtos = :descricao, -- O parâmetro :descricao deve ser definido
    preco_produtos = :preco,
    estoque_produtos = :estoque,
    id_categoria = :categoria,
    atualizado_em = NOW()";

    if ($imagem) {
        $sql .= ", imagem_produtos = :imagem";
    }
    
    $sql .= " WHERE id_produto = :id_produto";

    $stmt = $this->db->prepare($sql);

    // Adicionado bindParam para a descrição
    $stmt->bindParam(':descricao', $descricao); // NOVO
    
    // Bindings existentes (certifique-se de que correspondem exatamente aos parâmetros no SQL)
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':estoque', $estoque);
    $stmt->bindParam(':categoria', $id_categoria); // Usando 'categoria' como placeholder para id_categoria
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    
    if ($imagem) {
        $stmt->bindParam(':imagem', $imagem);
    }
    
    return $stmt->execute();
}

  public function ativarProduto(int $id) {
    $coluna = NULL; 
    $sql = "UPDATE tbl_produtos SET excluido_em = :excluido_em WHERE id_produto = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':excluido_em', $coluna, PDO::PARAM_NULL); 
    
    return $stmt->execute();
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

  public function deletarProdutos(int $id){
        $agora = date("Y-m-d h:m:s");
        $status = $this->buscarPorID($id);
        $status = $status['excluido_em'] != NULL ? NULL : $agora;

        $sql = "UPDATE tbl_produtos SET excluido_em = :excluido_em WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':excluido_em', $status);
        return $stmt->execute();
    }

    

    public function categoriasProdu() {
    $sql = "SELECT COUNT(*) as total,nome_produtos as produto FROM `tbl_produtos` GROUP BY id_categoria";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    }
