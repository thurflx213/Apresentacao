<style>
    body {
        background: #000;
        font-family: Arial, sans-serif;
        margin: 0;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .navbar-fixa {
        position: fixed;
        top: 0;
        width: 100%;
        background-color: #000;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        border-bottom: 1px solid #1a1a1a;
    }

    .registro-card {
        max-width: 700px;
        margin: 130px auto;
        padding: 170px;
        background: #101010;
        border-radius: 12px;
        box-shadow: 0 0 25px rgba(255, 255, 0, 0.15);
        text-align: center;
    }

    .registro-card h2 {
        color: #C8AA62;
        margin-bottom: 35px;
        font-weight: bold;
        font-size: 26px;
        letter-spacing: 1px;
    }

    .input-group {
        position: relative;
        margin-bottom: 15px; /* Espaço entre os campos */
    }

    /* Estilo dos ícones dentro do input */
    .input-group i {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #C8AA62;
        font-size: 18px;
        z-index: 2;
    }

    .registro-card input {
        width: 100%;
        height: 60px !important;
        font-size: 16px !important;
        padding: 0 20px 0 55px !important; /* Padding esquerdo abre espaço para o ícone */
        background-color: #1a1a1a !important;
        border: 1px solid #333 !important;
        color: #fff !important;
        border-radius: 8px !important;
        box-sizing: border-box;
        transition: 0.3s;
    }

    /* Efeito de foco igual ao login */
    .registro-card input:focus {
        border-color: #C8AA62 !important;
        outline: none;
        box-shadow: 0 0 8px rgba(200, 170, 98, 0.2);
    }

    .btn-registrar-koketsu {
        width: 100%;
        height: 60px;
        font-size: 18px;
        font-weight: bold;
        background-color: #FFD700 !important;
        color: #000 !important;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.3s;
        margin-top: 20px;
        text-transform: uppercase;
    }

    .btn-registrar-koketsu:hover {
        background-color: #e6c200 !important;
        transform: translateY(-2px);
    }

    .registro-card p {
        color: #888;
        font-size: 14px;
        margin-top: 25px;
    }

    .registro-card a {
        color: #C8AA62;
        text-decoration: none;
        font-weight: bold;
        transition: 0.3s;
    }

    .registro-card a:hover {
        color: #FFD700;
    }
</style>

<div class="navbar-fixa">
    <a href="../../index.html">
        <img src="/img/logo.png" alt="Koketsu Logo" height="50px">
    </a>
</div>

<div class="registro-card">
    <h2>Criar Nova Conta</h2>

    <form action="/backend/register" method="POST">
        <div class="input-group">
            <i class="fa fa-user"></i>
            <input type="text" name="nome_usuarios" placeholder="Nome Completo" required>
        </div>

        <div class="input-group">
            <i class="fa fa-envelope"></i>
            <input type="email" name="email_usuarios" placeholder="Email" required>
        </div>

        <div class="input-group">
            <i class="fa fa-lock"></i>
            <input type="password" name="senha_usuarios" placeholder="Senha" required>
        </div>

        <div class="input-group">
            <i class="fa fa-lock"></i>
            <input type="password" name="senha_confirm" placeholder="Confirmar Senha" required>
        </div>

        <button type="submit" class="btn-registrar-koketsu">
            Registrar
        </button>
    </form>

    <p>Já tem uma conta? <a href="/backend/login">Faça o login aqui</a></p>
</div>