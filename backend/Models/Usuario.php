<?php
namespace App\Koketsu\Models;
use PDO;

class Usuario {
  private $id_usuarios;
  private $nome_usuarios;
  private $email_usuarios;
  private $senha_usuarios;
  private $nivel_acesso;
  private $criado_em;
  private $atualizado_em;
  private $excluido_em;
  private $db;

  public function __construct($db) {
    $this->db = $db;
  }

  // Buscar todos os usuários
  function buscarUsuarios(){
    $sql = "SELECT * FROM tbl_usuarios WHERE excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Buscar usuários por email
  function buscarUsuariosPorEmail($email){
    $sql = "SELECT * FROM tbl_usuarios WHERE email_usuarios = :email AND excluido_em IS NULL";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Inserir novo usuário
  function inserirUsuario($nome, $email, $senha, $nivel){
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $sql = "INSERT INTO tbl_usuarios (nome_usuarios, email_usuarios, senha_usuarios, nivel_acesso)
            VALUES (:nome, :email, :senha, :nivel)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':nivel', $nivel);

    if($stmt->execute()){
        return $this->db->lastInsertId();
    } else {
        return false;
    }
  }

  // Atualizar usuário
  function atualizarUsuario($id, $nome, $email, $senha, $nivel){
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_usuarios SET 
              nome_usuarios = :nome,
              email_usuarios = :email,
              senha_usuarios = :senha,
              nivel_acesso = :nivel,
              atualizado_em = :atual
            WHERE id_usuarios = :id";
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
  function excluirUsuario($id){
    $dataatual = date('Y-m-d H:i:s');
    $sql = "UPDATE tbl_usuarios SET excluido_em = :atual WHERE id_usuarios = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':atual', $dataatual);

    return $stmt->execute();
  }
}