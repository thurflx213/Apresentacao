<div class="page-wrapper">

    <h3 class="page-title"><i class="fa fa-pencil"></i> Editando Usuário: <?= htmlspecialchars($usuario['nome_usuarios']); ?></h3>

    <form action="/backend/usuario/atualizar" method="post" enctype="multipart/form-data" class="form-card">

        <input type="text" id="id_usuarios" name="id_usuarios" value="<?php echo $usuario['id_usuarios']; ?>" hidden>

        <!-- Seção de Foto de Perfil com Preview -->
        <div class="profile-photo-section">
            <div class="photo-container">
                <img id="photoPreview" 
                     src="<?php echo !empty($usuario['foto_usuarios']) ? htmlspecialchars($usuario['foto_usuarios']) : '/img/logoperf.jpg'; ?>" 
                     alt="Foto de perfil de <?= htmlspecialchars($usuario['nome_usuarios']); ?>"
                     class="profile-photo">
            </div>
            
            <div class="photo-upload">
                <label for="foto_usuarios" class="upload-label">
                    <i class="fa fa-camera"></i> Alterar Foto
                </label>
                <input type="file" 
                       id="foto_usuarios" 
                       name="foto_usuarios" 
                       accept="image/jpeg, image/png, image/gif, image/webp"
                       onchange="previewPhoto(event)"
                       class="file-input">
                <p class="upload-hint">JPG, PNG, GIF ou WebP (Máx. 2MB)</p>
            </div>
        </div>

        <div class="form-group">
            <label for="nome_usuarios">Nome:</label>
            <input type="text" id="nome_usuarios" name="nome_usuarios" value="<?php echo htmlspecialchars($usuario['nome_usuarios']); ?>" required>
        </div>

        <div class="form-group">
            <label for="email_usuarios">Email:</label>
            <input type="email" id="email_usuarios" name="email_usuarios" value="<?php echo htmlspecialchars($usuario['email_usuarios']); ?>" required>
        </div>

        <div class="form-group">
            <label for="senha_usuarios">Nova Senha (deixe em branco para não alterar):</label>
            <input type="password" id="senha_usuarios" name="senha_usuarios" value=""> 
        </div>

        <div class="form-group">
            <label for="nivel_acesso">Tipo:</label>
            <select id="nivel_acesso" name="nivel_acesso" required>
                <option value="cliente" <?php echo ($usuario['nivel_acesso'] === 'cliente') ? 'selected' : ''; ?>>Cliente</option>
                <option value="vendedor" <?php echo ($usuario['nivel_acesso'] === 'vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                <option value="admin" <?php echo ($usuario['nivel_acesso'] === 'admin') ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn-save" style="margin-bottom: 10px;">
            <i class="fa fa-save"></i> Salvar Alterações
        </button>

        <a href="/backend/usuario/listar" class="btn-cancelar">
            <i class="fa fa-times-circle"></i> Cancelar
        </a>

    </form>

</div>
<style>

.page-wrapper {
    padding-left: 10px; 
    padding-right: 220px;
    padding-top: 20px; 
    width: 100%;
    box-sizing: border-box;

    display: flex; 
    flex-direction: column;
}

.form-card {
    background: #111;
    padding: 25px;
    border-radius: 12px;
    width: 420px;
    margin-left: auto;
    margin-right: auto;
    
    box-shadow: 0 0 15px rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

.page-title {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 15px;
    color: #ffffff;
    width: 420px; 
    margin-left: auto;
    margin-right: auto;
    text-align: left;
}

/* Seção de Foto de Perfil */
.profile-photo-section {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 15px;
    margin-bottom: 25px;
    padding: 20px;
    background: #1a1a1a;
    border-radius: 10px;
    border: 1px solid #333;
}

.photo-container {
    position: relative;
    width: 120px;
    height: 120px;
}

.profile-photo {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #dfd155;
    box-shadow: 0 0 15px rgba(223, 209, 85, 0.3);
    transition: all 0.3s ease;
}

.profile-photo:hover {
    box-shadow: 0 0 20px rgba(223, 209, 85, 0.5);
    transform: scale(1.02);
}

.photo-upload {
    text-align: center;
    width: 100%;
}

.upload-label {
    display: inline-block;
    background: #dfd155;
    color: #000;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.2s ease;
    font-size: 14px;
}

.upload-label:hover {
    background: #e49e1c;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(223, 209, 85, 0.3);
}

.file-input {
    display: none;
}

.upload-hint {
    font-size: 12px;
    color: #888;
    margin-top: 8px;
}

.form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 16px;
}

.form-group label {
    margin-bottom: 6px;
    font-size: 15px;
    color: #ddd;
}

.form-group input,
.form-group select {
    background: #1a1a1a;
    border: 1px solid #333;
    padding: 10px;
    border-radius: 6px;
    color: #fff;
    font-size: 15px;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #e2c93eff;
    outline: none;
    box-shadow: 0 0 8px rgba(226, 201, 62, 0.2);
}

.btn-save {
    width: 100%;
    background: #dfd155ff;
    padding: 12px;
    color: #000000ff;
    border: none;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
    font-weight: 600;
}

.btn-save:hover {
    background: #e49e1cff;
    box-shadow: 0 0 10px rgba(241, 220, 25, 0.4);
    transform: translateY(-2px);
}

.btn-cancelar {
    display: block;
    width: 100%;
    text-align: center;
    background: #555;
    padding: 12px;
    color: #fff;
    border: none;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
    text-decoration: none;
    font-weight: 600;
}

.btn-cancelar:hover {
    background: #777;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    transform: translateY(-2px);
}

</style>

<script>
function previewPhoto(event) {
    const file = event.target.files[0];
    
    if (file) {
        // Validar tamanho do arquivo (2MB máx)
        if (file.size > 2 * 1024 * 1024) {
            alert('Arquivo muito grande! Máximo 2MB.');
            event.target.value = '';
            return;
        }
        
        // Validar tipo de arquivo
        const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!validTypes.includes(file.type)) {
            alert('Tipo de arquivo inválido! Use JPG, PNG, GIF ou WebP.');
            event.target.value = '';
            return;
        }
        
        // Mostrar preview
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoPreview').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}
</script>