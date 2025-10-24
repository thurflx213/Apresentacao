<div class="w3-container">
  <h3>Editando Usuario: <?= htmlspecialchars($usuario['nome_usuario']); ?></h3>
  <form action="/backend/usuario/atualizar" method="post"
   enctype="multipart/form-data" class="w3-container w3-card-4">
   <input type="text" id="id_usuario" name="id_usuario" value="<?php echo $usuario['id_usuario']; ?>" hidden>
   <label for="nome">Nome:</label>
   <input type="text" id="nome_usuario" name="nome_usuario" value="<?php echo $usuario['nome_usuario']; ?>" required>
   <br>
   <label for="email">Email:</label>
   <input type="email" id="email_usuario" name="email_usuario" value="<?php echo $usuario['email_usuario']; ?>" required>
   <br>
   <label for="senha">Senha:</label>
   <input type="password" id="senha_usuario" name="senha_usuario" value="" required>
   <br>
   <label for="tipo">Tipo:</label>
   <select id="nivel_acesso" name="nivel_acesso" value="<?php echo $usuario['nivel_acesso'] ?>" required>
   <option value="vendedor">Vendedor</option>
   <option value="admin" >Admin</option>
   </select><br>
   <label for="imagem">Imagem:</label>
   <input type="file" id="imagem" name="imagem" accept="image/*">
    <p>
        <button type="submit" class="w3-button w3-blue">Salvar Alterações</button>
        <a href="/backend/usuario/listar" class="w3-button w3-grey">Cancelar</a>
        </p>
   </form>
   </div>