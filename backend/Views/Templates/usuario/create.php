<div>Sou o create</div>
<form action="/backend/usuario/salvar" method="post">
    <label for="nome_usuario">Nome:</label>
    <input type="text" id="nome_usuario" name="nome_usuario" required>
    <br>

    <label for="email_usuario">Email:</label>
    <input type="email" id="email_usuario" name="email_usuario" required>
    <br>

    <label for="senha_usuario">Senha:</label>
    <input type="password" id="senha_usuario" name="senha_usuario" required>
    <br>

    <label for="nivel_acesso">Tipo:</label>
    <select id="nivel_acesso" name="nivel_acesso" required>
        <option value="Vendedor">Vendedor</option>
        <option value="Admin">Admin</option>
    </select><br>

    <label for="imagem">Imagem:</label>
   <input type="file" id="imagem" name="imagem" accept="image/*">
   <button type="submit">Salvar</button>
   </form>

   <button type="submit">Salvar</button>

</form>