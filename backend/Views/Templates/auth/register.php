<div class="w3-container w3-padding-32 w3-center" style="background-color: black; color: white;">
    <h2 style="color: var(--gold-base);">Criar Nova Conta</h2> 
    
    <form action="/backend/register" method="POST" class="w3-container w3-card-4 w3-margin" style="background-color: #1a1a1a; color: white;">
    
    
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user" style="color: var(--gold-base);"></i></div> 
            <div class="w3-rest">
                <input class="w3-input w3-border" style="background-color: #333; color: white; border-color: #555;" name="nome_usuarios" type="text" placeholder="Nome Completo" required>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-envelope-o" style="color: var(--gold-base);"></i></div> 
            <div class="w3-rest">
                <input class="w3-input w3-border" style="background-color: #333; color: white; border-color: #555;" name="email_usuarios" type="email" placeholder="Email" required>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock" style="color: var(--gold-base);"></i></div> 
            <div class="w3-rest">
                <input class="w3-input w3-border" style="background-color: #333; color: white; border-color: #555;" name="senha_usuarios" type="password" placeholder="Senha" required>
            </div>
        </div>
        
        <div class="w3-row w3-section">
            <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-lock" style="color: var(--gold-base);"></i></div> 
            <div class="w3-rest">
                <input class="w3-input w3-border" style="background-color: #333; color: white; border-color: #555;" name="senha_confirm" type="password" placeholder="Confirmar Senha" required>
            </div>
        </div>
        
        <button class="w3-button w3-block w3-section w3-ripple w3-padding w3-text-dark-gold" style="background-color: var(--gold-light);">Registrar</button>
    </form>
    
    <div class="w3-container w3-center w3-text-white">
        <p>Já tem uma conta? <a href="/backend/login" style="color: var(--gold-base);">Faça o login aqui</a>.</p>
    </div>
</div>

<style>
/* 1. Cor Dourada Principal para texto, ícones e bordas (Um tom mais quente) */
:root {
    --gold-base: #C8AA62;
    --gold-light: #FFD700;
}

/* 2. Aplica o dourado ao focar (Focus State) */
.w3-input:focus {
    border-color: var(--gold-light) !important; /* Dourado mais claro para o foco */
    box-shadow: 0 0 5px var(--gold-light);
}

/* 3. Placeholder em dourado claro para visibilidade */
input::placeholder {
  color: #E6C98F; /* Dourado claro */
}

/* 4. Dourado escuro para o texto no botão amarelo/dourado */
.w3-text-dark-gold {
    color: #4B3728; /* Marrom escuro/preto para contraste máximo */
}

</style>