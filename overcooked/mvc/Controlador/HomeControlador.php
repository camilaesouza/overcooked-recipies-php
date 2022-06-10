<?php
namespace Controlador;

class HomeControlador extends Controlador
{
    public function index()
    {
        $usuario = $this->getUsuarioSessao();

        $this->visao('home/index.php',[
            'usuario' => $usuario
        ], 'autenticado.php');
    }
}