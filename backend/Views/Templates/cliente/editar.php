<div class="profile-page">
    <div class="profile-card">
        <form action="/backend/cliente/perfil-atualizar/<?= $usuario['id_usuarios'] ?>" method="POST" enctype="multipart/form-data" class="profile-form">
            <div class="profile-header">
                <h2><i class="fa fa-user-edit"></i> Editar Perfil</h2>
                <a class="back-btn" href="/backend/cliente/dashboard"><i class="fa fa-arrow-left"></i> Voltar</a>
            </div>

            <div class="profile-body">
                <div class="left-col">
                    <div class="avatar-wrap">
                        <img id="preview-foto" 
                             src="<?= !empty($usuario['foto_usuarios']) ? '/backend/upload/usuarios/' . htmlspecialchars($usuario['foto_usuarios']) : '/img/logoperf.jpg' ?>" 
                             alt="Foto Perfil" class="avatar">
                        <label class="edit-photo" for="foto_usuarios"><i class="fa fa-camera"></i></label>
                        <input type="file" name="foto_usuarios" id="foto_usuarios" accept="image/*" onchange="previewFoto(event)" />
                        
                    </div>
                </div>

                <div class="right-col">
                    <div class="field-row">
                        <label>Nome Completo</label>
                        <input type="text" name="nome_usuarios" value="<?= htmlspecialchars($usuario['nome_usuarios'] ?? '') ?>" required />
                    </div>

                    <div class="field-row">
                        <label>Email</label>
                        <input type="email" name="email_usuarios" value="<?= htmlspecialchars($usuario['email_usuarios'] ?? '') ?>" required />
                    </div>

                    <div class="field-row two-cols">
                        <div>
                            <label>Nova Senha</label>
                            <input type="password" name="senha_usuarios" placeholder="Deixe em branco para não alterar" />
                            <small class="small-note">Mínimo de 6 caracteres</small>
                        </div>
                        <div>
                            <label>Confirmar Nova Senha</label>
                            <input type="password" name="confirmar_senha" placeholder="Confirme a nova senha" />
                        </div>
                    </div>

                    <div class="actions">
                        <button type="submit" class="save-btn"><i class="fa fa-save"></i> Salvar Alterações</button>
                        <a href="/backend/cliente/dashboard" class="cancel-btn"><i class="fa fa-times"></i> Cancelar</a>
                    </div>
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
    :root{
        --bg:#11121a;
        --card:#1f1f23;
        --muted:#a8a9ad;
        --accent:#ffd700;
        --accent-2:#ffed4e;
        --input:#2a2a2f;
        --glass: rgba(255,255,255,0.03);
    }

    .profile-page{
        min-height: calc(100vh - 40px);
        display:flex;
        align-items:flex-start;
        justify-content:center;
        padding:30px 20px;
        background: linear-gradient(180deg,var(--bg),#141416);
        color:#eee;
    }

    .profile-card{
        width:100%;
        max-width:980px;
        background: linear-gradient(180deg,var(--card), #2a2a2a);
        border-radius:12px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.6);
        overflow: hidden;
        border-top:4px solid var(--accent);
    }

    .profile-header{
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:20px 28px;
        border-bottom:1px solid rgba(255,255,255,0.03);
        backdrop-filter: blur(4px);
    }

    .profile-header h2{font-size:20px; color:#fff; margin:0}
    .back-btn{color:var(--muted); text-decoration:none; font-weight:600;}

    .profile-body{display:flex; gap:30px; padding:30px}

    .left-col{width:260px; display:flex; justify-content:center}

    .avatar-wrap{position:relative; text-align:center}
    .avatar{width:170px; height:170px; border-radius:50%; object-fit:cover; border:6px solid rgba(255,215,0,0.16); box-shadow: 0 8px 20px rgba(0,0,0,0.6)}

    .edit-photo{position:absolute; right:6px; bottom:6px; background:linear-gradient(180deg,var(--accent),var(--accent-2)); color:#111; width:44px; height:44px; border-radius:50%; display:flex; align-items:center; justify-content:center; cursor:pointer; box-shadow:0 6px 14px rgba(0,0,0,0.5);}
    .edit-photo i{font-size:16px}
    .avatar-wrap input[type=file]{display:none}
    .hint{color:var(--muted); font-size:12px; margin-top:10px}

    .right-col{flex:1}
    .field-row{margin-bottom:16px}
    .field-row label{display:block; color:var(--muted); font-weight:600; margin-bottom:6px}
    .field-row input{width:100%; padding:12px 14px; border-radius:8px; border:1px solid rgba(255,255,255,0.03); background:var(--input); color:#fff}
    .field-row .small-note{display:block; color:var(--muted); margin-top:6px; font-size:12px}

    .two-cols{display:grid; grid-template-columns:1fr 1fr; gap:14px}

    .actions{display:flex; gap:12px; margin-top:6px}
    .save-btn{background:linear-gradient(90deg,var(--accent),var(--accent-2)); border:none; color:#111; padding:12px 18px; border-radius:10px; font-weight:700; cursor:pointer}
    .cancel-btn{background:transparent; border:1px solid rgba(255,255,255,0.06); color:var(--muted); padding:12px 18px; border-radius:10px; text-decoration:none; display:inline-flex; align-items:center}

    /* responsive */
    @media(max-width:800px){
        .profile-body{flex-direction:column; padding:20px}
        .left-col{width:100%; order:1; display:flex; justify-content:center}
        .right-col{order:2}
        .two-cols{grid-template-columns:1fr}
    }
</style>
