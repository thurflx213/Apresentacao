<div class="w3-container">
    <h3 class="w3-text-green">Confirmar ativação</h3>
    
    <div class="w3-container w3-card-4 w3-padding">
        <p>Você tem certeza que deseja ativar o produto?</p>
        
        <h4><strong><?= htmlspecialchars($produtos['nome_produtos']); ?></strong></h4>
        
        <form action="/backend/produtos/deletar" method="POST">
            <input type="hidden" name="id_produto" value="<?= $produtos['id_produto']; ?>">

            <p>
                <button type="submit" class="w3-button w3-green w3-padding">Sim, ativar Produto</button>
                <a href="/backend/produtos/listar" class="w3-button w3-grey w3-padding">Cancelar</a>
            </p>
        </form>
    </div>
</div>