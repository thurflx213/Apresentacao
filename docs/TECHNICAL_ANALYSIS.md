# Análise Técnica do Projeto Apresentacao

Este documento apresenta uma análise técnica da estrutura, qualidade de código e sugestões de melhoria para o projeto "Apresentacao".

## 1. Visão Geral da Arquitetura

O projeto é híbrido, consistindo em:
1.  **Frontend Web (Storefront):** Páginas HTML servidas via PHP (`php -S localhost:4000`), consumindo dados de uma API interna (`api-vitrine.php`) e renderizando via JavaScript (`script.js`). Utiliza Bootstrap para UI.
2.  **Backend (API & Admin):** Uma estrutura MVC customizada em PHP localizada na pasta `backend/`. Gerencia usuários, produtos, pedidos e autenticação.
3.  **App Desktop (Koketsu):** Um wrapper Electron localizado em `koketsu/` para encapsular a aplicação (provavelmente a área administrativa ou versão kiosk) usando Vite e Electron Forge.

## 2. Pontos Críticos e Problemas Identificados

### 2.1. Segurança
-   **CORS Permissivo:** O arquivo `api-vitrine.php` define `header('Access-Control-Allow-Origin: *');`. Isso permite que qualquer domínio faça requisições para sua API, o que pode não ser desejado.
-   **Validação de Entrada:** Embora o uso de PDO no `Database.php` ajude contra SQL Injection, é crucial garantir que todos os inputs nos Controllers (em `backend/Controles/`) usem *prepared statements* corretamente.
-   **Exposição de Arquivos:** Arquivos sensíveis como `.env` (se existir) ou arquivos de configuração dentro de `backend/Config/` podem estar acessíveis se o servidor web não estiver configurado corretamente (o `.htaccess` na raiz do backend ajuda, mas a raiz do projeto parece pública).

### 2.2. Manutenibilidade e Código
-   **Lógica de Negócio Dispersa:**
    -   O arquivo `api-vitrine.php` mistura responsabilidades: conexão com banco, manipulação de strings (limpeza de caminhos de imagem), lógica de categorização (mapeamento hardcoded de 'Bermudas' para 'Camisas') e resposta HTTP. Essa lógica deveria residir em um Controller ou Service dentro de `backend/`.
    -   O frontend (`script.js`) possui um *fallback* hardcoded (`produtosArrayLocal`) com dados de produtos. Isso gera duplicação de dados e risco de inconsistência se a API falhar.
-   **Hardcoding:**
    -   Categorias e suas ordens estão fixas no código PHP (`$ordem_categorias`, `$mapa_categorias`). Mudanças exigem deploy de código ao invés de alteração no banco.
    -   Caminhos de imagem são manipulados com `str_replace` e regex para corrigir caminhos absolutos/relativos, o que indica que os dados no banco podem estar inconsistentes ou salvos com caminhos absolutos do sistema de arquivos.

### 2.3. Estrutura de Arquivos
-   A raiz do projeto está poluída com muitos arquivos HTML soltos (`Trocas.html`, `camisetas.html`, etc.) misturados com scripts backend (`api-vitrine.php`) e assets.
-   A dependência entre a raiz e `backend/` via composer (`require_once __DIR__ . '/vendor/autoload.php'`) é correta, mas a organização visual dificulta entender o que é público e o que é privado.

## 3. Sugestões de Correção e Melhoria

### Curto Prazo (Correções Imediatas)
1.  **Refatorar `api-vitrine.php`:** Mover a lógica de formatação e busca para um Controller dedicado (ex: `PublicApiController.php` no backend) e fazer o arquivo raiz apenas instanciar esse controller.
2.  **Centralizar Dados:** Remover o array hardcoded gigante do `script.js` ou mantê-lo em um arquivo JSON separado carregado apenas em caso de erro, para limpar o código principal.
3.  **Padronizar Imagens:** Criar um *Helper* ou *Accessor* no Model de Produtos para tratar a URL da imagem de forma consistente, removendo a lógica de `str_replace` do controlador/view.

### Médio Prazo (Melhorias Arquiteturais)
1.  **Rotas Unificadas:** Configurar o servidor web (Apache/Nginx ou router PHP) para direcionar todo o tráfego para `index.php` (Router), eliminando pontos de entrada soltos como `api-vitrine.php`.
2.  **Organização de Pastas:**
    -   Mover arquivos HTML/PHP públicos para uma pasta `public/`.
    -   Manter `backend/` e `koketsu/` fora da raiz pública do servidor web.
3.  **Segurança no Electron:** Garantir que o `nodeIntegration` esteja desabilitado e usar `contextBridge` para comunicação segura entre o renderizador e o processo principal no app `koketsu`.

## 4. Conclusão
O projeto possui uma base funcional com separação MVC no backend, mas sofre com mistura de responsabilidades na camada de "vitrine" pública. A consolidação da lógica de negócios dentro da estrutura `backend/` e a limpeza da raiz do projeto trarão grandes benefícios de manutenção.
