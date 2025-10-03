<div class="container-form-tamanhos">
    <form action="/backend/tamanhos/salvar" method="post"> 
        <h3>Cadastrar Novo Tamanho</h3>
        
        <label for="id_produto">ID do Produto:</label>
        <input type="number" id="id_produto" name="id_produto" required min="1">
        <br>

        <label for="tamanho_tamanhos">Tamanho:</label>
        <input type="text" id="tamanho_tamanhos" name="tamanho_tamanhos" required maxlength="10">
        <br>

        <label for="quantidade_tamanho">Quantidade em Estoque:</label>
        <input type="number" id="quantidade_tamanho" name="quantidade_tamanho" required min="0">
        <br>

        <button type="submit">Salvar Tamanho</button>
    </form>
</div>