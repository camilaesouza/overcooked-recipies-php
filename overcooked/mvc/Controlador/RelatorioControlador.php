<?php
namespace Controlador;

use \Modelo\Usuario;
use \Modelo\Receita;

class RelatorioControlador extends Controlador
{
    public function index()
    {
        $usuario = $this->getUsuarioSessao();

        $this->visao('relatorios/index.php', [
                'quantidadeReceitas' => Receita::contarTodos(),
                'quantidadeUsários' => Usuario::contarTodos(),
                'usuario' => $usuario,
        ], 'autenticado.php');
    }
}
