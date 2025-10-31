
<div>Sou o create de Produtos</div>
<form action="/backend/produtos/salvar" method="post" enctype="multipart/form-data" class="w3-container w3-card-4">
    <label for="nome_produtos">Nome:</label>
    <input type="text" id="nome_produtos" name="nome_produtos" required>
    <br>

    <label for="descricao_produtos">Descrição:</label>
    <textarea id="descricao_produtos" name="descricao_produtos" required></textarea>
    <br>

    <label for="preco_produtos">Preço:</label>
    <input type="number" step="0.01" id="preco_produtos" name="preco_produtos" required>
    <br>

    <label for="estoque_produtos">Estoque:</label>
    <input type="number" id="estoque_produtos" name="estoque_produtos" required>
    <br>

     <p>
        <label class="w3-text-blue"><b>foto do produto:</b></label>
        <input class="w3-input w3-border" name="imagem_produtos" type="file" required>
      </p>

    <label for="id_categoria">Categoria:</label>
    <input type="number" id="id_categoria" name="id_categoria" required>
    <br>

    <button type="submit" class="w3-button w3-small w3-yellow w3-round-medium">Salvar</button>
</form>
