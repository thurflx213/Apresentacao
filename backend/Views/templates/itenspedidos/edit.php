<div>Sou o edit</div>
<form action="/backend/itenspedidos/atualizar/<?php echo $itenspedidos['id_itens_pedidos']; ?>" method="post">
    <label for="id_itens_pedidos">ID do Pedido:</label>
    <input type="number" id="id_itens_pedidos" value="<?php echo $itenspedidos['id_itens_pedidos']; ?>" name="id_itens_pedidos" required>
    <br>

    <label for="id_produto">ID do Produto:</label>
    <input type="number" id="id_produto" value="<?php echo $itenspedidos['id_produto']; ?>" name="id_produto" required>
    <br>

    <label for="quantidade">Quantidade:</label>
    <input type="number" id="quantidade" value="<?php echo $itenspedidos['quantidade']; ?>" name="quantidade" required>
    <br>

    <label for="preco_unitario">Preço Unitário (R$):</label>
    <input type="number" step="0.01" id="preco_unitario" value="<?php echo $itenspedidos['preco_unitario']; ?>" name="preco_unitario" required>
    <br>

    <button type="submit">Salvar Item</button>
</form>
