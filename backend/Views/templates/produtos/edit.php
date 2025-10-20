
<div>Sou o edit de Produtos</div>
<form action="/backend/produto/atualizar/<?php echo $produto['id_produtos']; ?>" method="post">
    <label for="nome_produtos">Nome:</label>
    <input type="text" id="nome_produtos" value ="<?php echo $produtos['nome_produtos']; ?>" name="nome_produtos" required>
    <br>

    <label for="descricao_produtos">Descrição:</label>
    <textarea id="descricao_produtos"   name="descricao_produtos" required7> <?php echo $produtos['descricao_produtos']; ?>" </textarea>
    <br>

    <label for="preco_produtos">Preço:</label>
    <input type="number" step="0.01" id="preco_produtos" value="<?php echo $produtos['preco_produtos']; ?>"  name="preco_produtos" required>
    <br>

    <label for="estoque_produtos">Estoque:</label>
    <input type="number" id="estoque_produtos" value="<?php echo $produtos['estoque_produtos']; ?>" name="estoque_produtos" required>
    <br>

    <label for="imagem_produtos">Imagem (URL):</label>
    <input type="text" id="imagem_produtos" name="imagem_produtos" accept="image/º">
    <br>

    <label for="id_categoria">Categoria:</label>
    <input type="number" id="id_categoria" value="<?php echo $produtos['id_categoria']; ?>"  name="id_categoria" required>
    <br>

    <button type="submit">Salvar</button>
</form>
