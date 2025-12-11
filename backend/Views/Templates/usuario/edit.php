<div class="page-wrapper">

    <h3 class="page-title"><i class="fa fa-pencil"></i> Editando Usuário: <?= htmlspecialchars($usuario['nome_usuarios']); ?></h3>

    <form action="/backend/usuario/atualizar" method="post" enctype="multipart/form-data" class="form-card">

        <input type="text" id="id_usuarios" name="id_usuarios" value="<?php echo $usuario['id_usuarios']; ?>" hidden>

        <div class="form-group">
            <label for="nome_usuarios">Nome:</label>
            <input type="text" id="nome_usuarios" name="nome_usuarios" value="<?php echo $usuario['nome_usuarios']; ?>" required>
        </div>

        <div class="form-group">
            <label for="email_usuarios">Email:</label>
            <input type="email" id="email_usuarios" name="email_usuarios" value="<?php echo $usuario['email_usuarios']; ?>" required>
        </div>

        <div class="form-group">
            <label for="senha_usuarios">Nova Senha (deixe em branco para não alterar):</label>
            <input type="password" id="senha_usuarios" name="senha_usuarios" value=""> 
        </div>

        <div class="form-group">
            <label for="nivel_acesso">Tipo:</label>
            <select id="nivel_acesso" name="nivel_acesso" required>
                <option value="Vendedor" <?php echo ($usuario['nivel_acesso'] === 'Vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                <option value="Admin" <?php echo ($usuario['nivel_acesso'] === 'Admin') ? 'selected' : ''; ?>>Admin</option>
                <option value="Cliente" <?php echo ($usuario['nivel_acesso'] === 'Cliente') ? 'selected' : ''; ?>>Cliente</option>
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
}

.btn-save:hover {
    background: #e49e1cff;
    box-shadow: 0 0 10px rgba(241, 220, 25, 0.4);
}

/* Novo estilo para o botão de Cancelar para se harmonizar */
.btn-cancelar {
    display: block; /* Garante que o link ocupe toda a largura */
    width: 100%;
    text-align: center;
    background: #555; /* Um cinza mais discreto */
    padding: 12px;
    color: #fff;
    border: none;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.2s;
    text-decoration: none; /* Remove sublinhado de link */
}

.btn-cancelar:hover {
    background: #777;
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
}

</style>