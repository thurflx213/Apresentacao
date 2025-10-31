<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="w3-row-padding w3-margin-bottom">
    

<div class="w3-container w3-margin-top w3-card w3-dark-grey w3-round-large w3-padding">
    <h3 class="w3-text-yellow"><i class="fa fa-bar-chart"></i> Vendas por Mês (Produtos)</h3>
    <canvas id="vendasChart" style="max-height: 350px;"></canvas>
</div>

<hr class="w3-border-dark-grey">
<script>
    const dados_php = <?php echo json_encode($produto); ?>; 
    console.log(dados_php)
    const labels = dados_php.map(item => item.produto);
    const dataValues = dados_php.map(item => item.total);

    const corAmarela = 'rgba(255, 193, 7, 0.8)'; 
    const corFundo = 'rgba(255, 193, 7, 0.3)'; 

    const data = {
        labels: labels,
        datasets: [{
            label: 'Total de Produtos',
            backgroundColor: corAmarela,
            borderColor: corAmarela,
            data: dataValues,
            borderRadius: 5
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    grid: { color: 'rgba(255, 255, 255, 0.1)' },
                    ticks: { color: 'white' }
                },
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1, color: 'white' },
                    grid: { color: 'rgba(255, 255, 255, 0.1)' }
                }
            },
            plugins: {
                legend: { labels: { color: 'white' } },
                title: {
                    display: true,
                    text: 'Produtos por Nome',
                    color: 'white'
                }
            }
        },
    };

    var myChart = new Chart(document.getElementById('vendasChart'), config);

   
</script>



<style>
/* ... suas regras existentes ... */

/* 1. AUMENTA O CONTEÚDO DA CÉLULA (Palavras/Texto) */
#Produtos tbody td {
    min-height: 150px; 
    padding: 20px 10px !important; 
    vertical-align: middle; 
    
    /* Mantém o texto maior para leitura */
    font-size: 1.15em; /* Reduzido levemente para 1.05em */
    line-height: 1.4; 
}

/* Garante que a imagem se ajuste bem dentro da nova altura */
#Produtos tbody td img {
    width: 120px !important; 
    height: auto; 
    max-height: 120px; 
    object-fit: contain;
}

/* 2. REFINAMENTO DOS BOTÕES (Editar/Inativar/Ativar) */
.w3-button {
    /* Padding reduzido para um tamanho mais confortável */
    padding: 8px 12px !important; 
    /* Tamanho da fonte dos botões reduzido para evitar que pareçam gigantes */
    font-size: 0.95em !important; 
    font-weight: bold; 
    margin: 4px 0; 
    min-width: 80px; /* Largura mínima um pouco menor */
    border-radius: 4px; /* Adiciona um pequeno arredondamento se o w3.css não tiver */
}

/* Ajuste das Tags de Status (Ativo/Inativo) para manter a proporção */
.w3-tag {
    font-size: 0.85em !important; 
    padding: 3px 7px !important;
}

/* ... restante do seu estilo ... */
</style>
<div class="w3-container">
    <h3>Gerenciar Produtos</h3>
    <a href="/backend/produtos/criar" class="w3-button w3-yellow w3-text-black w3-round-medium">Adicionar Novo Produto</a>
    
    <header class="w3-container" style="padding-top:22px">
        <h5><b><i class="fa fa-dashboard"></i> Painel de produtos - Koketsu</b></h5>
    </header>

    <main>
        <table id="Produtos" class="w3-table w3-striped">
            
            <thead>
                <tr class="w3-light-grey">
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            
            <tbody>
                <?php foreach ($produtos as $produto): 
                    $is_inativo = !empty($produto['excluido_em']); 
                ?>
                
                <tr class="<?= $is_inativo ? 'w3-pale-red' : '' ?>">
                    <td><img src="/backend/upload/<?= htmlspecialchars($produto['imagem_produtos']); ?>" style="width:100px;"></td>
                    <td><?= htmlspecialchars($produto['nome_produtos']); ?></td>
                    <td><?= htmlspecialchars($produto['descricao_produtos']); ?></td>
                    
                    <td>
                        <?php if ($is_inativo): ?>
                            <span class="w3-button w3-red w3-small w3-round-medium">Inativo</span>
                        <?php else: ?>
                            <span class="w3-button w3-green w3-small w3-round-medium">Ativo</span>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <a class="w3-button w3-round w3-yellow w3-text-black w3-padding-small"
                           href="/backend/produtos/editar/<?= $produto['id_produto']; ?>">Editar</a>
                    </td>
                    
                    <td>
                        <?php if ($is_inativo): ?>
                            <a href="/backend/produtos/ativar/<?= htmlspecialchars($produto['id_produto']) ?>"
                               class="w3-button w3-small w3-green w3-round-medium">Ativar</a>
                        <?php else: ?>
                            <a href="/backend/produtos/excluir/<?= htmlspecialchars($produto['id_produto']) ?>"
                               class="w3-button w3-small w3-red w3-round-medium">Inativar</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>