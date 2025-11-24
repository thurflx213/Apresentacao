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
 public function buscarVendasMensais()
    {
        $sql = "
            SELECT
                DATE_FORMAT(data_pedido, '%Y-%m-01') AS mes,
                SUM(data_pedido) AS total_vendas
            FROM tbl_pedidos
            WHERE data_pedido >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
            AND status_pedido IN ('pago', 'enviado', 'concluido')
            GROUP BY mes
            ORDER BY mes ASC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca a contagem de pedidos para cada status.
     * @return array
     */
    public function contarPedidosPorStatus()
    {
        $sql = "
            SELECT
                status_pedido,
                COUNT(id_pedido) AS contagem
            FROM tbl_pedidos
            WHERE excluido_em IS NULL
            GROUP BY status_pedido
            ORDER BY contagem DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Busca o faturamento (receita) mensal por categoria.
     * @return array
     */
    public function buscarVendasMensaisPorCategoria()
    {
        $sql = "
            SELECT
                DATE_FORMAT(p.data_pedido, '%Y-%m-01') AS mes,
                c.nome_categorias AS categoria,
                SUM(ip.quantidade * ip.preco_unitario) AS faturamento
            FROM tbl_pedidos p
            
            JOIN tbl_itens_pedidos ip ON p.id_pedido = ip.id_pedido
            JOIN tbl_produtos prod ON ip.id_produto = prod.id_produto
            JOIN tbl_categorias c ON prod.id_categoria = c.id_categorias
            
            WHERE p.data_pedido >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
            AND p.status_pedido IN ('pago', 'enviado', 'concluido')
            GROUP BY mes, c.nome_categorias
            ORDER BY mes ASC, faturamento DESC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Calcula o Ticket Médio (Total Vendido / Total de Pedidos) mensalmente.
     * Usa a coluna CORRETA: data_total_pedido
     * @return array
     */
    public function calcularTicketMedioMensal()
    {
        $sql = "
            SELECT
                DATE_FORMAT(data_pedido, '%Y-%m-01') AS mes,
                AVG(data_pedido) AS ticket_medio
            FROM tbl_pedidos
            WHERE data_pedido >= DATE_SUB(NOW(), INTERVAL 12 MONTH)
            AND status_pedido IN ('pago', 'enviado', 'concluido')
            GROUP BY mes
            ORDER BY mes ASC
        ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
  
public function paginacao(int $pagina = 1, int $por_pagina = 50): array{
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
            return $this->db->lastInsertId(); // **CRUCIAL: Retorna o ID do pedido**
        } else {
            return false;
        }
    }

  // Atualizar pedido existente
public function atualizarPedido($id_pedido, $total_pedido, $data_pedido, $status_pedido, $imagem = null) {
    $dataatual = date('Y-m-d H:i:s');
    
    // 1. Monta a base da query. SEM a vírgula final
    $sql = "UPDATE tbl_pedidos SET 
            total_pedido = :total_pedido,
            data_pedido = :data_pedido,
            status_pedido = :status_pedido,
            atualizado_em = :atualizado_em";

    // 2. Adiciona o campo 'imagem_pedidos' APENAS SE A IMAGEM EXISTE (NÃO VAZIA)
    if (!empty($imagem)) { 
        // Note o ", " no início. Ele é adicionado APENAS se houver uma imagem.
        $sql .= ", imagem_pedidos = :imagem"; 
    }

    // 3. Adiciona a cláusula WHERE
    $sql .= " WHERE id_pedido = :id";
    
    $stmt = $this->db->prepare($sql);
    
    // Bind Params (Todos os campos obrigatórios)
    $stmt->bindParam(':total_pedido', $total_pedido);
    $stmt->bindParam(':data_pedido', $data_pedido); 
    $stmt->bindParam(':status_pedido', $status_pedido);
    $stmt->bindParam(':atualizado_em', $dataatual);
    $stmt->bindParam(':id', $id_pedido);
    
    // Bind Param (Condicional - Apenas se houver imagem)
    if (!empty($imagem)) {
        $stmt->bindParam(':imagem', $imagem);
    }
    
    if ($stmt->execute()) {
        return true;
    } else {
        // Retorna o erro real do PDO, o que pode ajudar a depurar melhor no futuro
        error_log("Erro no SQL ao atualizar pedido: " . json_encode($stmt->errorInfo()));
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