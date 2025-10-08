<form action="/backend/usuario/atualizar/<?php echo $usuario['id_usuarios']; ?>" method="post" 
   enctype="multipart/form-data">
   <label for="nome">Nome:</label>
   <input type="text" id="nome_usuarios" name="nome_usuarios" value="<?php echo $usuario['nome_usuarios']; ?>" required>
   <br>
   <label for="email">Email:</label>
   <input type="email" id="email_usuarios" name="email_usuarios" value="<?php echo $usuario['email_usuarios']; ?>" required>
   <br>
   <label for="senha">Senha:</label>
   <input type="password" id="senha_usuarios" name="senha_usuarios" value="" required>
   <br>
   <label for="tipo">Tipo:</label>
   <select id="nivel_acesso" name="nivel_acesso" value="<?php echo $usuario['nivel_acesso'] ?>" required>
   <option value="user">Usuario</option>
   <option value="admin" >Administrador</option>
   </select><br>
   <label for="imagem">Imagem:</label>
   <input type="file" id="imagem" name="imagem" accept="image/*">
   <button type="submit">Salvar</button>
   </form>