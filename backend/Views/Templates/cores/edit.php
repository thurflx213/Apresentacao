<div>Sou o edit</div>
<form action="/backend/cor/atualizar/<?php echo $cor['id_cores']; ?>" method="post" 
   enctype="multipart/form-data">
    <label for="id_produto">ID do Produto:</label>
    <input type="number" id="id_produto" name="id_produto" required>
    <br>

    <label for="cor_cores">Cor:</label>
    <input type="text" id="cor_cores" name="cor_cores" required>
    <br>

    <label for="quantidade_cores">Quantidade:</label>
    <input type="number" id="quantidade_cores" name="quantidade_cores" required>
    <br>

    <button type="submit">Salvar</button>
</form>