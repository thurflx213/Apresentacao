<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h1 class="h3 mb-4 text-primary">Login</h1>
                    <form action="/backend/login" method="POST" class="text-start">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-envelope-o"></i></span>
                                <input class="form-control" name="email_usuario" type="email" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Senha</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                <input class="form-control" name="senha_usuario" type="password" placeholder="Senha" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Entrar</button>
                    </form>
                    <a href="/backend/register" class="d-inline-block mt-3">Não tenho conta</a>
                </div>
            </div>
        </div>
    </div>
</div>
