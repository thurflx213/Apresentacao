<?php
namespace App\Koketsu\Models;

use PDO;

class Perfil {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Retorna todos os perfis
     * @return array
     */
    public function buscarPerfis(): array {
        $sql = "SELECT * FROM tbl_perfil";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna perfis ativos (excluido_em IS NULL)
     * Aceita paginação opcional: se $pagina for inteiro, aplica LIMIT/OFFSET
     * @param int|null $pagina
     * @param int $porPagina
     * @return array
     */
    public function buscarPerfisAtivos(?int $pagina = null, int $porPagina = 10): array {
        if ($pagina === null) {
            $sql = "SELECT * FROM tbl_perfil WHERE excluido_em IS NULL";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        $offset = max(0, ($pagina - 1) * $porPagina);
        $sql = "SELECT * FROM tbl_perfil WHERE excluido_em IS NULL LIMIT :limit OFFSET :offset";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $porPagina, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna o total de perfis (ativos)
     * @return int
     */
    public function totalDePerfisAtivos(): int {
        $sql = "SELECT COUNT(*) FROM tbl_perfil WHERE excluido_em IS NULL";
        $stmt = $this->db->query($sql);
        return (int) $stmt->fetchColumn();
    }

    public function totalDePerfis(): int {
        $sql = "SELECT COUNT(*) FROM tbl_perfil";
        $stmt = $this->db->query($sql);
        return (int) $stmt->fetchColumn();
    }
    public function buscarPerfisInativos(): array {
        $sql = "SELECT * FROM tbl_perfil WHERE excluido_em IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPerfisPorId(int $id_perfil): array {
        $sql = "SELECT * FROM tbl_perfil WHERE id_perfil = :id_perfil";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_perfil', $id_perfil, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result : [];
    }

    /**
     * Insere um perfil a partir de um array associativo (coluna => valor)
     * Retorna o id inserido (int) ou 0 em falha.
     */
    public function inserirPerfil(array $dados): int {
        if (empty($dados)) {
            return 0;
        }
        $columns = array_keys($dados);
        $placeholders = array_map(fn($c) => ':' . $c, $columns);
        $sql = 'INSERT INTO tbl_perfil (' . implode(', ', $columns) . ') VALUES (' . implode(', ', $placeholders) . ')';
        $stmt = $this->db->prepare($sql);
        foreach ($dados as $col => $val) {
            $stmt->bindValue(':' . $col, $val);
        }
        if ($stmt->execute()) {
            return (int) $this->db->lastInsertId();
        }
        return 0;
    }

}