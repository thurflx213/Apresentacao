<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- W3CSS -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Seu CSS -->
    <link rel="stylesheet" href="/public/css/login.css">

</head>

<body>
<style>
/* 1. Cores Douradas (Harmonizando com o Cadastro) */
:root {
    /* Dourado/Amarelo Ouro - Usado para texto, ícones, borda e botão */
    --gold-base: #FFD700; 
    /* Dourado/Amarelo mais claro para o efeito de foco e placeholder */
    --gold-light: #fce200; 
    /* Cor de fundo para o cartão de Login */
    --card-bg: #111;
    /* Cor de fundo para os inputs (um pouco mais clara que o cartão) */
    --input-bg: #1c1c1c; 
}

/* Base da página */
body {
    background-color: #000000;
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Card Principal (Fundo escuro/preto) */
.login-card {
 background: #111;
 padding: 40px;
 border-radius: 12px;
 width: 350px; 
 color: #fff;
 text-align: center;
}

/* Título (Em Dourado/Amarelo Forte) */
.login-title {
    margin-bottom: 25px;
    font-size: 28px;
    font-weight: bold;
    color: var(--gold-base); 
}

.input-group {
    position: relative;
    margin-bottom: 20px;
}

/* Ícone (Em Dourado/Amarelo Forte) */
.input-group .icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gold-base); 
    font-size: 18px; /* Ajuste o tamanho do ícone */
}

/* Input Styles */
.input-group input {
    width: 100%;
    padding: 12px 12px 12px 40px;
    
    /* Borda Dourada Fina e Fundo Mais Escuro */
    border: 1px solid var(--gold-base); 
    border-radius: 6px;
    background: var(--input-bg);
    color: white;
    transition: border-color 0.3s, box-shadow 0.3s;
}

/* Placeholder (Texto "Email", "Senha" em Dourado Claro) */
.input-group input::placeholder {
  color: var(--gold-light);
  opacity: 0.8; 
}

/* Efeito de FOCO (Borda Brilhante no Click) */
.input-group input:focus {
    outline: none;
    border-color: var(--gold-light);
    box-shadow: 0 0 8px rgba(255, 215, 0, 0.6); /* Brilho dourado */
}

/* Botão Entrar (Fundo Dourado/Amarelo Forte, Texto Preto) */
.login-btn {
    width: 100%;
    padding: 14px; /* Aumentei o padding para um botão mais robusto */
    background: var(--gold-base);
    color: black; /* Texto em preto para contraste */
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    font-size: 16px;
    margin-top: 15px;
    transition: background 0.3s;
}

.login-btn:hover {
    background: var(--gold-light); 
}

/* Link "Não tenho conta" (Em Dourado) */
.register-link {
    display: block;
    margin-top: 15px;
    color: white;
    text-decoration: none;
    font-size: 14px;
}

.register-link:hover {
    text-decoration: underline;
}
</style>
<div class="login-container">
    <div class="login-card">
        
        <h1 class="login-title">Login</h1>

        <form action="/backend/login" method="POST">

            <div class="input-group">
                <i class="fa fa-envelope icon"></i>
                <input type="email" name="email_usuarios" placeholder="Email" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock icon"></i>
                <input type="password" name="senha_usuarios" placeholder="Senha" required>
            </div>

            <button type="submit" class="login-btn">Entrar</button>
            

        </form>
            <a href="/backend/register" class="register-link">Não tenho conta</a>

        

    </div>
</div>

</body>
</html>
