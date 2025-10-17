<div>
    <h1>Criar Carrinho</h1>
    <form action="/backend/carrinho/criar" method="POST">
        <div>
            <label for="id_cliente">Cliente:</label>
            <select name="id_cliente" id="id_cliente" required>
                <option value="">Selecione um cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id_cliente'] ?>"><?= $cliente['nome_cliente'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="total_carrinho">Total:</label>
            <input type="number" name="total_carrinho" id="total_carrinho" step="0.01" required>
        </div>
        <div>
            <label for="status_carrinho">Status:</label>
            <select name="status_carrinho" id="status_carrinho" required>
                <option value="Aberto">Aberto</option>
                <option value="Fechado">Fechado</option>
            </select>
            
        </div>
        <div class="mb-3">
        <label class="w3-text-blue">Produtos</label>
        <div id="produtos-container"></div>
    <button type="button" onclick="addProduto()" class="w3-button w3-teal">Adicionar Produto</button>
</div>
        <button type="submit">Criar Carrinho</button>
    </form>
</div>

<script>
let produtoCount = 0;
function addProduto() {
        produtoCount++;
        const produtoDiv = document.createElement('div');
        produtoDiv.setAttribute('id', `produto-${produtoCount}`);
        produtoDiv.classList.add('mb-3');
        produtoDiv.innerHTML = `
            <p>produto ${produtoCount} <button type="button" onclick="removeproduto(${produtoCount})" class="w3-button w3-red">Remover produto</button></p>
            <div id="carrinho-container-${produtoCount}">
                <div class="mb-3">
                    <label class="w3-text-blue">Produto</label>
                    <input type="text" name="carrinho[${produtoCount}][]" placeholder="Nome do produto ${produtoCount}" class="w3-input w3-border" required>
                </div>
                <div class="mb-3">
                    <label class="w3-text-blue">Quantidade</label>
                    <input type="text" name="quantidade" placeholder="Quantidade do produto ${produtoCount}" class="w3-input w3-border" required>
                </div>
            </div>
        `;
        document.getElementById('produtos-container').appendChild(produtoDiv);
    }
    function removeproduto(semestreId) {
        const semestreDiv = document.getElementById(`produto-${semestreId}`);
        semestreDiv.remove();
    }
</script>

