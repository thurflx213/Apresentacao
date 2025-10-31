<div class="w3-container">
 <h3 class= "w3-text-yellow">Editando Produto: <?= htmlspecialchars($produtos['nome_produtos']); ?></h3>
<form action="/backend/produtos/atualizar" method="post"
enctype="multipart/form-data" class="w3-container w3-card-4">
 <input type="text" id="id_produto" name="id_produto" value="<?php echo $produtos['id_produto']; ?>" hidden>

 <label for="nome_produtos">Nome:</label>
    <input type="text" id="nome_produtos" value ="<?php echo $produtos['nome_produtos']; ?>" name="nome_produtos" required>
    <br>

    <label for="descricao_produtos">Descrição:</label>
    <textarea id="descricao_produtos"   name="descricao_produtos" required> <?php echo $produtos['descricao_produtos']; ?>" </textarea>
    <br>

    <label for="preco_produtos">Preço:</label>
    <input type="number" step="0.01" id="preco_produtos" value="<?php echo $produtos['preco_produtos']; ?>"  name="preco_produtos" required>
    <br>

    <label for="estoque_produtos">Estoque:</label>
    <input type="number" id="estoque_produtos" value="<?php echo $produtos['estoque_produtos']; ?>" name="estoque_produtos" required>
    <br>

    <p>
        <label class="w3-text-yellow"><b>Substituir Foto</b></label>
        <input class="w3-input w3-border" name="imagem_produtos" type="file">
        <small>Deixe em branco para manter a foto atual.</small>
        </p>

        <label for="id_categoria">Categoria:</label>
    <input type="number" id="id_categoria" name="id_categoria" required>
    <br>

   <p>
        <button type="submit" class="w3-button w3-yellow">Salvar Alterações</button>
        <a href="/backend/produtos/listar" class="w3-button w3-grey">Cancelar</a>
        </p>
</form>
</div>
