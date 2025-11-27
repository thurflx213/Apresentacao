<?php
namespace App\Koketsu\Models;
use PDO;

class Carrinho {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // --- MÉTODOS DE ITENS DO CARRINHO (LOJA) ---

    /**
     * Adiciona item ou atualiza quantidade se já existir
     */
    public function adicionarItem(int $id_carrinho, int $id_produto, int $quantidade): bool {
        // 1. Pega o preço atual do produto
        $sqlPreco = "SELECT preco_produtos FROM tbl_produtos WHERE id_produto = :id_produto";
        $stmtPreco = $this->db->prepare($sqlPreco);
        $stmtPreco->execute([':id_produto' => $id_produto]);
        $produto = $stmtPreco->fetch(PDO::FETCH_ASSOC);

        if (!$produto) return false; // Produto não existe

        $preco = $produto['preco_produtos'];

        // 2. Verifica se item já existe no carrinho
        $sqlCheck = "SELECT id_item, quantidade FROM tbl_itens_carrinho 
                     WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
        $stmtCheck = $this->db->prepare($sqlCheck);
        $stmtCheck->execute([':id_carrinho' => $id_carrinho, ':id_produto' => $id_produto]);
        $itemExistente = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($itemExistente) {
            // Atualiza quantidade
            $novaQtd = $itemExistente['quantidade'] + $quantidade;
            $sql = "UPDATE tbl_itens_carrinho SET quantidade = :qtd WHERE id_item = :id_item";
            $stmt = $this->db->prepare($sql);
            $sucesso = $stmt->execute([':qtd' => $novaQtd, ':id_item' => $itemExistente['id_item']]);
        } else {
            // Insere novo item
            $sql = "INSERT INTO tbl_itens_carrinho (id_carrinho, id_produto, quantidade, preco_unitario) 
                    VALUES (:id_carrinho, :id_produto, :qtd, :preco)";
            $stmt = $this->db->prepare($sql);
            $sucesso = $stmt->execute([
                ':id_carrinho' => $id_carrinho, 
                ':id_produto' => $id_produto, 
                ':qtd' => $quantidade, 
                ':preco' => $preco
            ]);
        }

        // 3. Atualiza o valor total do carrinho pai
        if ($sucesso) {
            $this->recalcularTotalCarrinho($id_carrinho);
        }
        return $sucesso;
    }

    /**
     * Busca os itens para exibir na tela do carrinho
     */
    public function buscarItensCarrinho(int $id_carrinho) {
        $sql = "SELECT i.*, p.nome_produtos, p.imagem_produtos, (i.quantidade * i.preco_unitario) as subtotal
                FROM tbl_itens_carrinho i
                JOIN tbl_produtos p ON i.id_produto = p.id_produto
                WHERE i.id_carrinho = :id_carrinho";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id_carrinho' => $id_carrinho]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Remove item e recalcula total
     */
    public function removerItem(int $id_item, int $id_carrinho): bool {
        $sql = "DELETE FROM tbl_itens_carrinho WHERE id_item = :id_item AND id_carrinho = :id_carrinho";
        $stmt = $this->db->prepare($sql);
        if ($stmt->execute([':id_item' => $id_item, ':id_carrinho' => $id_carrinho])) {
            $this->recalcularTotalCarrinho($id_carrinho);
            return true;
        }
        return false;
    }

    /**
     * Função auxiliar para somar tudo e atualizar a tbl_carrinho
     */
    private function recalcularTotalCarrinho(int $id_carrinho) {
        // Soma itens
        $sqlSoma = "SELECT SUM(quantidade * preco_unitario) FROM tbl_itens_carrinho WHERE id_carrinho = :id";
        $stmtSoma = $this->db->prepare($sqlSoma);
        $stmtSoma->execute([':id' => $id_carrinho]);
        $total = $stmtSoma->fetchColumn() ?: 0.00;

        // Atualiza cabeçalho
        $sqlUpd = "UPDATE tbl_carrinho SET total_carrinho = :total, atualizado_em = NOW() WHERE id_carrinho = :id";
        $stmtUpd = $this->db->prepare($sqlUpd);
        $stmtUpd->execute([':total' => $total, ':id' => $id_carrinho]);
    }

    // --- MÉTODOS DE GESTÃO DO CARRINHO (ADMIN / GERAL) ---

    public function inserirCarrinho(int $id_cliente, float $total_carrinho, string $status_carrinho = 'Aberto'): int|false {
        $sql = "INSERT INTO tbl_carrinho 
                (id_cliente, total_carrinho, status_carrinho, data_pedido_carrinho, criado_em)
                VALUES (:id_cliente, :total, :status, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total_carrinho);
        $stmt->bindParam(':status', $status_carrinho);

        if ($stmt->execute()) {
            return (int) $this->db->lastInsertId();
        }
        return false;
    }

    public function buscarCarrinhoPorId($id_carrinho) {
        $sql = "SELECT * FROM tbl_carrinho WHERE id_carrinho = :id_carrinho AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarCarrinhos() {
        $sql = "SELECT * FROM tbl_carrinho WHERE excluido_em IS NULL ORDER BY data_pedido_carrinho DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    // Paginação e Admin
    public function totalDeCarrinhos(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM tbl_carrinho WHERE excluido_em IS NULL");
        return (int) $stmt->fetchColumn();
    }
    
    public function buscarCarrinhosAtivos(): int { return $this->totalDeCarrinhos(); }
    
    public function buscarCarrinhosInativos(): int {
        $stmt = $this->db->query("SELECT COUNT(*) FROM tbl_carrinho WHERE excluido_em IS NOT NULL");
        return (int) $stmt->fetchColumn();
    }

    public function paginacao(int $pagina = 1, int $por_pagina = 10): array {
        $total = $this->totalDeCarrinhos();
        $offset = ($pagina - 1) * $por_pagina;
        
        $sql = "SELECT * FROM tbl_carrinho WHERE excluido_em IS NULL ORDER BY data_pedido_carrinho DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $por_pagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return [
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $total,
            'por_pagina' => $por_pagina,
            'pagina_atual' => $pagina,
            'ultima_pagina' => ceil($total / $por_pagina)
        ];
    }

    public function atualizarCarrinho(int $id_carrinho, ?float $total_carrinho = null, ?string $status_carrinho = null): bool {
        $campos = ["atualizado_em = NOW()"];
        if ($total_carrinho !== null) $campos[] = "total_carrinho = :total";
        if ($status_carrinho !== null) $campos[] = "status_carrinho = :status";
        
        $sql = "UPDATE tbl_carrinho SET " . implode(', ', $campos) . " WHERE id_carrinho = :id_carrinho";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
        if ($total_carrinho !== null) $stmt->bindValue(':total', $total_carrinho);
        if ($status_carrinho !== null) $stmt->bindValue(':status', $status_carrinho);

        return $stmt->execute();
    }

    public function deletarCarrinho(int $id_carrinho): bool {
        $stmt = $this->db->prepare("UPDATE tbl_carrinho SET excluido_em = NOW() WHERE id_carrinho = :id");
        return $stmt->execute([':id' => $id_carrinho]);
    }
}