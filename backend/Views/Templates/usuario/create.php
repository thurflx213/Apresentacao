<div class="page-wrapper">

    <h3 class="page-title"><i class="fa fa-user-plus"></i> Novo Usuário</h3>

    <form action="/backend/usuario/salvar" method="post" enctype="multipart/form-data" class="form-card">

        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome_usuarios" required>
        </div>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email_usuarios" required>
        </div>

        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="senha_usuarios" required>
        </div>

        <div class="form-group">
            <label>Tipo:</label>
            <select name="nivel_acesso" required>
                <option value="Vendedor">Vendedor</option>
                <option value="Admin">Admin</option>
                <option value="Cliente">Cliente</option>
            </select>
        </div>

        <button type="submit" class="btn-save">
            <i class="fa fa-save"></i> Salvar Usuário
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
