<div class="settings-page">
    <div class="settings-card glass-card">
        <header class="settings-header">
            <div class="header-content">
                <div>
                    <h2><i class="fa fa-cog"></i> Configurações do Sistema</h2>
                    <p class="text-muted">Personalize sua experiência no Koketsu</p>
                </div>
                <a href="/backend/<?= $usuarioTipo === 'admin' ? 'admin' : 'cliente' ?>/dashboard" class="btn-back-dash">
                    <i class="fa fa-arrow-left"></i> Voltar ao Início
                </a>
            </div>
        </header>

        <section class="settings-section">
            <div class="section-title">
                <i class="fa fa-paint-brush"></i> Aparência e Tema
            </div>
            <div class="theme-options">
                <div class="theme-option" onclick="setTheme('dark')" id="theme-dark">
                    <div class="theme-preview dark-preview"></div>
                    <span>Modo Escuro</span>
                </div>
                <div class="theme-option" onclick="setTheme('light')" id="theme-light">
                    <div class="theme-preview light-preview"></div>
                    <span>Modo Claro</span>
                </div>
                <div class="theme-option" onclick="setTheme('system')" id="theme-system">
                    <div class="theme-preview system-preview"></div>
                    <span>Seguir Sistema</span>
                </div>
            </div>
        </section>

        <hr class="settings-divider">

        <section class="settings-section">
            <div class="section-title">
                <i class="fa fa-envelope"></i> Notificações
            </div>
            <div class="setting-item">
                <div class="setting-info">
                    <h4>E-mails de Pedidos</h4>
                    <p class="text-muted">Receber atualizações sobre seus pedidos via e-mail.</p>
                </div>
                <label class="switch">
                    <input type="checkbox" checked disabled>
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="setting-item">
                <div class="setting-info">
                    <h4>Promoções e Lançamentos</h4>
                    <p class="text-muted">Receber novidades e cupons de desconto.</p>
                </div>
                <label class="switch">
                    <input type="checkbox" checked>
                    <span class="slider round"></span>
                </label>
            </div>
        </section>

        <?php if ($usuarioTipo == 'admin'): ?>
        <hr class="settings-divider">
        <section class="settings-section">
            <div class="section-title">
                <i class="fa fa-lock"></i> Administração
            </div>
            <div class="setting-item">
                <div class="setting-info">
                    <h4>Modo Manutenção</h4>
                    <p class="text-muted">Bloquear acesso de clientes para atualizações.</p>
                </div>
                <label class="switch">
                    <input type="checkbox" id="maintenance-toggle" <?= $manutencaoAtiva ? 'checked' : '' ?> onchange="toggleMaintenance(this.checked)">
                    <span class="slider round"></span>
                </label>
            </div>
        </section>
        <?php endif; ?>
    </div>
</div>

<script>
    function toggleMaintenance(status) {
        fetch('/backend/configuracoes/manutencao', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Sucesso
            } else {
                alert('Erro ao atualizar modo manutenção: ' + data.message);
                document.getElementById('maintenance-toggle').checked = !status;
            }
        });
    }
    function setTheme(theme) {
        localStorage.setItem('theme', theme);
        applyTheme();
    }

    function applyTheme() {
        const theme = localStorage.getItem('theme') || 'dark';
        const body = document.body;
        
        // Remove classes existentes
        body.classList.remove('theme-light', 'theme-dark');
        
        // Remove seleções visuais
        document.querySelectorAll('.theme-option').forEach(opt => opt.classList.remove('active'));

        if (theme === 'light') {
            body.classList.add('theme-light');
            document.getElementById('theme-light').classList.add('active');
        } else if (theme === 'dark') {
            body.classList.add('theme-dark');
            document.getElementById('theme-dark').classList.add('active');
        } else {
            // Sistema
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
                body.classList.add('theme-light');
            } else {
                body.classList.add('theme-dark');
            }
            document.getElementById('theme-system').classList.add('active');
        }
        
        // Notifica o header para atualizar cores se necessário
        window.dispatchEvent(new Event('themeChanged'));
    }

    // Inicializa a seleção visual
    document.addEventListener('DOMContentLoaded', applyTheme);
</script>

<style>
    :root {
        --accent: #ffd700;
        --text-muted: #a0a0a5;
    }

    .settings-page {
        padding: 30px;
        animation: fadeIn 0.5s ease-out;
    }

    .settings-card {
        max-width: 800px;
        margin: 0 auto;
        padding: 40px;
        border-radius: 20px;
        background: rgba(30, 30, 35, 0.6);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 215, 0, 0.1);
    }

    .settings-header .header-content { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 30px; }
    .settings-header h2 { margin: 0; font-size: 24px; color: var(--accent); }
    .settings-header p { margin: 5px 0 0; }

    .btn-back-dash {
        padding: 10px 18px;
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 10px;
        color: #fff;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        transition: 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .btn-back-dash:hover {
        background: var(--accent);
        color: #000;
        border-color: var(--accent);
        transform: translateX(-5px);
    }

    .settings-section { margin-bottom: 30px; }
    .section-title { font-size: 14px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--accent); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }

    .theme-options { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; }
    .theme-option { 
        background: rgba(255,255,255,0.05); 
        padding: 15px; 
        border-radius: 12px; 
        text-align: center; 
        cursor: pointer; 
        border: 2px solid transparent; 
        transition: 0.3s;
    }
    .theme-option:hover { background: rgba(255,255,255,0.1); }
    .theme-option.active { border-color: var(--accent); background: rgba(255, 215, 0, 0.05); }

    .theme-preview { width: 100%; height: 60px; border-radius: 8px; margin-bottom: 10px; border: 1px solid rgba(255,255,255,0.1); }
    .dark-preview { background: #111; }
    .light-preview { background: #f5f5f5; }
    .system-preview { background: linear-gradient(135deg, #111 50%, #f5f5f5 50%); }

    .settings-divider { border: 0; border-top: 1px solid rgba(255,255,255,0.05); margin: 30px 0; }

    .setting-item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
    .setting-info h4 { margin: 0; font-size: 16px; }
    .setting-info p { margin: 4px 0 0; font-size: 13px; }

    /* Switch */
    .switch { position: relative; display: inline-block; width: 44px; height: 24px; }
    .switch input { opacity: 0; width: 0; height: 0; }
    .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0; background-color: #333; transition: .4s; }
    .slider:before { position: absolute; content: ""; height: 18px; width: 18px; left: 3px; bottom: 3px; background-color: white; transition: .4s; }
    input:checked + .slider { background-color: var(--accent); }
    input:checked + .slider:before { transform: translateX(20px); }
    .slider.round { border-radius: 34px; }
    .slider.round:before { border-radius: 50%; }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    /* Light Theme Overrides locally for preview */
    .theme-light .settings-card { background: rgba(255, 255, 255, 0.9); border-color: #ddd; color: #333; }
    .theme-light .theme-option { background: #f0f0f0; }
    .theme-light .text-muted { color: #666; }
</style>
