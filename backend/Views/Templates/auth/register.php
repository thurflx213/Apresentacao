<div class="w3-bar w3-top w3-theme w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-black" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <div class="w3-bar" style="background-color:#000; height:80px; display:flex; align-items:center; justify-content:center;">
    <a href="../../index.html">
  <img src="/img/logo.png" alt="Koketsu Logo" height="80px" >
  </a>
  </div>
</div>

<div class="w3-container w3-padding-32 w3-center w3-container-full">
    <h2 style="color: var(--gold-base);">Criar Nova Conta</h2> 
    
    <form action="/backend/register" method="POST" class="w3-container w3-card-4 w3-margin form-card">
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user" style="color: var(--gold-base);"></i></div> 
            <div class="w3-rest">
                <input class="w3-input w3-border w3-input-dourado" name="nome_usuarios" type="text" placeholder="Nome Completo" required>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o" style="color: var(--gold-base);"></i></div> 
            <div class="w3-rest">
                <input class="w3-input w3-border w3-input-dourado" name="email_usuarios" type="email" placeholder="Email" required>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock" style="color: var(--gold-base);"></i></div> 
            <div class="w3-rest">
                <input class="w3-input w3-border w3-input-dourado" name="senha_usuarios" type="password" placeholder="Senha" required>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock" style="color: var(--gold-base);"></i></div> 
            <div class="w3-rest">
                <input class="w3-input w3-border w3-input-dourado" name="senha_confirm" type="password" placeholder="Confirmar Senha" required>
            </div>
        </div>
        
        <button class="w3-button w3-block w3-section w3-ripple w3-padding w3-text-dark-gold" style="background-color: var(--gold-light);">Registrar</button>
    </form>
    
    <div class="w3-container w3-center w3-text-white">
        <p>Já tem uma conta? <a href="/backend/login" style="color: var(--gold-base);">Faça o login aqui</a>.</p>
    </div>
</div>

<style>
/* 1. Cores Douradas (Harmonizado) */
:root {
    --gold-base: #C8AA62; /* Dourado Sutil para texto/borda principal */
    --gold-light: #FFD700; /* Amarelo Ouro para foco e botão */
    --dark-bg: #1a1a1a;
    --input-bg: #333;
}

/* 2. Classe para Controlar a Largura e Centralização do Formulário */
.form-card {
    max-width: 550px; /* Largura ajustada (aumentei um pouco) */
    margin: 50px auto 20px auto !important; /* Centraliza e adiciona margem superior/inferior */
    background-color: var(--dark-bg) !important;
}

/* 3. Estilo dos Campos de Input */
.w3-input-dourado {
    background-color: var(--input-bg) !important;
    color: white !important;
    /* Aplica a borda Dourada Sutil Fina */
    border: 1px solid var(--gold-base) !important; 
}

/* 4. Aplica o dourado ao focar (Focus State) */
.w3-input-dourado:focus {
    border-color: var(--gold-light) !important; /* Dourado mais claro para o foco */
    box-shadow: 0 0 5px var(--gold-light);
}

/* 5. Placeholder em dourado claro para visibilidade */
input::placeholder {
    color: #E6C98F !important; /* Dourado claro */
}

/* 6. Dourado escuro para o texto no botão amarelo/dourado */
.w3-text-dark-gold {
    color: #4B3728 !important; /* Marrom escuro/preto para contraste máximo */
}

/* 7. Ajuste para o contêiner principal */
.w3-container-full {
    min-height: 100vh; /* Garante que a tela preta preencha tudo */
    background-color: black;
}
</style>