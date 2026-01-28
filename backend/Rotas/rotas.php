<?php

namespace App\koketsu\Rotas;

class Rotas
{
    public static function get()
    {
        return [ 
            "GET" => [
              // Usuarios
                 "/usuarios" => "UsuarioController@index",
                 "/usuario/criar" => "UsuarioController@viewCriarUsuarios",
                 "/usuario/listar" => "UsuarioController@viewListarUsuarios",
                 "/usuario/editar/{id}" => "UsuarioController@viewEditarUsuarios",
                 "/usuario/excluir/{id}" => "UsuarioController@viewExcluirUsuarios",
                 "/usuario/ativar/{id}" => "UsuarioController@viewAtivarUsuarios",
                 "/usuario/{id}/relatorio/{data1}/{data2}" => "UsuarioController@relatorioUsuario",
              // Categorias
                 "/categorias"        => "CategoriasController@index",
                 "/categoria/criar"   => "CategoriasController@viewCriarCategoria",
                 "/categoria/listar/{pagina}"  => "CategoriasController@viewListarCategoria",
                 "/categoria/editar/{id}"  => "CategoriasController@viewEditarCategoria",
                 "/categoria/excluir/{id}" => "CategoriasController@viewExcluirCategoria",
                 "/categoria/{id}/relatorio/{data1}/{data2}" => "CategoriasController@relatorioCategoria",
              // Cor
                 "/cores"        => "CoresController@index",
                 "/cor/criar"    => "CoresController@viewCriarCor",
                 "/cor/listar/{pagina}"   => "CoresController@viewListarCores",
                 "/cor/editar/{id}"   => "CoresController@viewEditarCor",
                 "/cor/excluir/{id}"  => "CoresController@viewExcluirCor",
                 "/cor/{id}/relatorio/{data1}/{data2}" => "CoresController@relatorioCores",
              // Clientes
                 "cliente/dashboard" => "Cliente\DashboardController@index",
                 "/backend/cliente/editar/{id}" => "Cliente\DashboardController@viewEditarCliente",
              // Perfil
                 "/perfis"        => "PerfilController@index",
                 "/perfil/criar"  => "PerfilController@viewCriarPerfil",
                 "/perfil/listar" => "PerfilController@viewListarPerfis",
                 "/perfil/listar/{pagina}" => "PerfilController@viewListarPerfis",
                 "/perfil/editar/{id}" => "PerfilController@viewEditarPerfil",
                 "/perfil/excluir/{id}" => "PerfilController@viewExcluirPerfil",
              // Tamanhos
                 "/tamanhos"        => "TamanhoController@index",
                 "/tamanho/criar"   => "TamanhoController@viewCriarTamanho",
                 "/tamanho/listar"  => "TamanhoController@viewListarTamanhos",
                 "/tamanho/editar/{id}"  => "TamanhoController@viewEditarTamanho",
                 "/tamanho/excluir/{id}" => "TamanhoController@viewExcluirTamanho",
              // Itens Pedidos   
                  "/itenspedidos" => "ItensPedidosController@index",
                  "/itenspedidos/criar" => "ItensPedidosController@viewCriarItemPedido",
                  "/itenspedidos/listar" => "ItensPedidosController@viewListarItemPedido",
                  "/itenspedidos/listar/{id}" => "ItensPedidosController@viewItemPedidoUnico",
                  "/itenspedidos/listar/{pagina}" => "ItensPedidosController@viewlistaritenspedidos",
                  "/itenspedidos/editar/{id}" => "ItensPedidosController@viewEditarItemPedido",
                  "/itenspedidos/excluir/{id}" => "ItensPedidosController@viewExcluirItemPedido",
                  "/itenspedidos/{id}/relatorio/{data1}/{data2}" => "ItensPedidosController@relatorioitenspedidos",
                  '/api/itenspedidos' => 'PublicApiController@getItenspedidos',
                  '/api/itenspedidos/{pagina}' => 'PublicApiController@getItenspedidos',
              //Pedidos
                  "/pedido" => "PedidosController@index",
                  "/pedido/criar" => "PedidosController@viewCriarPedidos",
                  "/pedido/listar" => "PedidosController@viewListarPedido",
                  "/pedido/listar/{id}" => "PedidosController@viewPedidoUnico",
                  "pedido/detalhes/{id}" => "PedidosController@viewPedidoUnico",
                  "/pedido/editar/{id}" => "PedidosController@viewEditarPedido",
                  "/pedido/excluir/{id}" => "PedidosController@viewExcluirPedido",
                  "/pedido/{id}/relatorio/{data1}/{data2}" => "Pedidos@relatorioPedido",
                  '/api/pedidos' => 'PublicApiController@getPedidos',
                  '/api/pedidos/{pagina}' => 'PublicApiController@getPedidos',
              //Produtos
                 "/produtos/listar" => "ProdutosController@viewListarProduto",
                 "/produtos/criar" => "ProdutosController@viewCriarProduto",
                  '/api/produtos' => 'PublicApiController@getProdutos',
                 "/produtos/listar/{pagina}" => "ProdutosController@viewlistarProduto",
                 "/produtos/editar/{id}" => "ProdutosController@viewEditarProdutos",
                 "/produtos/excluir/{id}" => "ProdutosController@viewExcluirProduto",
                 "/produtos/ativar/{id}" => "ProdutosController@viewAtivarProdutos",
                 "/produtos/{id}/relatorio/{data1}/{data2}" => "ProdutosController@relatorioProduto",
               //Avaliação
                 "/backend/avaliacao" => "AvaliacaoController@index",
                 "/backend/avaliacao/criar" => "AvaliacaoController@viewCriarAvaliacoes",
                 "/backend/avaliacao/listar" => "AvaliacaoController@viewListarAvaliacoes",
                 "/backend/avaliacao/editar/{id}" => "AvaliacaoController@viewEditarAvaliacoes",
                 "/backend/avaliacao/excluir/{id}" => "AvaliacaoController@viewExcluirAvaliacoes",
              //Carrinho
                 "/backend/carrinho" => "CarrinhoController@index",
                 "/backend/carrinho/criar" => "CarrinhoController@viewCriarCarrinho",
                 "/backend/carrinho/listar" => "CarrinhoController@viewListarCarrinho",
                 "/backend/carrinho/editar/{id}" => "CarrinhoController@viewEditarCarrinho",
                 "/backend/carrinho/excluir/{id}" => "CarrinhoController@viewExcluirCarrinho",
              //Estoque_Movimentação
                 "/backend/EstoqueMovimentacao" => "EstoqueController@index",
                 "/backend/EstoqueMovimentacao/criar" => "EstoqueController@viewCriarEstoque_Movimentacao",
                 "/backend/EstoqueMovimentacao/listar" => "EstoqueController@viewListarEstoque_Movimentacao",
                 "/backend/EstoqueMovimentacao/editar/{id}" => "EstoqueController@viewEditarEstoque_Movimentacao",
                 "/backend/EstoqueMovimentacao/excluir/{id}" => "EstoqueController@viewExcluirEstoque_Movimentacao",
             //Imagens
                 "/backend/Imagens" => "ImagensController@index",
                 "/backend/Imagens/criar" => "ImagensController@viewCriarImagem",
                 "/backend/Imagens/listar" => "ImagensController@viewListarImagem",
                 "/backend/Imagens/editar/{id}" => "ImagensController@viewEditarImagem",
                 "/backend/Imagens/excluir/{id}" => "ImagensController@viewExcluirImagem",
               

              // Login
                 '/register' => 'AuthController@register',
                 '/admin' => 'AuthController@loginadmin',
                 '/login' => 'AuthController@login',
                 '/logout' => 'AuthController@logout',
                 '/admin/dashboard' => 'Admin\DashboardController@index',
          ],

        "POST" => [
                 "/api/pedidos" => 'PublicApiController@salvarPedido',
                // Clientes
                "/backend/cliente/atualizar/{id}" => "Cliente\DashboardController@atualizarCliente",
                // Usuarios 
                "/usuario/salvar" => "UsuarioController@salvarUsuario",
                "/usuario/atualizar" => "UsuarioController@atualizarUsuario",
                "/usuario/deletar" => "UsuarioController@deletarUsuario",
                "/usuario/ativar" => "UsuarioController@ativarUsuario",
                "/usuario/atualizar/{id}" => "UsuarioController@atualizarUsuario",
                "/usuario/deletar/{id}" => "UsuarioController@deletarUsuario",
                // Categorias
                "/categoria/salvar"    => "CategoriasController@salvarCategoria",
                "/categoria/atualizar/{id}" => "CategoriasController@atualizarCategoria",
                "/categoria/deletar/{id}"   => "CategoriasController@deletarCategoria",
                // Cor
                "/cor/salvar"    => "CoresController@salvarCor",
                "/cor/atualizar/{id}" => "CoresController@atualizarCor",
                "/cor/deletar/{id}"   => "CoresController@deletarCor",
                // Perfil
                "/perfil/salvar"    => "PerfilController@salvarPerfil",
                "/perfil/atualizar/{id}" => "PerfilController@atualizarPerfil",
                "/perfil/deletar/{id}"   => "PerfilController@deletarPerfil",
                // Tamanhos
                "/tamanho/salvar"    => "TamanhoController@salvarTamanho",
                "/tamanho/atualizar" => "TamanhoController@atualizarTamanho",
                "/tamanho/atualizar/{id}" => "TamanhoController@atualizarTamanho",
                "/tamanho/deletar/{id}"   => "TamanhoController@deletarTamanho",
                 //itens pedidos
                "/itenspedidos/salvar" => "ItensPedidosController@salvarItemPedido",
                "/itenspedidos/atualizar/{id}" => "ItensPedidosController@atualizarItemPedido",
                "/itenspedidos/deletar/{id}" => "ItensPedidosController@deletarItemPedido",
                //Pedidos
                "/pedido/salvar" => "PedidosController@salvarPedido",
                "/pedido/atualizar/{id}" => "PedidosController@atualizarPedidos",
                "/pedido/deletar/{id}" => "PedidosController@viewExcluirPedido",
                "/pedido/listar" => "PedidosController@viewListarPedido",
                //produtos
                "/produtos/salvar" => "ProdutosController@salvarProduto",
                "/produtos/atualizar" => "ProdutosController@atualizarProdutos",
                "/produtos/deletar" => "ProdutosController@deletarProdutos",
                "/produtos/ativar" => "produtosController@ativarProduto",
                "/produtos/listar" => "ProdutosController@viewListarProduto",
                //avaliacao
                "/backend/avaliacao/salvar" => "AvaliacaoController@salvarAvaliacao",
                "/backend/avaliacao/atualizar/{id}" => "AvaliacaoController@atualizarAvaliacao",
                "/backend/avaliacao/deletar/{id}" => "AvaliacaoController@deletarAvaliacao",
                //carrinho
                "/backend/carrinho/salvar" => "CarrinhoController@salvarCarrinho",
                "/backend/carrinho/atualizar/{id}" => "CarrinhoController@atualizarCarrinho",                
                "/backend/carrinho/deletar/{id}" => "CarrinhoController@deletarCarrinho",
                //EstoqueMovimentacao
                "/backend/EstoqueMovimentacao/salvar" => "EstoqueController@salvarEstoque_Movimentacao",
                "/backend/EstoqueMovimentacao/atualizar/{id}" => "EstoqueController@atualizarEstoque_Movimentacao",
                "/backend/EstoqueMovimentacao/deletar/{id}" => "EstoqueController@deletarEstoque_Movimentacao",
                //imagens
                "/backend/Imagem/salvar" => "ImagensController@salvarImagens",
                "/backend/Imagem/atualizar/{id}" => "ImagensController@atualizarImagens",
                "/backend/Imagem/deletar/{id}" => "ImagensController@deletarImagens",
                
                // Login
                '/register' => 'AuthController@cadastrarUsuario',
                '/login' => 'AuthController@authenticar',
                '/adminlogin' => 'AuthController@authenticaradmin',
            ]
        ];
    }
}