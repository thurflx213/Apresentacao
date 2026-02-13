</div> <!-- Fim da div w3-main aberta no header.php -->

<footer class="koketsu-footer">
    <div class="footer-container">
        <div class="footer-info">
            <p>&copy; <?= date('Y'); ?> <span class="accent-text">Koketsu Grife</span>. Todos os direitos reservados.</p>
        </div>
        <div class="footer-meta">
            <span class="system-tag">Sistema de Gestão v2.1</span>
        </div>
    </div>
</footer>

<style>
    .koketsu-footer {
        background-color: var(--bg-card);
        color: var(--text-muted);
        padding: 25px 20px;
        border-top: 1px solid var(--border-color);
        font-family: 'Segoe UI', sans-serif;
        margin-top: 40px;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 15px;
    }

    .footer-info p {
        margin: 0;
        font-size: 13px;
        letter-spacing: 0.5px;
    }

    .accent-text {
        color: var(--accent);
        font-weight: 700;
    }

    .system-tag {
        font-family: 'Courier New', Courier, monospace;
        font-size: 11px;
        background: var(--bg-main);
        padding: 4px 10px;
        border-radius: 4px;
        border: 1px solid var(--border-color);
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @media (max-width: 600px) {
        .footer-container {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<script> 
    // Funções para abrir/fechar o menu lateral em telas pequenas
    function w3_open() {
        const mySidebar = document.getElementById('mySidebar');
        const myOverlay = document.getElementById('myOverlay');
        if (mySidebar.style.display === 'block') {
            w3_close();
        } else {
            mySidebar.style.display = 'block';
            myOverlay.style.display = 'block';
        }
    }

    function w3_close() {
        const mySidebar = document.getElementById('mySidebar');
        const myOverlay = document.getElementById('myOverlay');
        mySidebar.style.display = 'none';
        myOverlay.style.display = 'none';
    }

    // Script para desaparecer as mensagens de alerta/flash
    setTimeout(() => { 
        const alert = document.querySelector('.alert'); 
        if(alert){ 
            alert.style.opacity = '0'; 
            alert.style.transform = 'translateY(-20px)'; 
            setTimeout(() => alert.remove(), 400); 
        } 
    }, 3000); 

    // Lógica para troca de logo baseada no tema
    function updateLogo() {
        const logo = document.getElementById('main-logo');
        if (!logo) return;
        const isLight = document.documentElement.classList.contains('theme-light');
        logo.src = isLight ? '/img/icons/logoBlack.png' : '/img/logo.png';
    }

    // Executa ao carregar e observa mudanças (se houver um switch dinâmico)
    document.addEventListener('DOMContentLoaded', updateLogo);
</script>
</body>
</html>
