<div class="w3-container w3-margin-top">
    <div class="w3-card-4 w3-light-grey w3-padding-large" style="max-width: 600px; margin: 0 auto;">
        <h2 class="w3-text-dark-grey"><i class="fa fa-user-edit"></i> Editar Perfil</h2>
        <hr class="w3-border-dark-grey">

        <form action="/backend/cliente/atualizar/<?= $usuario['id_usuarios'] ?>" method="POST" enctype="multipart/form-data">
            
            <!-- Foto do Perfil -->
            <div class="w3-margin-bottom w3-center">
                <h4 class="w3-text-dark-grey">Foto do Perfil</h4>
                <img id="preview-foto" 
                     src="<?= !empty($usuario['foto_usuarios']) ? '/backend/upload/usuarios/' . htmlspecialchars($usuario['foto_usuarios']) : '/img/logoperf.jpg' ?>" 
                     alt="Foto Perfil" 
                     style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover; border: 3px solid #ffcc00;">
                <div class="w3-margin-top">
                    <input type="file" 
                           name="foto_usuarios" 
                           id="foto_usuarios" 
                           class="w3-input w3-border w3-round" 
                           accept="image/*"
                           onchange="previewFoto(event)">
                    <p class="w3-text-grey w3-small">Formatos aceitos: JPG, PNG, GIF (máx. 5MB)</p>
                </div>
            </div>

            <!-- Nome -->
            <div class="w3-margin-bottom">
                <label class="w3-text-dark-grey"><b>Nome Completo</b></label>
                <input class="w3-input w3-border w3-round" 
                       type="text" 
                       name="nome_usuarios" 
                       value="<?= htmlspecialchars($usuario['nome_usuarios'] ?? '') ?>" 
                       required>
            </div>

            <!-- Email -->
            <div class="w3-margin-bottom">
                <label class="w3-text-dark-grey"><b>Email</b></label>
                <input class="w3-input w3-border w3-round" 
                       type="email" 
                       name="email_usuarios" 
                       value="<?= htmlspecialchars($usuario['email_usuarios'] ?? '') ?>" 
                       required>
            </div>

            <!-- Senha -->
            <div class="w3-margin-bottom">
                <label class="w3-text-dark-grey"><b>Nova Senha</b></label>
                <input class="w3-input w3-border w3-round" 
                       type="password" 
                       name="senha_usuarios" 
                       placeholder="Deixe em branco para não alterar">
                <p class="w3-text-grey w3-small">Mínimo de 6 caracteres</p>
            </div>

            <!-- Confirmar Senha -->
            <div class="w3-margin-bottom">
                <label class="w3-text-dark-grey"><b>Confirmar Nova Senha</b></label>
                <input class="w3-input w3-border w3-round" 
                       type="password" 
                       name="confirmar_senha" 
                       placeholder="Confirme a nova senha">
            </div>

            <!-- Botões -->
            <div class="w3-row-padding w3-margin-top w3-margin-bottom">
                <div class="w3-col m6 w3-margin-bottom">
                    <button type="submit" class="w3-button w3-block w3-green w3-padding-large w3-round">
                        <i class="fa fa-save"></i> Salvar Alterações
                    </button>
                </div>
                <div class="w3-col m6 w3-margin-bottom">
                    <a href="/backend/cliente/dashboard" class="w3-button w3-block w3-grey w3-padding-large w3-round">
                        <i class="fa fa-arrow-left"></i> Voltar
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
function previewFoto(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-foto').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>

<style>
    .w3-container {
        background-color: #1e1e1e;
        color: #f0f0f0;
    }
    
    .w3-card-4 {
        background-color: #2a2a2a !important;
        color: #f0f0f0;
    }
    
    .w3-input {
        background-color: #333 !important;
        color: #f0f0f0 !important;
        border-color: #555 !important;
    }
    
    .w3-input:focus {
        background-color: #404040 !important;
        border-color: #ffcc00 !important;
    }
    
    .w3-button {
        font-weight: 600;
        border-radius: 6px;
    }
    
    .w3-text-dark-grey {
        color: #f0f0f0;
    }
</style>
