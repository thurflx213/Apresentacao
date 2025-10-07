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
                 "/categoria/listar"  => "CategoriasController@viewListarCategoria",
                 "/categoria/editar/{id}"  => "CategoriasController@viewEditarCategoria",
                 "/categoria/excluir/{id}" => "CategoriasController@viewExcluirCategoria",
              // Cor
                 "/cores"        => "CoresController@index",
                 "/cor/criar"    => "CoresController@viewCriarCor",
                 "/cor/listar"   => "CoresController@viewListarCores",
                 "/cor/editar/{id}"   => "CoresController@viewEditarCor",
                 "/cor/excluir/{id}"  => "CoresController@viewExcluirCor",
              // Perfil
                 "/perfis"        => "PerfilController@index",
                 "/perfil/criar"  => "PerfilController@viewCriarPerfil",
                 "/perfil/listar" => "PerfilController@viewListarPerfis",
                 "/perfil/editar/{id}" => "PerfilController@viewEditarPerfil",
                 "/perfil/excluir/{id}" => "PerfilController@viewExcluirPerfil",
              // Tamanhos
                 "/tamanhos"        => "TamanhoController@index",
                 "/tamanho/criar"   => "TamanhoController@viewCriarTamanho",
                 "/tamanho/listar"  => "TamanhoController@viewListarTamanhos",
                 "/tamanho/editar/{id}"  => "TamanhoController@viewEditarTamanho",
                 "/tamanho/excluir/{id}" => "TamanhoController@viewExcluirTamanho",

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
            ]
        ];
    }
}