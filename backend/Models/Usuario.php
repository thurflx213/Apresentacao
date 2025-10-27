<?php
namespace App\Koketsu\Models;
use PDO;

class Usuario {
  private $id_usuario;
  private $nome_usuario;
  private $email_usuario;
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

  // Buscar todos os usuários
  function buscarUsuarios(){
    $sql = "SELECT * FROM tbl_usuario WHERE excluido_em IS NULL";
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

  public function paginacao(int $pagina = 1, int $porPagina = 50){
        $offset = ($pagina - 1) * $porPagina;
        $sql = "SELECT id_usuario, email_usuario, tipo_usuario, excluido_em FROM tbl_usuario 
                LIMIT :offset, :porPagina";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':porPagina', $porPagina, PDO::PARAM_INT);
        $stmt->execute();
        $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $totalStmt = $this->db->query("SELECT COUNT(*) FROM tbl_usuario");
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

  function buscarUsuariosInativos($email){
   $sql = "SELECT COUNT(*) AS total_inativos FROM tbl_usuario WHERE excluido_em IS NOT NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_COLUMN);
}

  // Buscar usuários por email
  function buscarUsuariosPorEmail($email){
    $sql = "SELECT * FROM tbl_usuario WHERE email_usuario = :email AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $resultado;
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

  // Inserir novo usuário
  function inserirUsuario($nome, 
  $email, 
  $senha, 
  $nivel,
  $foto,){
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tbl_usuario 
(, email_usuario, senha_usuario, tipo_usuario, foto_usuario)
VALUES (:nome, :email, :senha, :nivel, :foto)";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':nivel', $nivel);
    $stmt->bindParam(':foto', $foto);

    if($stmt->execute()){
        return $this->db->lastInsertId();
    } else {
        return false;
    }
  }

  public function buscarPorID($id){
        $sql = "SELECT * FROM tbl_usuario WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

  function atualizarUsuario($id, $nome, $email, $senha, $nivel){
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_usuario SET 
               = :nome,
              email_usuario = :email,
              senha_usuario = :senha,
              tipo_usuario = :nivel,
              atualizado_em = :atual
            WHERE id_usuario = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':nivel', $nivel);
    $stmt->bindParam(':atual', $dataatual);

    if($stmt->execute()) {
      return true;
    } else {
      return false;
    }
  }

  // Excluir usuário (soft delete)
  function deletarUsuario(int $id){
        $agora = date("Y-m-d h:m:s");
        $coluna = $this->buscarPorID($id);
        //ternario
        $coluna = $coluna['excluido_em'] != NULL ? NULL : $agora;
       
        $sql = "UPDATE tbl_usuario SET excluido_em = :excluido_em WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':excluido_em', $coluna);
        return $stmt->execute();
    }

    public function checarCredenciais(string $email,string $senha) {
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