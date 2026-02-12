<?php
namespace App\Koketsu\Models;
use PDO;
class Avaliacao {
    private $id_avaliacoes;
    private $id_produto;
    private $id_cliente;
    private $nota_avaliacoes;
    private $comentario_avaliacoes;
    private $data_avaliacao_avaliacoes;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Buscar todas as avaliações (não excluídas) com JOIN para nomes
    public function buscarAvaliacoes() {
        $sql = "SELECT a.*, p.nome_produtos as nome_produto, u.nome_usuarios as nome_cliente 
                FROM tbl_avaliacoes a
                LEFT JOIN tbl_produtos p ON a.id_produto = p.id_produto
                LEFT JOIN tbl_perfil pf ON a.id_cliente = pf.id_perfil
                LEFT JOIN tbl_usuarios u ON pf.id_usuarios = u.id_usuarios
                WHERE a.excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar avaliações de um produto específico
    public function buscarPorProduto($id_produto) {
        $sql = "SELECT a.*, u.nome_usuarios as nome_cliente 
                FROM tbl_avaliacoes a
                LEFT JOIN tbl_usuarios u ON a.id_cliente = u.id_usuarios
                WHERE a.id_produto = :id_produto AND a.excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar avaliações de um cliente específico
    public function buscarPorCliente($id_cliente) {
        $sql = "SELECT a.*, p.nome_produtos as nome_produto, p.imagem_produtos 
                FROM tbl_avaliacoes a
                LEFT JOIN tbl_produtos p ON a.id_produto = p.id_produto
                WHERE a.id_cliente = :id_cliente AND a.excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar avaliações de um usuário específico (independente do perfil)
    public function buscarPorUsuario($id_usuario) {
        $sql = "SELECT DISTINCT a.*, p.nome_produtos as nome_produto, p.imagem_produtos 
                FROM tbl_avaliacoes a
                LEFT JOIN tbl_produtos p ON a.id_produto = p.id_produto
                LEFT JOIN tbl_perfil perf ON a.id_cliente = perf.id_perfil
                WHERE perf.id_usuarios = :id_usuario AND a.excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Inserir nova avaliação
    public function inserirAvaliacao($id_produto, $id_cliente, $nota, $comentario) {
        $sql = "INSERT INTO tbl_avaliacoes 
                (id_produto, id_cliente, nota_avaliacoes, comentario_avaliacoes, data_avaliacao_avaliacoes, criado_em)
                VALUES (:id_produto, :id_cliente, :nota, :comentario, NOW(), NOW())";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_produto', $id_produto);
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':comentario', $comentario);

        if ($stmt->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    // Atualizar avaliação existente
    public function atualizarAvaliacao($id_avaliacoes, $nota, $comentario) {
        $sql = "UPDATE tbl_avaliacoes 
                SET nota_avaliacoes = :nota,
                    comentario_avaliacoes = :comentario,
                    atualizado_em = NOW()
                WHERE id_avaliacoes = :id_avaliacoes AND excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_avaliacoes', $id_avaliacoes);
        $stmt->bindParam(':nota', $nota);
        $stmt->bindParam(':comentario', $comentario);

        return $stmt->execute();
    }

    // Exclusão lógica da avaliação
    public function excluirAvaliacao($id_avaliacoes) {
        $sql = "UPDATE tbl_avaliacoes SET excluido_em = NOW() WHERE id_avaliacoes = :id_avaliacoes";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_avaliacoes', $id_avaliacoes);

        return $stmt->execute();
    }
    // Buscar avaliação por ID
    public function buscarPorId($id) {
        $sql = "SELECT a.*, p.nome_produtos as nome_produto, u.nome_usuarios as nome_cliente 
                FROM tbl_avaliacoes a
                LEFT JOIN tbl_produtos p ON a.id_produto = p.id_produto
                LEFT JOIN tbl_perfil pf ON a.id_cliente = pf.id_perfil
                LEFT JOIN tbl_usuarios u ON pf.id_usuarios = u.id_usuarios
                WHERE a.id_avaliacoes = :id AND a.excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
