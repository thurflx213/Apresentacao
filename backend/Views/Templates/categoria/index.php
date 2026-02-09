<style>
    /* Estilos de Categorias */
    .cat-wrapper { padding-top: 10px; }
    
    .cat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid var(--border-color);
    }
    
    .cat-title h1 { font-size: 2em; font-weight: 800; color: var(--text-main); margin: 0; letter-spacing: -1px; }
    .cat-title p { color: var(--text-muted); font-size: 0.9em; margin-top: 4px; }

    .btn-add-cat {
        background: var(--accent);
        color: #000;
        padding: 12px 24px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 800;
        text-transform: uppercase;
        font-size: 0.8em;
        letter-spacing: 1px;
        transition: 0.3s;
        box-shadow: 0 4px 15px rgba(197, 160, 45, 0.2);
    }
    .btn-add-cat:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(197, 160, 45, 0.3); background: var(--text-main); color: var(--bg-main); }

    /* Stats Grid */
    .cat-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .cat-stat-card {
        background: var(--bg-card);
        padding: 20px;
        border-radius: 16px;
        border: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 15px;
        transition: 0.3s;
    }
    .cat-stat-card:hover { border-color: var(--accent); transform: translateY(-3px); }
    .cat-stat-icon { width: 48px; height: 48px; background: rgba(var(--accent), 0.1); color: var(--accent); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2em; }
    .cat-stat-info h3 { margin: 0; font-size: 1.2em; color: var(--text-main); font-weight: 800; }
    .cat-stat-info p { margin: 0; font-size: 11px; text-transform: uppercase; color: var(--text-muted); font-weight: 700; letter-spacing: 1px; }

    /* Table Design */
    .table-container {
        background: var(--bg-card);
        border-radius: 16px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }

    .cat-table { width: 100%; border-collapse: collapse; }
    .cat-table thead th { background: var(--bg-main); color: var(--accent); text-align: left; padding: 18px 20px; font-size: 0.75em; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; border-bottom: 1px solid var(--border-color); }
    .cat-table tbody td { padding: 18px 20px; border-bottom: 1px solid var(--border-color); color: var(--text-main); font-size: 0.95em; }
    .cat-table tr:hover { background: rgba(var(--accent), 0.02); }

    .badge-status { padding: 5px 12px; border-radius: 8px; font-size: 10px; font-weight: 900; text-transform: uppercase; display: inline-block; }
    .status-active { background: rgba(46, 213, 115, 0.1); color: #2ed573; border: 1px solid rgba(46, 213, 115, 0.2); }
    .status-inactive { background: rgba(255, 71, 87, 0.1); color: #ff4757; border: 1px solid rgba(255, 71, 87, 0.2); }

    .action-btns { display: flex; gap: 8px; }
    .btn-edit-cat { color: var(--accent); background: rgba(var(--accent), 0.1); width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: 0.3s; border: 1px solid transparent; }
    .btn-edit-cat:hover { background: var(--accent); color: #000; }
    .btn-del-cat { color: #ff4757; background: rgba(255, 71, 87, 0.1); width: 34px; height: 34px; display: flex; align-items: center; justify-content: center; border-radius: 8px; transition: 0.3s; border: 1px solid transparent; }
    .btn-del-cat:hover { background: #ff4757; color: #fff; }

    /* Pagination */
    .pag-nav { margin-top: 30px; display: flex; justify-content: center; gap: 10px; align-items: center; }
    .pag-link { padding: 8px 16px; border-radius: 10px; background: var(--bg-card); border: 1px solid var(--border-color); color: var(--text-main); text-decoration: none; font-size: 0.9em; font-weight: 600; transition: 0.3s; }
    .pag-link:hover { border-color: var(--accent); color: var(--accent); }
    .pag-current { color: var(--accent); font-weight: 800; font-size: 0.95em; }
</style>

<div class="cat-wrapper">
    <header class="cat-header">
        <div class="cat-title">
            <h1>🏷️ Categorias</h1>
            <p>Gerencie as classificações de produtos da sua loja.</p>
        </div>
        <a href="/backend/categoria/criar" class="btn-add-cat">Nova Categoria</a>
    </header>

    <div class="cat-stats">
        <div class="cat-stat-card">
            <div class="cat-stat-icon"><i class="fa fa-tags"></i></div>
            <div class="cat-stat-info">
                <h3><?= count($categorias ?? []) ?></h3>
                <p>Total de Categorias</p>
            </div>
        </div>
        <div class="cat-stat-card">
            <div class="cat-stat-icon"><i class="fa fa-check-circle"></i></div>
            <div class="cat-stat-info">
                <h3><?= count(array_filter($categorias ?? [], fn($c) => empty($c['excluido_em']))) ?></h3>
                <p>Ativas</p>
            </div>
        </div>
    </div>

    <?php if (isset($categorias) && count($categorias) > 0): ?>
    <div class="table-container">
        <table class="cat-table">
            <thead>
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th>Nome da Categoria</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th style="width: 120px; text-align: center;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $categoria): ?>
                <tr>
                    <td style="font-family: monospace; font-weight: 700; color: var(--text-muted);">#<?= str_pad($categoria['id_categorias'], 3, '0', STR_PAD_LEFT) ?></td>
                    <td style="font-weight: 800;"><?= htmlspecialchars($categoria['nome_categorias']) ?></td>
                    <td style="color: var(--text-muted); font-size: 0.9em;"><?= htmlspecialchars($categoria['descricao_categorias'] ?: 'Sem descrição informada') ?></td>
                    <td>
                        <?php if(!empty($categoria['excluido_em'])): ?>
                            <span class="badge-status status-inactive">Inativo</span>
                        <?php else: ?>
                            <span class="badge-status status-active">Ativo</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="action-btns" style="justify-content: center;">
                            <a href="/backend/categoria/editar/<?= htmlspecialchars($categoria['id_categorias']) ?>" class="btn-edit-cat" title="Editar"><i class="fa fa-edit"></i></a>
                            <a href="/backend/categoria/excluir/<?= htmlspecialchars($categoria['id_categorias']) ?>" class="btn-del-cat" title="Excluir"><i class="fa fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="pag-nav">
        <?php if ($paginacao['pagina_atual'] > 1): ?>
            <a href="/backend/categoria/listar/<?= $paginacao['pagina_atual'] - 1 ?>" class="pag-link"><i class="fa fa-chevron-left"></i> Anterior</a>
        <?php endif; ?>
        
        <span class="pag-current">Página <?= $paginacao['pagina_atual'] ?> de <?= $paginacao['ultima_pagina'] ?></span>
        
        <?php if ($paginacao['pagina_atual'] < $paginacao['ultima_pagina']): ?>
            <a href="/backend/categoria/listar/<?= $paginacao['pagina_atual'] + 1 ?>" class="pag-link">Próximo <i class="fa fa-chevron-right"></i></a>
        <?php endif; ?>
    </div>
    
    <?php else: ?>
        <div style="background: var(--bg-card); border: 2px dashed var(--border-color); padding: 60px; text-align: center; border-radius: 16px;">
            <i class="fa fa-search" style="font-size: 3em; color: var(--text-muted); margin-bottom: 20px; display: block;"></i>
            <h2 style="color: var(--text-main); font-weight: 800;">Nenhuma categoria encontrada</h2>
            <p style="color: var(--text-muted);">Sua loja ainda não possui categorias cadastradas.</p>
            <a href="/backend/categoria/criar" style="color: var(--accent); font-weight: 800; text-decoration: none; margin-top: 15px; display: inline-block;">Clique aqui para criar a primeira</a>
        </div>
    <?php endif; ?>
</div>

 