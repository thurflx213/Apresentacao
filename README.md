# Koketsu - Projeto Unificado

Este é o projeto unificado que combina as funcionalidades dos projetos ApresentacaoArthur e ApresentacaoGregory.

## 📋 Sobre o Projeto

Sistema de e-commerce para a Koketsu Grife, desenvolvido em PHP com arquitetura MVC.

## 🚀 Funcionalidades

### Do Projeto Arthur
- ✅ Gerenciamento completo de **Usuários**
- ✅ Sistema de **Categorias**
- ✅ Gerenciamento de **Cores**
- ✅ Sistema de **Perfis** de usuário
- ✅ Gerenciamento de **Tamanhos**
- ✅ Sistema de **Avaliações**
- ✅ **Carrinho** de compras
- ✅ Controle de **Estoque e Movimentação**
- ✅ Gerenciamento de **Imagens**
- ✅ Sistema completo de **Produtos** com múltiplas funcionalidades
- ✅ Sistema de **Pedidos** e **Itens de Pedidos**
- ✅ Dashboard administrativo

### Do Projeto Gregory
- ✅ Sistema de **Contato** (formulário de newsletter)
- ✅ **Relatórios** avançados com gráficos e estatísticas:
  - Vendas mensais
  - Status de pedidos
  - Top 5 produtos mais vendidos
  - Faturamento por categoria
  - Ticket médio mensal
  - Produtos por categoria
- ✅ Página de **Login** estilizada
- ✅ API pública com vitrine de produtos

## 📁 Estrutura do Projeto

```
ProjetoUnificado/
├── backend/
│   ├── Controles/          # Controllers
│   │   ├── Admin/          # Controllers administrativos
│   │   ├── ContatoController.php        # [Gregory]
│   │   ├── RelatoriosController.php     # [Gregory]
│   │   ├── CategoriasController.php     # [Arthur]
│   │   ├── CoresController.php          # [Arthur]
│   │   ├── PerfilController.php         # [Arthur]
│   │   ├── TamanhoController.php        # [Arthur]
│   │   └── ... (outros controllers)
│   ├── Models/             # Modelos de dados
│   │   ├── Contato.php                  # [Gregory]
│   │   ├── Categoria.php                # [Arthur]
│   │   ├── Cor.php                      # [Arthur]
│   │   ├── Perfil.php                   # [Arthur]
│   │   ├── Tamanho.php                  # [Arthur]
│   │   └── ... (outros models)
│   ├── Core/               # Classes do núcleo
│   ├── Database/           # Configuração do banco
│   ├── Rotas/              # Sistema de rotas
│   ├── Views/              # Templates PHP
│   │   └── Templates/
│   │       ├── relatorios/ # [Gregory]
│   │       └── ... (outras views)
│   └── Validadores/        # Validações
├── img/                    # Imagens
├── js/                     # JavaScript
├── vendor/                 # Dependências Composer
├── index.html              # Página inicial
├── login.html              # Página de login [Gregory]
├── produto.html            # Página de produtos
├── carrinho.html           # Página do carrinho
└── ... (outros arquivos HTML/CSS)
```

## 🔗 Rotas Principais

### Usuários
- GET `/usuarios` - Listar usuários
- GET `/usuario/criar` - Formulário criar usuário
- POST `/usuario/salvar` - Salvar novo usuário

### Produtos
- GET `/produtos/listar` - Listar produtos
- GET `/produtos/criar` - Formulário criar produto
- POST `/produtos/salvar` - Salvar novo produto
- GET `/api/produtos` - API pública de produtos
- GET `/api/vitrine` - API de vitrine formatada

### Pedidos
- GET `/pedido/listar` - Listar pedidos
- GET `/pedido/criar` - Formulário criar pedido
- POST `/pedido/salvar` - Salvar novo pedido
- GET `/api/pedidos` - API pública de pedidos

### Categorias (Arthur)
- GET `/categorias` - Listar categorias
- POST `/categoria/salvar` - Salvar categoria

### Cores (Arthur)
- GET `/cores` - Listar cores
- POST `/cor/salvar` - Salvar cor

### Perfis (Arthur)
- GET `/perfis` - Listar perfis
- POST `/perfil/salvar` - Salvar perfil

### Tamanhos (Arthur)
- GET `/tamanhos` - Listar tamanhos
- POST `/tamanho/salvar` - Salvar tamanho

### Relatórios (Gregory)
- GET `/relatorios` - Dashboard de relatórios com gráficos

### Contato (Gregory)
- POST `/contato/salvar` - Salvar novo contato da newsletter

### Autenticação
- GET `/login` - Página de login
- POST `/login` - Autenticar usuário
- GET `/register` - Página de registro
- POST `/register` - Cadastrar usuário
- GET `/logout` - Sair do sistema

### Admin
- GET `/admin/dashboard` - Dashboard administrativo

## 🛠️ Tecnologias Utilizadas

- **PHP 7.4+** - Backend
- **MySQL/MariaDB** - Banco de dados
- **Bootstrap 5** - Framework CSS
- **JavaScript** - Interatividade frontend
- **Composer** - Gerenciador de dependências
- **PHPMailer** - Envio de emails
- **Bramus Router** - Sistema de rotas

## 📦 Dependências

```json
{
  "require": {
    "bramus/router": "^1.6",
    "phpmailer/phpmailer": "^6.8"
  }
}
```

## ⚙️ Instalação

1. Clone o repositório ou copie os arquivos
2. Configure o banco de dados em `backend/Database/Config.php`
3. Instale as dependências:
   ```bash
   composer install
   ```
4. Configure as credenciais de email em `backend/Config/Mail.php`
5. Importe o banco de dados (estrutura SQL necessária)
6. Acesse via servidor web (Apache/Nginx) ou use o servidor embutido do PHP:
   ```bash
   php -S localhost:8000
   ```

## 📊 Funcionalidades Especiais

### Sistema de Relatórios
O sistema possui um dashboard completo de relatórios que inclui:
- Gráfico de vendas mensais
- Distribuição de status de pedidos
- Ranking dos produtos mais vendidos
- Faturamento por categoria
- Análise de ticket médio
- Distribuição de produtos por categoria

### Sistema de Contato
Permite que visitantes se inscrevam para receber novidades, com:
- Validação de email
- Verificação de duplicatas
- Notificação por email
- Armazenamento no banco de dados

## 🤝 Contribuidores

- **Arthur** - Desenvolvimento do sistema base com todas as entidades
- **Gregory** - Sistema de relatórios e contato

## 📝 Notas

Este projeto unifica as melhores funcionalidades de ambos os projetos originais, mantendo compatibilidade com as rotas e estruturas existentes.

### Diferenças Principais entre os Projetos Originais:

**ApresentacaoArthur:**
- Sistema mais completo com mais entidades (Cores, Perfis, Tamanhos, etc.)
- Gerenciamento de estoque e movimentações
- Sistema de avaliações
- Carrinho de compras completo

**ApresentacaoGregory:**
- Foco em relatórios e análises
- Sistema de contato/newsletter
- Interface de login mais elaborada
- API de vitrine pública

O projeto unificado mantém TODAS essas funcionalidades disponíveis.
