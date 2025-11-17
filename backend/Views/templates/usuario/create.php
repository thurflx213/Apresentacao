<div class="w3-container"></div>
 <h3>Novo usuario</h3>
<form action="/backend/usuario/salvar" method="post" enctype="multipart/form-data" class="w3-container w3-card-4">
    <label for="nome_usuarios">Nome:</label>
    <input type="text" id="nome_usuarios" name="nome_usuarios" required>
    <br>

    <label for="email_usuarios">Email:</label>
    <input type="email" id="email_usuarios" name="email_usuarios" required>
    <br>

    <label for="senha_usuarios">Senha:</label>
    <input type="password" id="senha_usuarios" name="senha_usuarios" required>
    <br>

    <label for="nivel_acesso">Tipo:</label>
    <select id="nivel_acesso" name="nivel_acesso" required>
        <option value="Vendedor">Vendedor</option>
        <option value="Admin">Admin</option>
    </select><br>

    <label for="imagem">Imagem:</label>
   <input type="file" id="imagem" name="imagem" accept="image/*">
   </form>

   <p>
        <button class="w3-button w3-blue">Salvar usuario</button>
    </p>

</form>
</div>