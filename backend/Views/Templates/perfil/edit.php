<div>Sou o create</div>
<form action="/backend/perfil/salvar/<?php echo $perfil['id_perfil']; ?>" method="post"
    enctype="multipart/form-data">
    <label for="telefone">Telefone:</label>
    <input type="tel" id="telefone_perfil" name="telefone_perfil" value="<?php echo $perfil['telefone_perfil']; ?>" required>
    <br>

    <label for="endereco">Endereço:</label>
     <input type="text" id="endereco_perfil" name="endereco_perfil" value="<?php echo $perfil['endereco_perfil'];?>" required> 
    <br>

    <label for="data">Data de Cadastro:</label>
    <input type="date" id="data_cadastro" name="data_cadastro" value="<?php echo $perfil['data_cadastro']; ?>" required>
    <br>

    <button type="submit">Salvar</button>
</form>