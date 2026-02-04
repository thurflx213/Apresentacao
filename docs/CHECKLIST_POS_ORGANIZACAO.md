# Checklist pós-organização

## Verificações automáticas (OK)
- Não há referências antigas para `styles/`, `js/` ou `img/` em HTML da pasta `frontend/pages`.
- CSS com imagem ajustada para o novo caminho em `frontend/styles/shared/vitrine-camisetas.css`.
- `router.php` atualizado para servir `frontend/pages` e assets em `frontend`.

## Verificações manuais recomendadas
- Abrir a home e validar:
  - Logo, carrossel e mini-banners carregando.
  - Vitrine de produtos exibindo imagens.
- Abrir páginas internas:
  - `catalogo`, `carrinho`, `frete`, `fidelidade`, `duvidas`, `politica`, `sobre`, `Trocas`, `camisetas`.
- Validar carrinho:
  - Adicionar produto na home e conferir imagem no carrinho.
- Validar login e produto:
  - Logo e imagem de manutenção carregando.

## Observações
- `products-data.js` e renderizadores normalizam imagens com prefixo `img/` para `../img/`.
- Caso algum asset não carregue, confira o nome do arquivo na pasta `frontend/img`.
