<?php

namespace App\koketsu\Rotas;

class Rotas
{
    public static function get()
    {
        return [ 
            "GET" => [
              // Usuarios
                 "/backend/usuarios" => "UsuarioController@index",
                 "/backend/usuario/criar" => "UsuarioController@viewCriarUsuarios",
                 "/backend/usuario/listar" => "UsuarioController@viewListarUsuarios",
                 "/backend/usuario/editar" => "UsuarioController@viewEditarUsuarios",
                 "/backend/usuario/excluir" => "UsuarioController@viewExcluirUsuarios",
              // Categorias
                 "/backend/categorias"        => "CategoriasController@index",
                 "/backend/categoria/criar"   => "CategoriasController@viewCriarCategoria",
                 "/backend/categoria/listar"  => "CategoriasController@viewListarCategoria",
                 "/backend/categoria/editar"  => "CategoriasController@viewEditarCategoria",
                 "/backend/categoria/excluir" => "CategoriasController@viewExcluirCategoria",
              // Cor
                 "/backend/cores"        => "CoresController@index",
                 "/backend/cor/criar"    => "CoresController@viewCriarCor",
                 "/backend/cor/listar"   => "CoresController@viewListarCores",
                 "/backend/cor/editar"   => "CoresController@viewEditarCor",
                 "/backend/cor/excluir"  => "CoresController@viewExcluirCor",
              // Perfil
                 "/backend/perfis"        => "PerfilController@index",
                 "/backend/perfil/criar"  => "PerfilController@viewCriarPerfil",
                 "/backend/perfil/listar" => "PerfilController@viewListarPerfis",
                 "/backend/perfil/editar" => "PerfilController@viewEditarPerfil",
                 "/backend/perfil/excluir"=> "PerfilController@viewExcluirPerfil",
              // Tamanhos
                 "/backend/tamanhos"        => "TamanhoController@index",
                 "/backend/tamanho/criar"   => "TamanhoController@viewCriarTamanho",
                 "/backend/tamanho/listar"  => "TamanhoController@viewListarTamanhos",
                 "/backend/tamanho/editar"  => "TamanhoController@viewEditarTamanho",
                 "/backend/tamanho/excluir" => "TamanhoController@viewExcluirTamanho",       

    ],
        "POST" => [
                // Usuarios 
                "/backend/usuario/salvar" => "UsuarioController@salvarUsuario",
                "/backend/usuario/atualizar" => "UsuarioController@atualizarUsuario",
                "/backend/usuario/deletar" => "UsuarioController@deletarUsuario",
                // Categorias
                "/backend/categoria/salvar"    => "CategoriaController@salvarCategoria",
                "/backend/categoria/atualizar" => "CategoriaController@atualizarCategoria",
                "/backend/categoria/deletar"   => "CategoriaController@deletarCategoria",
                // Cor
                "/backend/cor/salvar"    => "CorController@salvarCor",
                "/backend/cor/atualizar" => "CorController@atualizarCor",
                "/backend/cor/deletar"   => "CorController@deletarCor",
                // Perfil
                  "/backend/perfil/salvar"    => "PerfilController@salvarPerfil",
                "/backend/perfil/atualizar" => "PerfilController@atualizarPerfil",
                "/backend/perfil/deletar"   => "PerfilController@deletarPerfil",
                // Tamanhos
                 "/backend/tamanho/salvar"    => "TamanhoController@salvarTamanho",
                "/backend/tamanho/atualizar" => "TamanhoController@atualizarTamanho",
                "/backend/tamanho/deletar"   => "TamanhoController@deletarTamanho",
            ]
        ];
    }
}