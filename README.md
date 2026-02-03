# Koketsu Shop

Este é um projeto de e-commerce de roupas desenvolvido em PHP com uma arquitetura MVC personalizada. O projeto inclui funcionalidades de gestão de usuários, produtos, pedidos, categorias, e relatórios, com áreas distintas para clientes e administradores.

## 📋 Requisitos

- **PHP**: 7.4 ou superior
- **Composer**: Gerenciador de dependências PHP
- **MySQL**: Banco de dados
- **Node.js & NPM**: Para gerenciamento de dependências de frontend (opcional, dependendo do uso)

## 🚀 Como Executar

1.  **Instalar Dependências PHP**:
    Execute o comando na raiz do projeto:
    ```bash
    composer install
    ```

2.  **Configurar Banco de Dados**:
    -   Crie um banco de dados MySQL chamado `koketsu`.
    -   Importe o esquema do banco de dados (caso disponivel).
    -   Verifique as credenciais em `backend/Database/Config.php`.

3.  **Iniciar o Servidor**:
    Você pode usar o script configurado no `package.json` ou rodar o servidor embutido do PHP:
    ```bash
    php -S localhost:8000 -t .
    ```
    Ou se preferir o comando npm:
    ```bash
    npm run dev
    ```

4.  **Acessar**:
    -   Frontend/Estático: `http://localhost:8000`
    -   Backend/Admin: `http://localhost:8000/backend/index.php` (dependendo da rota configurada)

## 📂 Estrutura do Projeto

A estrutura de pastas principal é organizada da seguinte forma:

```
ApresentacaoArthur/
├── backend/                  # Núcleo da aplicação PHP (MVC)
│   ├── Config/               # Configurações de e-mail, upload, etc.
│   ├── Controles/            # Controllers (Lógica de negócios e fluxo)
│   ├── Core/                 # Componentes centrais (Router, View, Session)
│   ├── Database/             # Conexão com banco e configuração DB
│   ├── Models/               # Modelos de dados (Acesso ao DB)
│   ├── Rotas/                # Definição das rotas da aplicação
│   ├── Validadores/          # Classes de validação de dados
│   ├── Views/                # Templates e visualização (HTML/PHP)
│   └── index.php             # Ponto de entrada (Entry Point) da aplicação
├── css/                      # Estilos globais (se houver, ou na raiz)
├── img/                      # Imagens do projeto
├── js/                       # Scripts JavaScript frontend
├── vendor/                   # Dependências do Composer
├── node_modules/             # Dependências do NPM
├── index.html                # Página inicial (versão estática/frontend)
└── ...                       # Outros arquivos HTML/CSS estáticos na raiz
```

## 🛠 Tecnologias Utilizadas

-   **Backend**: PHP (MVC Customizado)
-   **Roteamento**: `bramus/router`
-   **Banco de Dados**: MySQL (via PDO)
-   **Frontend**: HTML5, CSS3, JavaScript (Vanilla), Bootstrap (via npm)

## 💡 Fluxo da Informação

1.  **Requisição**: O servidor recebe a requisição em `backend/index.php`.
2.  **Roteamento**: O `Bramus\Router` analisa a URL com base nas regras em `backend/Rotas/Rotas.php`.
3.  **Controller**: A rota aciona um método em um Controller específico (ex: `UsuarioController`).
4.  **Model**: O Controller interage com o Model (ex: `Usuario`) para buscar ou salvar dados no banco.
5.  **View**: O Controller passa os dados para a classe `View`, que renderiza o template correspondente em `backend/Views`.
