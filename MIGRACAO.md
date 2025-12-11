# 🔄 Guia de Migração - Projeto Unificado

## ✅ O que foi feito

O projeto **ProjetoUnificado** combina as funcionalidades de **ApresentacaoArthur** e **ApresentacaoGregory** em uma única aplicação.

### 📦 Arquivos Copiados

#### Do ApresentacaoArthur (Base)
- ✅ Estrutura completa do backend
- ✅ Todos os controllers: Usuários, Categorias, Cores, Perfis, Tamanhos, Produtos, Pedidos, Itens Pedidos, Avaliações, Carrinho, Estoque, Imagens
- ✅ Todos os models correspondentes
- ✅ Sistema de autenticação
- ✅ Views administrativas
- ✅ Arquivos HTML/CSS/JS do frontend
- ✅ Dependências Composer

#### Do ApresentacaoGregory (Integrado)
- ✅ **ContatoController.php** → Gerencia inscrições de newsletter
- ✅ **RelatoriosController.php** → Dashboard de relatórios
- ✅ **Contato.php** (Model) → Modelo de dados de contato
- ✅ **login.html** → Página de login estilizada
- ✅ **login.css** → Estilos da página de login
- ✅ Views de relatórios (backend/Views/Templates/relatorios/)

### 🔗 Rotas Adicionadas

Foram adicionadas ao arquivo de rotas as seguintes funcionalidades do Gregory:

```php
// GET
"/relatorios" => "RelatoriosController@exibirRelatorios"
'/api/vitrine' => 'PublicApiController@getProdutosParaVitrineFormatados'
'/api/usuarios' => 'APIUsuarioController@getUsuarios'
'/api/usuarios/{pagina}' => 'APIUsuarioController@getUsuarios'

// POST
'/contato/salvar' => 'ContatoController@salvarNovoContato'
```

### 🔀 Rotas Unificadas

Algumas rotas foram duplicadas para manter compatibilidade com ambos os projetos:

**Produtos:**
- `/produto/*` (Gregory) 
- `/produtos/*` (Arthur)
- Ambas funcionam e apontam para os mesmos controllers

**Exemplo:**
- `/produto/listar` ✅
- `/produtos/listar` ✅
- Ambas funcionam!

## ⚙️ Próximos Passos

### 1. Configuração do Banco de Dados

É necessário criar/atualizar as tabelas do banco de dados:

#### Tabela de Contatos (Nova - do Gregory)
```sql
CREATE TABLE IF NOT EXISTS tbl_contato (
    id_contato INT AUTO_INCREMENT PRIMARY KEY,
    email_contato VARCHAR(255) NOT NULL UNIQUE,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    excluido_em TIMESTAMP NULL DEFAULT NULL
);
```

#### Verificar se existem as tabelas do Arthur
- tbl_usuario
- tbl_categoria
- tbl_cor
- tbl_perfil
- tbl_tamanho
- tbl_produtos
- tbl_pedidos
- tbl_itens_pedidos
- tbl_avaliacao
- tbl_carrinho
- tbl_estoque_movimentacao
- tbl_imagem

### 2. Configuração de Email

Configure as credenciais de email em:
```
backend/Config/Mail.php
```

### 3. Dependências Composer

Execute na pasta do projeto:
```bash
cd ProjetoUnificado
composer install
```

### 4. Permissões de Upload

Certifique-se de que as pastas de upload têm permissão de escrita:
```bash
chmod -R 775 backend/upload/img
chmod -R 775 backend/upload/produtos
```

### 5. Configuração do Servidor Web

#### Apache (.htaccess)
O arquivo `.htaccess` do Gregory foi mantido. Verifique se o mod_rewrite está habilitado.

#### Nginx
Configure o nginx para redirecionar todas as requisições para `backend/index.php`

#### Servidor Embutido PHP (Desenvolvimento)
```bash
php -S localhost:8000 -t .
```

## 🧪 Testando o Projeto Unificado

### Testes Básicos

