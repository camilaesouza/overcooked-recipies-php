<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
    public function testeInserir()
    {
        $usuario = (new Usuario('Camila', 'camila@testeUnitario.com', '12345678'))->salvar();

        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE id = ' . $usuario->getId());
        $bdUsuarios = $query->fetchAll();

        $this->verificar(count($bdUsuarios) == 1);
    }

    public function testeBuscarLogin()
    {
        $usuario = (new Usuario('Camila', 'camila@testeUnitario.com', '12345678'))->salvar();

        $usuarioLogin = Usuario::buscarLogin('camila@testeUnitario.com');
        $this->verificar($usuarioLogin != null);
    }

    public function testeBuscarId()
    {
        $usuario = (new Usuario('Camila', 'camila@testeUnitario.com', '12345678'))->salvar();
        $usuarioBusca = Usuario::buscarId($usuario->getId());

        $this->verificar($usuario->getId() == $usuarioBusca->getId());
    }

    public function testeContarTodos()
    {
        $usuario = (new Usuario('Camila', 'camila@testeUnitario.com', '12345678'))->salvar();
        $usuario2 = (new Usuario('Emanuele', 'camilaEmanuele@testeUnitario.com', '87654321'))->salvar();

        $quantidadeDeUsuarios = Usuario::contarTodos();
        $this->verificar($quantidadeDeUsuarios == 2);
    }
}
