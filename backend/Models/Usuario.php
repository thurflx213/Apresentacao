<?php

namespace App\Koketsu\Models;
use PDO;

class Usuario{
    private $id_usuario;
    private $nome_usuario;
    private $email_usuario ;
    private $senha_usuario;
    private $tipo_usuario;
    private $criado_em;
    private $atualizado_em;
    private $excluido_em;
    private $db;


    public function __construct($db) {
        $this->db = $db;
    }

    // Metodo de buscar todos os usuarios
     function buscarUsuarios(){
        $sql = "SELECT * FROM tbl_usuario where excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Metodo de buscar usuario por email (CORRIGIDO: usa fetch() ao invés de fetchAll())
     function buscarUsuariosPorEmail($email){
   $sql = "SELECT * FROM tbl_usuario where email_usuario = :email and excluido_em IS NULL";
   $stmt = $this->db->prepare($sql);
   $stmt->bindParam(':email', $email);
   $stmt->execute();
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarUsuariosPorId($id){
         $sql = "SELECT * FROM tbl_usuario where id_usuario = :id_usuario and excluido_em IS NULL";
   $stmt = $this->db->prepare($sql);
   $stmt->bindParam(':id_usuario', $id);
   $stmt->execute();
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function buscarUsuariosPorEmailInativos($email){
        $sql = "SELECT * FROM tbl_usuario where email_usuario = :email and excluido_em IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function totalDeUsuarios() {
        $sql = "SELECT COUNT(*) AS total FROM tbl_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    function buscarUsuariosAtivos() {
        $sql = "SELECT COUNT(*) AS total_ativos FROM tbl_usuario WHERE excluido_em IS NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    function buscarUsuariosInativos() {
        $sql = "SELECT COUNT(*) AS total_inativos FROM tbl_usuario WHERE excluido_em IS NOT NULL";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }
    
   
      public function paginacao(int $pagina = 1, int $por_pagina = 10): array{
        // 1. CONTAGEM TOTAL DE USUÁRIOS ATIVOS
        $totalQuery = "SELECT COUNT(*) FROM `tbl_usuario` WHERE excluido_em IS NULL";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt ? (int) $totalStmt->fetchColumn() : 0;
        $offset = ($pagina - 1) * $por_pagina;
        $lastPage = $por_pagina > 0 ? ceil($total_de_registros / $por_pagina) : 1;
        if ($offset < 0) {
            $offset = 0;
        }

        $dataQuery = "SELECT * FROM `tbl_usuario` 
                      WHERE excluido_em IS NULL 
                      ORDER BY nome_usuario ASC 
                      LIMIT {$por_pagina} OFFSET {$offset}";    
        $dataStmt = $this->db->query($dataQuery);
        if ($dataStmt === false) {
             // Caso a query falhe, registramos o erro no log do servidor
             error_log("ERRO FATAL NA PAGINAÇÃO: " . print_r($this->db->errorInfo(), true));
             error_log("SQL da Paginação que Falhou: " . $dataQuery);

             return [
                 'data' => [],
                 'total' => 0,
                 'por_pagina' => (int) $por_pagina,
                 'pagina_atual' => (int) $pagina,
                 'ultima_pagina' => 1,
                 'de' => 0,
                 'para' => 0
             ];
        }

        $dados = $dataStmt->fetchAll(PDO::FETCH_ASSOC); 
        
        $countDados = count($dados);
    
        // 4. ESTRUTURA DE RETORNO
        return [
            'data' => $dados,
            'total' => $total_de_registros,
            'por_pagina' => (int) $por_pagina,
            'pagina_atual' => (int) $pagina,
            'ultima_pagina' => (int) $lastPage,
            'de' => $offset + 1,
            'para' => $offset + $countDados
        ];
    }
    // Metodo de inserir usuario
   function inserirUsuario($nome, 
    $email, 
    $senha, 
    $tipo, 
    // O parâmetro $imagem agora é opcional/ignorado, ou pode ser removido
    $imagem = null 
    ){
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    
    // CORREÇÃO: Removido 'foto_usuario' da lista de colunas
    $sql = "INSERT INTO tbl_usuario (nome_usuario, email_usuario,
    senha_usuario, tipo_usuario)
    VALUES (:nome, :email, :senha, :tipo)";
    
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':tipo', $tipo);
    // REMOVIDO: $stmt->bindParam(':imagem', $imagem); 
    
    if($stmt->execute()){
        return $this->db->lastInsertId();
    }else{
        return false;
    }
}

    // Metodo de atualizar usuario (CORRIGIDO: Adicionado vírgula e removido status_usuario)
    function atualizarUsuario($id, $nome, $email, $senha, $tipo){
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_usuario SET nome_usuario = :nome, 
            email_usuario = :email,
            senha_usuario = :senha, 
            tipo_usuario = :tipo, 
            atualizado_em = :atual
            WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':tipo', $tipo);
        // $stmt->bindParam(':status', $status); // REMOVIDO: Coluna status_usuario não existe
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true; // Retorna true em UPDATE, lastInsertId() é para INSERT
        }else{
            return false;
        }
    }

    // Metodo de exclusão (Soft Delete)
    function excluirUsuario($id){
        $dataatual = date('Y-m-d H:i:s');
        $sql = "UPDATE tbl_usuario SET 
            excluido_em = :atual
            WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    // Metodo de reativação (Remove o Soft Delete)
    function ativarUsuario($id){
        $dataatual = NULL;
        $sql = "UPDATE tbl_usuario SET 
            excluido_em = :atual
            WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':atual', $dataatual);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function checarCredenciais(string $email, string $senha)
{
    // 1. Busca o usuário. Assume-se que esta função retorna um array associativo ou false.
    $usuario = $this->buscarUsuariosPorEmail($email);
    // Se a busca retornar false (usuário não encontrado ou inativo)
    if (!$usuario) {
        return false;
    }
    
    if (isset($usuario['senha_usuario']) && password_verify($senha, $usuario['senha_usuario'])){
        return $usuario; // Retorna o array do usuário
    }
    return false;
}
}