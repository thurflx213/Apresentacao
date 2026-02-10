
<div class="luxury-profile-page">
    <div class="k-profile-card">
        <form action="/backend/cliente/perfil-atualizar/<?= $usuario['id_usuarios'] ?>" method="POST" enctype="multipart/form-data" class="profile-form">
            
            <div class="k-header-luxury">
                <div class="h-title">
                    <span class="gold-line"></span>
                    <h2>EDITAR PERFIL</h2>
                </div>
                <a class="k-back-link" href="/backend/cliente/dashboard">
                    <i class="fa fa-chevron-left"></i> VOLTAR
                </a>
            </div>

            <div class="k-profile-body">
                <div class="k-photo-section">
                    <div class="k-avatar-container">
                        <div class="avatar-shadow"></div>
                        <img id="preview-foto" 
                             src="<?= !empty($usuario['foto_usuarios']) ? '/backend/upload/usuarios/' . htmlspecialchars($usuario['foto_usuarios']) : '/img/logoperf.jpg' ?>" 
                             alt="Foto Perfil" class="k-avatar-main">
                        
                        <label class="k-upload-trigger" for="foto_usuarios">
                            <i class="fa fa-camera"></i>
                        </label>
                        <input type="file" name="foto_usuarios" id="foto_usuarios" accept="image/*" onchange="previewFoto(event)" style="display: none;" />
                    </div>
                </div>

                <div class="k-data-section">
                    <div class="k-input-group full-width">
                        <label>NOME COMPLETO</label>
                        <div class="input-wrapper">
                            <i class="fa fa-user gold-icon"></i>
                            <input type="text" name="nome_usuarios" value="<?= htmlspecialchars($usuario['nome_usuarios'] ?? '') ?>" required placeholder="Seu nome oficial" />
                        </div>
                    </div>

                    <div class="k-input-group full-width">
                        <label>EMAIL DE ACESSO</label>
                        <div class="input-wrapper">
                            <i class="fa fa-envelope gold-icon"></i>
                            <input type="email" name="email_usuarios" value="<?= htmlspecialchars($usuario['email_usuarios'] ?? '') ?>" required placeholder="seu@email.com" />
                        </div>
                    </div>

                    <div class="k-grid-inputs">
                        <div class="k-input-group">
                            <label>NOVA SENHA</label>
                            <div class="input-wrapper">
                                <i class="fa fa-lock gold-icon"></i>
                                <input type="password" name="senha_usuarios" placeholder="••••••••" />
                            </div>
                            <span class="k-hint">Opcional</span>
                        </div>
                        <div class="k-input-group">
                            <label>CONFIRMAÇÃO</label>
                            <div class="input-wrapper">
                                <i class="fa fa-shield-alt gold-icon"></i>
                                <input type="password" name="confirmar_senha" placeholder="••••••••" />
                            </div>
                        </div>
                    </div>

                    <div class="k-form-actions">
                        <button type="submit" class="k-btn-gold">
                            SALVAR DADOS
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewFoto(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('preview-foto');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@400;600;700&family=Montserrat:wght@300;400;600&display=swap');

    :root {
        --k-gold: #f2cc7d;
        --k-gold-dark: #b8860b;
        /* Using variables linked to global theme */
        --bg-body-custom: var(--bg-main);
        --bg-card-custom: var(--bg-card);
        --input-bg-custom:rgba(255,255,255,0.05);
        --text-color-custom: var(--text-main);
        --border-custom: var(--border-color);
        --k-text-muted: var(--text-muted);
    }

    .luxury-profile-page {
        font-family: 'Montserrat', sans-serif;
        color: var(--text-color-custom);
        padding: 40px;
        display: flex;
        justify-content: center;
        background-color: var(--bg-body-custom);
        min-height: 100vh;
    }

    .k-profile-card {
        width: 100%;
        max-width: 800px;
        background: var(--bg-card-custom);
        border: 1px solid var(--border-custom);
        border-radius: 16px;
        box-shadow: var(--shadow-md);
        margin-top: 20px;
    }

    .k-header-luxury {
        padding: 20px 40px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-custom);
        background: rgba(125,125,125,0.02);
    }

    .h-title { display: flex; align-items: center; gap: 15px; }
    .gold-line { width: 3px; height: 20px; background: var(--k-gold); }
    .h-title h2 { font-family: 'Oswald', sans-serif; font-size: 1.2rem; letter-spacing: 2px; margin: 0; color: var(--text-color-custom); }

    .k-back-link { 
        color: var(--k-text-muted); 
        text-decoration: none; 
        font-size: 0.75rem; 
        font-weight: 700; 
        letter-spacing: 1px;
        display: flex; align-items: center; gap: 8px;
        transition: 0.3s;
    }
    .k-back-link:hover { color: var(--k-gold); }

    .k-profile-body { padding: 40px; }

    /* Foto */
    .k-photo-section { 
        display: flex; 
        justify-content: center; 
        margin-bottom: 40px; 
    }

    .k-avatar-container { position: relative; width: 140px; height: 140px; }
    
    .k-avatar-main { 
        width: 100%; height: 100%; 
        border-radius: 50%;
        object-fit: cover; 
        border: 3px solid var(--k-gold);
        background: var(--bg-card-custom);
        box-shadow: 0 0 20px rgba(242, 204, 125, 0.2);
    }

    .k-upload-trigger {
        position: absolute;
        bottom: 0;
        right: -10px;
        background: var(--k-gold);
        color: #000;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 5px 15px rgba(0,0,0,0.5);
    }
    .k-upload-trigger:hover { transform: scale(1.1); background: #fff; }

    /* Formulário */
    .k-data-section { max-width: 600px; margin: 0 auto; }

    .k-input-group { margin-bottom: 25px; }
    .k-input-group label { 
        display: block; 
        font-size: 0.7rem; 
        font-weight: 700; 
        color: var(--k-text-muted); 
        letter-spacing: 1px; 
        margin-bottom: 8px; 
    }

    .input-wrapper { position: relative; }

    .gold-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--k-gold);
        font-size: 1rem;
        opacity: 0.8;
    }

    .k-input-group input {
        width: 100%;
        background: var(--bg-body-custom); /* Better contrast on light/dark */
        border: 1px solid var(--border-custom);
        padding: 14px 14px 14px 45px;
        border-radius: 10px;
        color: var(--text-color-custom);
        font-family: 'Montserrat', sans-serif;
        font-size: 0.95rem;
        transition: 0.3s;
        box-sizing: border-box;
    }

    .k-input-group input:focus { 
        border-color: var(--k-gold); 
        outline: none; 
        box-shadow: 0 0 10px rgba(242, 204, 125, 0.1);
    }

    .k-grid-inputs { 
        display: grid; 
        grid-template-columns: 1fr 1fr; 
        gap: 20px; 
    }

    .k-hint { float: right; font-size: 0.65rem; color: var(--k-text-muted); margin-top: 5px; }

    .k-form-actions { 
        margin-top: 30px; 
        text-align: center;
    }

    .k-btn-gold {
        background: linear-gradient(135deg, var(--k-gold), var(--k-gold-dark));
        color: #000;
        border: none;
        padding: 15px 50px;
        border-radius: 30px;
        font-weight: 800;
        font-size: 0.9rem;
        letter-spacing: 1px;
        cursor: pointer;
        transition: 0.3s;
        box-shadow: 0 10px 20px rgba(0,0,0,0.3);
    }
    .k-btn-gold:hover { 
        transform: translateY(-2px); 
        box-shadow: 0 15px 30px rgba(242, 204, 125, 0.3);
        filter: brightness(1.1);
    }

    @media (max-width: 700px) {
        .k-grid-inputs { grid-template-columns: 1fr; }
        .k-profile-body { padding: 25px; }
        .luxury-profile-page { padding: 10px; }
    }
</style>