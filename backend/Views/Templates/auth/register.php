<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - Koketsu Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&family=Outfit:wght@800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #050505;
            --card-bg: rgba(255, 255, 255, 0.03);
            --accent: #c5a02d;
            --accent-hover: #e0b840;
            --text-main: #ffffff;
            --text-muted: #888888;
            --border: rgba(197, 160, 45, 0.15);
        }

        body {
            background: var(--bg-dark);
            font-family: 'Inter', sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: var(--text-main);
            padding: 40px 20px;
            box-sizing: border-box;
        }

        body::before {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(197, 160, 45, 0.05) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
            z-index: -1;
        }

        .reg-wrapper {
            width: 100%;
            max-width: 500px;
            position: relative;
        }

        .logo-area {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-area img {
            height: 60px;
            filter: drop-shadow(0 0 10px rgba(197, 160, 45, 0.2));
        }

        .reg-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border);
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 40px 100px rgba(0,0,0,0.6);
        }

        .reg-card h1 {
            font-family: 'Outfit', sans-serif;
            color: var(--text-main);
            font-size: 1.8em;
            margin-bottom: 10px;
            font-weight: 800;
            letter-spacing: -1px;
            text-align: center;
        }

        .reg-card p.subtitle {
            color: var(--text-muted);
            font-size: 0.9em;
            margin-bottom: 30px;
            text-align: center;
        }

        .form-grid {
            display: grid;
            gap: 15px;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--accent);
            font-size: 1.1em;
            opacity: 0.6;
        }

        .form-group input {
            width: 100%;
            height: 52px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            padding: 0 20px 0 55px;
            color: #fff;
            font-size: 0.95em;
            transition: 0.3s;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: var(--accent);
            outline: none;
            background: rgba(var(--accent), 0.05);
        }

        .btn-submit {
            width: 100%;
            height: 56px;
            background: var(--accent);
            color: #000;
            border: none;
            border-radius: 12px;
            font-size: 1em;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 20px;
        }

        .btn-submit:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(197, 160, 45, 0.2);
        }

        .login-link {
            margin-top: 30px;
            text-align: center;
            font-size: 0.9em;
            color: var(--text-muted);
        }

        .login-link a {
            color: var(--accent);
            text-decoration: none;
            font-weight: 700;
        }

        .login-link a:hover {
            color: #fff;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.75em;
            color: var(--text-muted);
            letter-spacing: 1px;
            text-transform: uppercase;
            opacity: 0.6;
        }
    </style>
</head>
<body>
    <div class="reg-wrapper">
        <div class="logo-area">
            <a href="/"><img src="/img/logo.png" alt="Koketsu Logo"></a>
        </div>

        <div class="reg-card">
            <h1>Criar nova conta</h1>
            <p class="subtitle">Junte-se à excelência da Koketsu Store</p>

            <form action="/backend/register" method="POST">
                <div class="form-grid">
                    <div class="form-group">
                        <i class="fa fa-user"></i>
                        <input type="text" name="nome_usuarios" placeholder="Nome Completo" required>
                    </div>

                    <div class="form-group">
                        <i class="fa fa-envelope"></i>
                        <input type="email" name="email_usuarios" placeholder="Seu melhor email" required>
                    </div>

                    <div class="form-group">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="senha_usuarios" placeholder="Crie uma senha forte" required>
                    </div>

                    <div class="form-group">
                        <i class="fa fa-shield-halved"></i>
                        <input type="password" name="senha_confirm" placeholder="Confirme sua senha" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">Finalizar Registro</button>
            </form>

            <div class="login-link">
                Já possui uma conta? <a href="/backend/login">Faça o login aqui</a>
            </div>
        </div>

        <div class="footer">
            &copy; <?= date('Y') ?> Koketsu Store • Excellence in Performance
        </div>
    </div>
</body>
</html>
