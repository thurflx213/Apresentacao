# Tarefa: Tornar a Página de Configurações Totalmente Funcional

O objetivo é transformar a página de configurações (`configuracoes/index.php`), que atualmente é apenas visual, em uma interface funcional conectada ao banco de dados.

## 1. Banco de Dados (Database)

Precisamos armazenar as preferências do usuário (tamanhos, notificações) que hoje não existem no banco.

- [ ] **Criar Tabela `tbl_preferencias`**
    - `id_preferencia` (INT, PK, AUTO_INCREMENT)
    - `id_usuario` (INT, FK -> tbl_usuarios)
    - `tamanho_camiseta` (VARCHAR 5)
    - `tamanho_calca` (VARCHAR 5)
    - `tamanho_calcado` (VARCHAR 5)
    - `notif_pedidos` (BOOLEAN, Default 1)
    - `notif_ofertas` (BOOLEAN, Default 1)
    - `notif_whatsapp` (BOOLEAN, Default 0)
    - `dois_fatores_ativo` (BOOLEAN, Default 0)

## 2. Backend (Models)

- [ ] **Criar Model `Preferencias.php`**
    - Método `buscarPorUsuario($id_usuario)`: Retorna as configurações salvas.
    - Método `salvarOuAtualizar($id_usuario, $dados)`: Cria ou atualiza o registro.

- [ ] **Atualizar Model `Usuario.php`**
    - Verificar método de `exclusão` (já existente: `deletarUsuario` faz soft delete). Certificar que funciona para o contexto de "Excluir Minha Conta".

## 3. Backend (Controllers)

- [ ] **Atualizar `ConfiguracoesController.php`**
    - **Método `index()`**:
        - Além de carregar a view, deve buscar as preferências do usuário logado via `PreferenciasModel`.
        - Passar esses dados para a View para preencher os inputs (ex: selecionar o tamanho correto no `<select>`).
    
    - **Método `salvar()` (Novo)**:
        - Rota POST para receber JSON com os novos dados (tamanhos, toggles de notificação).
        - Validar e chamar `PreferenciasModel->salvarOuAtualizar`.
        - Resposta JSON `{success: true}` para feedback no frontend.

    - **Método `exportarDados()` (Novo - LGPD)**:
        - Buscar todos os dados do usuário (User, Perfil, Pedidos, Preferências).
        - Montar um JSON ou TXT.
        - Forçar download do arquivo (`header('Content-Type: application/json')`).

    - **Método `excluirConta()` (Novo)**:
        - Chamar `UsuarioModel->deletarUsuario($id)`.
        - Destruir a sessão (`session_destroy`).
        - Redirecionar para login com mensagem de "Conta encerrada".

## 4. Frontend (Views & JS)

- [ ] **Atualizar `configuracoes/index.php`**
    - **Preenchimento de Dados**: Usar PHP para marcar `selected` nos `<select>` e `checked` nos checkboxes baseados no banco.
    - **JavaScript (AJAX)**:
        - Criar função `salvarPreferencias()` que é chamada no `onchange` dos inputs.
        - Enviar `fetch` para a rota de salvar.
        - Mostrar feedback visual (ex: "Salvo!" ou ícone de check).
    - **Botões de Ação**:
        - Link "Solicitar Meus Dados": Apontar para rota de exportação.
        - Link "Excluir Conta": Adicionar `confirm()` real e redirecionar para rota de exclusão.
    - **Estilo**: Garantir que o feedback de "salvando..." combine com o tema Luxury.

## 5. Funcionalidades Extras (Placeholder vs Real)

- [ ] **2FA (Dois Fatores)**:
    - *Inicial*: Apenas salvar o status "Ativo/Inativo" no banco.
    - *Futuro*: Implementar lógica de login com código. Por enquanto, a flag no banco apenas indica a intenção.
- [ ] **Alterar Senha**:
    - Verificar se o link redireciona para a página de perfil correta que possui a troca de senha.

---

### Resumo do Fluxo de Trabalho

1.  Criar tabela no banco (via comando SQL ou script PHP).
2.  Criar o Model `Preferencias`.
3.  Implementar lógica no `ConfiguracoesController`.
4.  Conectar a View `index.php` ao Controller via JS.
