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

    <label for="tipo_usuario">Tipo:</label>
    <select id="tipo_usuario" name="tipo_usuario" required>
        <option value="user">Usuario</option>
        <option value="admin">Administrador</option>
    </select><br>

   <button type="submit">Salvar</button>

</form>