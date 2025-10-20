<div>Cadastro de Itens do Pedido</div>
<form action="/backend/itenspedidos/salvar" method="post">
    <label for="id_pedido">ID do Pedido:</label>
    <input type="number" id="id_pedido" name="id_pedido" required>
    <br>

    <label for="id_produto">ID do Produto:</label>
    <input type="number" id="id_produto" name="id_produto" required>
    <br>

    <label for="quantidade">Quantidade:</label>
    <input type="number" id="quantidade" name="quantidade" required>
    <br>

    <label for="preco_unitario">Preço Unitário (R$):</label>
    <input type="number" step="0.01" id="preco_unitario" name="preco_unitario" required>
    <br>

    <button type="submit">Salvar Item</button>
</form>
