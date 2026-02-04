<?php
$perfil = $perfil ?? [];
?>

<style>
    /* Container do Card Principal */
    .premium-card {
        background-color: #1a1a1a;
        border-radius: 30px;
        border: 1px solid #333;
        box-shadow: 0 20px 50px rgba(0,0,0,0.6);
        max-width: 700px;
        margin: 40px auto;
        padding: 40px;
        font-family: 'Segoe UI', Roboto, sans-serif;
        color: white;
    }

    /* Título e Subtítulo */
    .card-header h1 {
        font-size: 28px;
        margin: 0;
        color: #f2cc7d; /* Dourado */
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .card-header p {
        color: #666;
        font-size: 14px;
        margin-top: 5px;
        margin-bottom: 30px;
    }

    /* Estilização dos Inputs */
    .form-group {
        margin-bottom: 20px;
    }
    .label-gray {
        color: #aaa;
        font-size: 13px;
        margin-bottom: 8px;
        display: block;
        font-weight: 600;
        text-transform: uppercase;
    }
    .input-gold {
        background-color: #f2cc7d !important;
        color: #000 !important;
        font-weight: bold;
        border-radius: 12px;
        border: none;
        padding: 14px 18px;
        width: 100%;
        box-sizing: border-box;
        font-size: 16px;
        transition: all 0.3s ease;
    }
    .input-gold:focus {
        outline: none;
        box-shadow: 0 0 15px rgba(242, 204, 125, 0.4);
    }

    /* Botão Salvar */
    .btn-save {
        background: linear-gradient(180deg, #f2cc7d 0%, #d4a74a 100%);
        color: #000;
        font-weight: 900;
        border: none;
        padding: 18px;
        border-radius: 15px;
        width: 100%;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-top: 20px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .btn-save:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(212, 167, 74, 0.4);
    }
</style>

<div class="premium-card">
    <div class="card-header">
        <h1>Editar Perfil</h1>
        <p>Atualize as informações de contato e localização do sistema.</p>
    </div>

    <form action="/backend/perfil/atualizar/<?php echo $perfil['id_perfil']; ?>" 
          method="post" 
          enctype="multipart/form-data">
        
        <div class="form-group">
            <label class="label-gray" for="telefone_perfil">Telefone de Contato</label>
            <input type="tel" 
                   id="telefone_perfil" 
                   name="telefone_perfil" 
                   class="input-gold"
                   placeholder="(00) 00000-0000"
                   value="<?php echo $perfil['telefone_perfil']; ?>" 
                   required>
        </div>

        <div class="form-group">
            <label class="label-gray" for="endereco_perfil">Endereço Completo</label>
            <input type="text" 
                   id="endereco_perfil" 
                   name="endereco_perfil" 
                   class="input-gold"
                   placeholder="Rua, Número, Bairro - Cidade"
                   value="<?php echo $perfil['endereco_perfil'];?>" 
                   required>
        </div>

        <div class="form-group">
            <label class="label-gray" for="data_cadastro">Data de Cadastro</label>
            <input type="date" 
                   id="data_cadastro" 
                   name="data_cadastro" 
                   class="input-gold"
                   value="<?php echo $perfil['data_cadastro']; ?>" 
                   required>
        </div>

        <button type="submit" class="btn-save">Salvar Alterações</button>
    </form>
</div>