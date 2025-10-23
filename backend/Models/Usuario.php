<?php

namespace App\Koketsu\Models;
use PDO;

class Usuario{
  private $id_usuario;
  private $nome_usuario;
  private $email_usuario ;
  private $senha_usuario;
  private $tipo_usuario;
  private $foto_usuario;
  private $criado_em;
  private $atualizado_em;
  private $excluido_em;
  private $db;

  public function __construct($db) {
    $this->db = $db;
   }
   //Metodo de buscar todos os usuarios
   function buscarUsuarios(){
   $sql = "SELECT * FROM tbl_usuario where excluido_em IS NULL";
   $stmt = $this->db->prepare($sql);
   $stmt->execute();
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

public function paginacao(int $pagina = 1, int $por_pagina = 10): array{
        $totalQuery = "SELECT COUNT(*) FROM `tbl_usuario`";
        $totalStmt = $this->db->query($totalQuery);
        $total_de_registros = $totalStmt->fetchColumn();
        $offset = ($pagina - 1) * $por_pagina;
        $dataQuery = "SELECT * FROM `tbl_usuario` LIMIT :limit OFFSET :offset";
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

function buscarUsuariosInativos() {
    $sql = "SELECT COUNT(*) AS total_inativos FROM tbl_usuario WHERE excluido_em IS NOT NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_COLUMN);
}


   //Metodo de buscar todos usuarios por email
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
   return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

   //Metodo de inserir usuario
   function inserirUsuario($nome, 
   $email, 
   $senha, 
   $tipo, 
   $imagem
   ){
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tbl_usuario (nome_usuario, email_usuario,
    senha_usuario, tipo_usuario, foto_usuario)
        VALUES (:nome, :email, :senha, :tipo, :imagem)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':imagem', $imagem);
    if($stmt->execute()){
        return $this->db->lastInsertId();
    }else{
        return false;
    }

   }

   //Metodo de atualizar usuario
  function atualizarUsuario($id, $nome, $email, $senha, $tipo, $status){
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_usuario SET nome_usuario = :nome, 
    email_usuario = :email,
    senha_usuario = :senha, 
    tipo_usuario = :tipo, 
    status_usuario = :status
    atualizado_em = :atual
    WHERE id_usuario = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':atual', $dataatual);
    if($stmt->execute()){
        return $this->db->lastInsertId();
    }else{
        return false;
    }

   }

    //Metodo de excluir usuario
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

  public function checarCredenciais(string $email, string $senha){
    $usuario = $this->buscarUsuariosPorEmail($email);
    if (count($usuario) !== 1){
        return false;
    }
    $usuario = $usuario[0];
    if (password_verify($senha, $usuario['senha_usuario'])){
        return $usuario;
    }
    return false;
  }
}