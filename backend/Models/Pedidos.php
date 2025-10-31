<?php

namespace App\Koketsu\Models;
use PDO;

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

  public function criarPedido(array $itensCarrinho){
        $this->db->beginTransaction();
        try {
            $valorTotalCalculado = 0;
            foreach ($itensCarrinho as $item) {
                $valorTotalCalculado += $item['preco'] * $item['quantidade'];
            }

            $sqlPedido = "INSERT INTO tbl_pedidos (total_pedido, data_pedido) VALUES (:total_pedido, NOW())";
            $stmtPedido = $this->db->prepare($sqlPedido);
            $stmtPedido->bindParam(':total_pedido', $valorTotalCalculado);
            $stmtPedido->execute();
            $idPedido = $this->db->lastInsertId();
            $sqlItem = "INSERT INTO tbl_itens_pedidos (id_pedido, id_perfil, total_pedido, status_pedido) 
                        VALUES (:id_pedido, :id_perfil, :total_pedido, :status_pedido)";
            $stmtItem = $this->db->prepare($sqlItem);
            foreach ($itensCarrinho as $item) {
                $stmtItem->bindParam(':id_pedido', $idPedido, PDO::PARAM_INT);
                $stmtItem->bindParam(':id_perfil', $item['id'], PDO::PARAM_INT);
                $stmtItem->bindParam(':total_pedido', $item['pedido'], PDO::PARAM_INT);
                $stmtItem->bindParam(':status_pedido', $item['preco']);
                $stmtItem->execute();
            }
            $this->db->commit();

            return (int)$idPedido;
        } catch (\Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

  // Buscar pedido por ID
  function buscarPedidoPorId($id) {
    $sql = "SELECT * FROM tbl_pedidos 
            WHERE id_pedido = :id_pedido AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id_pedido', $id, PDO::PARAM_INT);
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
public function paginacao(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_pedidos`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `tbl_pedidos` LIMIT :limit OFFSET :offset";
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

    function totalDePedidos() {
    $sql = "SELECT COUNT(*) AS total FROM tbl_pedidos";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_COLUMN);
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