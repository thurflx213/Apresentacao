<header class="w3-container" style="padding-top:22px">
  <h5><b><i class="fa fa-plus-circle"></i> Cadastrar Novo Item de Pedido</b></h5>
</header>

<div class="w3-container w3-margin-bottom" style="max-width: 600px; margin: auto;">
    
    <div class="w3-card-4 w3-black w3-padding-large w3-margin-top w3-text-white" style="border-radius: 8px;">
        <h3 class="w3-border-bottom w3-padding-small w3-text-yellow" style="font-weight: 400;">
            <i class="fa fa-list-alt"></i> Dados do Item
        </h3>
        
        <form action="/backend/itenspedidos/salvar" method="post">
            
            <p>
                <label for="id_pedido"><strong>ID do Pedido:</strong></label>
                <input class="w3-input w3-border w3-light-grey" type="number" id="id_pedido" name="id_pedido" required placeholder="ID do Pedido (Ex: 15)">
            </p>

            <p>
                <label for="id_produto"><strong>ID do Produto:</strong></label>
                <input class="w3-input w3-border w3-light-grey" type="number" id="id_produto" name="id_produto" required placeholder="ID do Produto (Ex: 42)">
            </p>

            <p>
                <label for="quantidade"><strong>Quantidade:</strong></label>
                <input class="w3-input w3-border w3-light-grey" type="number" id="quantidade" name="quantidade" required min="1" placeholder="Quantidade (Ex: 3)">
            </p>

            <p>
                <label for="preco_unitario"><strong>Preço Unitário (R$):</strong></label>
                <input class="w3-input w3-border w3-light-grey" type="number" step="0.01" id="preco_unitario" name="preco_unitario" required placeholder="Preço (Ex: 12.50)">
            </p>

            <div class="w3-section w3-right-align">
                <button type="submit" class="w3-button w3-round w3-green w3-hover-dark-grey">
                    <i class="fa fa-check"></i> Salvar Item
                </button>
                <a href="/backend/itenspedidos/listar" class="w3-button w3-round w3-light-grey w3-hover-dark-grey w3-margin-left">
                    <i class="fa fa-arrow-left"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<div style="height: 50px;"></div>