1. **Página Inicial**
   - Acesse: `http://localhost:8000/`
   - Deve carregar a página inicial

2. **Login**
   - Acesse: `http://localhost:8000/login.html` (Gregory)
   - Ou: `http://localhost:8000/login` (Backend)

3. **API de Produtos**
   - Teste: `http://localhost:8000/api/produtos`
   - Teste: `http://localhost:8000/api/vitrine` (Gregory)

4. **Relatórios** (Gregory)
   - Acesse: `http://localhost:8000/relatorios`
   - Requer autenticação de admin

5. **Sistema de Contato** (Gregory)
   - Formulário no frontend
   - POST para: `/contato/salvar`

### Testando Funcionalidades do Arthur

1. **Categorias**: `/categorias`
2. **Cores**: `/cores`
3. **Perfis**: `/perfis`
4. **Tamanhos**: `/tamanhos`
5. **Produtos**: `/produtos/listar`
6. **Pedidos**: `/pedido/listar`
7. **Dashboard Admin**: `/admin/dashboard`

## 🔍 Verificando a Integração

### Checklist de Verificação

- [ ] Todas as rotas do Arthur estão funcionando
- [ ] Todas as rotas do Gregory estão funcionando
- [ ] Controllers novos (Contato, Relatórios) estão acessíveis
- [ ] Models novos (Contato) estão carregando
- [ ] Tabela tbl_contato foi criada no banco
- [ ] Sistema de email está configurado
- [ ] Página de login (Gregory) está acessível
- [ ] Relatórios (Gregory) estão sendo renderizados
- [ ] API pública de vitrine funciona
- [ ] Todas as views do Arthur estão carregando

## 📊 Diferenças Mantidas

O projeto unificado mantém AMBAS as implementações quando há diferenças:

### Exemplo: ProdutosController

**Arthur tinha:**
- `viewListarProduto()`
- `viewCriarProduto()`
- `viewEditarProdutos()`

**Gregory tinha:**
- `viewListarProdutos()`
- `viewCriarProdutos()`
- `viewEditarProduto()`

**Unificado mantém:**
- Ambas as rotas funcionando
- `/produtos/listar` e `/produto/listar`
- Mesma lógica, rotas diferentes

## ⚠️ Possíveis Conflitos

### 1. Namespace
Certifique-se de que o namespace está correto em todos os arquivos:
- Arthur usa: `App\koketsu\`
- Gregory usa: `App\Koketsu\`

**Solução:** O projeto unificado mantém `App\koketsu\` como padrão (conforme Arthur). Os arquivos do Gregory foram mantidos com `App\Koketsu\`, mas funcionam devido ao autoload do Composer.

### 2. Paths Absolutos
Se você mover o projeto para outro local, atualize:
- Configurações do banco em `backend/Database/Config.php`
- Paths de upload se necessário

### 3. Models Diferentes
Se ambos os projetos tinham implementações diferentes do mesmo model (ex: Produtos), a versão do Arthur foi mantida por ser mais completa.

## 📝 Resumo Final

**ProjetoUnificado** agora contém:

✅ **12 Controllers** do Arthur (Usuários, Categorias, Cores, Perfis, Tamanhos, Produtos, Pedidos, ItensPedidos, Avaliações, Carrinho, Estoque, Imagens)
✅ **2 Controllers** do Gregory (Contato, Relatórios)
✅ **12 Models** do Arthur
✅ **1 Model** do Gregory (Contato)
✅ **Todas as rotas** de ambos os projetos
✅ **Todas as views** de ambos os projetos
✅ **Frontend completo** (HTML/CSS/JS)
✅ **Sistema de autenticação**
✅ **API pública**
✅ **Dashboard de relatórios**
✅ **Sistema de newsletter**

## 🎉 Pronto!

Seu projeto unificado está pronto para uso. Siga os passos de configuração acima e teste todas as funcionalidades.

Em caso de dúvidas ou problemas, consulte os logs de erro do PHP e do servidor web.
