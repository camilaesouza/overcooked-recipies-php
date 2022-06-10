<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
        'GET' => '\Controlador\UsuarioControlador#mostrar'
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/inicio' => [
        'GET' => '\Controlador\HomeControlador#index',
    ],
    '/receitas' => [
        'GET' => '\Controlador\ReceitaControlador#index',
        'POST' => '\Controlador\ReceitaControlador#index',
    ],
    '/receitas/criar' => [
        'GET' => '\Controlador\ReceitaControlador#criar',
        'POST' => '\Controlador\ReceitaControlador#armazenar',
    ],
    '/receitas/editar/?' => [
        'GET' => '\Controlador\ReceitaControlador#editar',
    ],
    '/receitas/?' => [
        'GET' => '\Controlador\ReceitaControlador#mostrar',
        'PATCH' => '\Controlador\ReceitaControlador#atualizar',
        'DELETE' => '\Controlador\ReceitaControlador#destruir',
    ],
    '/receitas/busca' => [
        'POST' => '\Controlador\ReceitaControlador#index',
    ],
    '/comentarios/?' => [
        'POST' => '\Controlador\ComentarioControlador#armazenar',
        'DELETE' => '\Controlador\ComentarioControlador#destruir',
    ],
    '/relatorios' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],
];
