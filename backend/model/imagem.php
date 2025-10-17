<?php
namespace App\Koketsu\model;
use PDO;

class Imagem {
    private $id_imagem;
    private $id_produto;
    private $id_cor;
    private $id_tamanho;
    private $caminho_imagem;
    private $descricao_imagem;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Buscar todas as imagens
    public function buscarImagens() {
        $sql = "SELECT * FROM tbl_imagem";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar imagens por produto
    public function buscarPorProduto($id_produto) {
        $sql = "SELECT * FROM tbl_imagem WHERE id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar imagem por ID (Renomeado para consistência)
    public function buscarImagemPorId($id_imagem) {
        $sql = "SELECT * FROM tbl_imagem WHERE id_imagem = :id_imagem";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_imagem', $id_imagem);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Inserir nova imagem
    public function inserirImagem($id_produto, $id_cor, $id_tamanho, $caminho, $descricao) {
        $sql = "INSERT INTO tbl_imagem 
                (id_produto, id_cor, id_tamanho, caminho_imagem, descricao_imagem)
                VALUES (:id_produto, :id_cor, :id_tamanho, :caminho, :descricao)";
        $stmt = $this->db->prepare($sql);
        // Garante que IDs não nulos sejam tratados corretamente, usando NULL se 0 ou vazio for passado
        $stmt->bindValue(':id_produto', $id_produto > 0 ? $id_produto : null, PDO::PARAM_INT);
        $stmt->bindValue(':id_cor', $id_cor > 0 ? $id_cor : null, PDO::PARAM_INT);
        $stmt->bindValue(':id_tamanho', $id_tamanho > 0 ? $id_tamanho : null, PDO::PARAM_INT);
        $stmt->bindParam(':caminho', $caminho);
        $stmt->bindParam(':descricao', $descricao);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Atualizar imagem existente
    public function atualizarImagem($id_imagem, $id_produto, $id_cor, $id_tamanho, $caminho, $descricao) {
        $sql = "UPDATE tbl_imagem 
                SET id_produto = :id_produto,
                    id_cor = :id_cor,
                    id_tamanho = :id_tamanho,
                    caminho_imagem = :caminho,
                    descricao_imagem = :descricao
                WHERE id_imagem = :id_imagem";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_imagem', $id_imagem);
        $stmt->bindValue(':id_produto', $id_produto > 0 ? $id_produto : null, PDO::PARAM_INT);
        $stmt->bindValue(':id_cor', $id_cor > 0 ? $id_cor : null, PDO::PARAM_INT);
        $stmt->bindValue(':id_tamanho', $id_tamanho > 0 ? $id_tamanho : null, PDO::PARAM_INT);
        $stmt->bindParam(':caminho', $caminho);
        $stmt->bindParam(':descricao', $descricao);

        return $stmt->execute();
    }

    // Excluir imagem (remoção física do banco)
    public function excluirImagem($id_imagem) {
        $sql = "DELETE FROM tbl_imagem WHERE id_imagem = :id_imagem";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_imagem', $id_imagem);
        return $stmt->execute();
    }
    
    public function paginacao(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_imagem`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        
        $offset = ($pagina - 1) * $por_pagina;

        $dataQuery = "SELECT * FROM `tbl_imagem` LIMIT :limit OFFSET :offset";
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
}
