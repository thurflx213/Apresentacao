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
              // Perfil
                 "/perfis"        => "PerfilController@index",
                 "/perfil/criar"  => "PerfilController@viewCriarPerfil",
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
                 "/itenspedidos/{id}" => "ItensPedidosController@viewItemPedidoUnico",
                 "/itenspedidos/criar" => "ItensPedidosController@viewCriarItemPedido",
                 "/itenspedidos/listar/{pagina}" => "ItensPedidosController@viewListarItemPedido",
                 "/itenspedidos/editar/{id}" => "ItensPedidosController@viewEditarItemPedido",
                 "/itenspedidos/excluir/{id}" => "ItensPedidosController@viewExcluirItemPedido",
                 "/itenspedidos/{id}/relatorio/{data1}/{data2}" => "ItensPedidosController@relatorioitenspedidos",
              // Pedidos
                 "/pedido" => "PedidosController@index",
                 "/pedido/{id}" => "PedidosController@viewPedidoUnico",
                 "/pedido/criar" => "PedidosController@viewCriarPedido",
                 "/pedido/listar/{pagina}" => "PedidosController@viewListarPedido",
                 "/pedido/editar/{id}" => "PedidosController@viewEditarPedido",
                 "/pedido/excluir/{id}" => "PedidosController@viewExcluirPedido",
                 "/pedido/{id}/relatorio/{data1}/{data2}" => "PedidosController@relatorioPedido",
              //Produtos
                 "/produto" => "ProdutosController@index",
                 "/produto/{id}" => "ProdutosController@viewProdutoUnico", 
                 "/produto/criar" => "ProdutosController@viewCriarProduto",
                 "/produto/listar/{pagina}" => "ProdutosController@viewlistarProduto",
                 "/produto/editar/{id}" => "ProdutosController@viewEditarProduto",
                 "/produto/excluir/{id}" => "ProdutosController@viewExcluirProdutos",
                 "/produto/{id}/relatorio/{data1}/{data2}" => "ProdutosController@relatorioProduto",
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
                 '/login' => 'AuthController@login',
                 '/logout' => 'AuthController@logout',
                 '/admin/dashboard' => 'Admin\DashboardController@index',
          ],

        "POST" => [
                // Usuarios 
                "/usuario/salvar" => "UsuarioController@salvarUsuario",
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
                "/tamanho/atualizar/{id}" => "TamanhoController@atualizarTamanho",
                "/tamanho/deletar/{id}"   => "TamanhoController@deletarTamanho",
                //itens pedidos
                "/itenspedidos/salvar" => "ItensPedidosController@salvarItemPedido",
                "/itenspedidos/atualizar/{id}" => "ItensPedidosController@atualizarItemPedido",
                "/itenspedidos/deletar/{id}" => "ItensPedidosController@deletarItemPedido",
                //Pedidos
                "/pedido/salvar" => "PedidosController@salvarPedido",
                "/pedido/atualizar/{id}" => "PedidosController@atualizarPedido",
                "/pedido/deletar/{id}" => "PedidosController@deletarPedido",
                //produtos
                "/produto/salvar" => "ProdutosController@salvarProduto",
                "/produto/atualizar/{id}" => "ProdutosController@atualizarProduto",
                "/produto/deletar/{id}" => "ProdutosController@deletarProduto",
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
                
            ]
        ];
    }
}