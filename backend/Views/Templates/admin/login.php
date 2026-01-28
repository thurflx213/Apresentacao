<style>
    body {
        background: #0f0f0f;
        font-family: Arial, sans-serif;
    }

    .login-card {
        max-width: 700px;
        margin: 130px auto;
        padding: 170px;
        background: #101010;
        border-radius: 12px;
        box-shadow: 0 0 25px rgba(255, 255, 0, 0.15);
        text-align: center;
    }

    .login-card h1 {
        color: #C8AA62;
        margin-bottom: 25px;
        font-weight: bold;
    }

    .login-card input {
    height: 55px !important;     /* aumenta os campos */
    font-size: 18px !important;  /* texto maior */
    padding: 10px 15px !important;
}

.login-card button {
    height: 55px !important;
    font-size: 20px !important;
    font-weight: bold !important;
    border-radius: 10px !important;
}

    .login-card a {
        color: #f1c40f;
        text-decoration: none;
        font-size: 14px;
    }

    input[type="text"], 
    input[type="password"] {
    height: 60px;              
    font-size: 20px;           
    padding: 10px 15px;        
    border-radius: 10px;       
}
.btn-login {
    width: 100%;               
    height: 55px;             
    font-size: 20px;          
    font-weight: bold;
    border-radius: 10px;
}
.w3-button {
    height: 55px;
    font-size: 20px;
    padding: 12px 0;
    border-radius: 10px;
}


</style>
<div class="w3-bar w3-top w3-theme w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-black" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <div class="w3-bar" style="background-color:#000; height:80px; display:flex; align-items:center; justify-content:center;">
    <a href="../../index.html">
  <img src="/img/logo.png" alt="Koketsu Logo" height="80px" >
  </a>
  </div>
</div>

<div class="login-card">
    <h1>Login-Admin</h1>

    <form action="/backend/adminlogin" method="POST">

        <div class="w3-section">
            <input class="w3-input w3-border w3-round-large" 
                   type="email" 
                   name="email_usuarios" 
                   placeholder="Email"
                   required>
        </div>

        <div class="w3-section">
            <input class="w3-input w3-border w3-round-large" 
                   type="password" 
                   name="senha_usuarios" 
                   placeholder="Senha"
                   required>
        </div>

        <button class="w3-button w3-yellow w3-round-large w3-margin-top" 
                style="width:100%; font-weight:bold;">
            Entrar
        </button>
    </form>

   
</div>
