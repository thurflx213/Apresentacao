<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="w3-row-padding w3-margin-bottom">
    

<div class="w3-container w3-margin-top w3-card w3-dark-grey w3-round-large w3-padding">
    <h3 class="w3-text-yellow"><i class="fa fa-bar-chart"></i> Estoque de Produtos</h3>
    <canvas id="vendasChart" style="max-height: 350px;"></canvas>
</div>

<hr class="w3-border-dark-grey">
<script>
    const dados_php = <?php echo json_encode($produto); ?>; 
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
                    text: 'Produtos por Categoria',
                    color: 'white'
                }
            }
        },
    };

    var myChart = new Chart(document.getElementById('vendasChart'), config);

   
</script>



<style>
    /* Container Principal (Afastado do Menu) */
.page-wrapper {
    padding-left: 10px; 
    padding-right: 20px;
    padding-top: 20px;
    width: 100%;
    box-sizing: border-box;
    display: flex; 
    flex-direction: column;
}

/* Botão Principal (Pequeno e no Canto Esquerdo) */
.btn-main-action {
    display: inline-flex; 
    align-self: flex-start; /* Coloca o botão no canto esquerdo (Flex Start) */
    
    background: #dfd155ff; /* Cor amarela/dourada */
    padding: 10px 15px;
    color: #000000ff;
    border: none;
    font-size: 15px;
    font-weight: 600;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.2s;
    text-decoration: none; 
    margin-bottom: 20px; 
    
    align-items: center;
    gap: 8px;
}

/* Estilo do Breadcrumb */
.header-breadcrumb {
    color: #bbb;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid #333;
}
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

/* Defina a classe que deve ser aplicada à linha inteira (<tr>) */
.w3-striped > tbody > tr.w3-pale-red,
    .w3-striped > tbody > tr.w3-pale-red:nth-child(even),
    .w3-striped > tbody > tr.w3-pale-red:nth-child(odd) 
    {
        background-color: #f0a3a3ff !important; 
        color: #000 !important;
    }
    .w3-striped > tbody > tr.w3-pale-red {
        background-color: #5b0000 !important;
        color: white !important;
    }

/* ... restante do seu estilo ... */
</style>
<div class="page-wrapper list-page">

    <h3 class="page-title"><i class="fa fa-cubes"></i> Gerenciar Produtos</h3>

     <header class="header-breadcrumb">
        <h5><b><i class="fa fa-dashboard"></i> Painel de produtos - Koketsu</b></h5>
    </header>
    <form action="/backend/produtos/listar" method="POST" class="w3-container w3-padding-small" style="padding: 0!important;">
            <div class="w3-row-padding" style="margin: 0 -16px;">
                <div class="w3-col l4 m6 s12 w3-padding-small">
                    <input 
                        type="text" 
                        name="nome_produtos" 
                        class="w3-input w3-border w3-round-large" 
                        placeholder="Buscar por ID do Produto"
                        value="<?= htmlspecialchars($_POST['nome_produtos'] ?? '') ?>"
                        style="background-color: #222; color: #fff; border-color: #555;">
                </div>
                <div class="w3-col l2 m3 s12 w3-padding-small">
                    <button type="submit" class="w3-button w3-round-large w3-amber w3-hover-khaki w3-block" style="font-weight: 600;">
                        <i class="fa fa-search"></i> Pesquisar
                    </button>
                </div>
                
                <?php if (isset($_POST['id_produto'])): ?>
                    <div class="w3-col l2 m3 s12 w3-padding-small">
                        <a href="/backend/produtos/listar/" class="w3-button w3-round-large w3-red w3-hover-pink w3-block">
                            <i class="fa fa-times-circle"></i> Limpar
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </form>

    <a href="/backend/produtos/criar" class="btn-main-action">
        <i class="fa fa-plus-circle"></i> Adicionar Novo Produto
    </a>
    
   

    </div>

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
                        <a class="w3-button w3-round w3-blue w3-text-black w3-padding-small"
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