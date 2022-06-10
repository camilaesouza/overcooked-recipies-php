<?php
namespace Controlador;

use \Modelo\Usuario;
use \Modelo\Receita;
use \Framework\DW3Controlador;
use \Framework\DW3Sessao;

abstract class Controlador extends DW3Controlador
{
    use ControladorVisao;
    
    protected $usuario;

    protected function verificarLogado()
    {
    	$usuario = $this->getUsuario();
        if ($usuario == null) {
        	return $this->visao('usuarios/erroDePermissao.php');
        }
    }

    protected function getUsuario()
    {
        if ($this->usuario == null) {
            $usuario = DW3Sessao::get('usuario');
        }
        return $usuario;
    }

    protected function getUsuarioSessao()
    {
        $usuarioId = DW3Sessao::get('usuario');
        if ($usuarioId == null) {
            return null;
        }
        $this->usuario = Usuario::buscarId($usuarioId);
        return $this->usuario;
    }

    protected function calcularPaginacao($busca, $quantidade, $orderBy = 'desc', $query = null)
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 8;
        $offset = ($pagina - 1) * $limit;

        if ($query) {
            $receitas = Receita::$busca($limit, $offset, $query);
        } else {
            $receitas = Receita::$busca($limit, $offset, $orderBy);
        }

        $ultimaPagina = ceil(Receita::$quantidade() / $limit);
        return compact('pagina', 'receitas', 'ultimaPagina');
    }

    protected function calcularPaginacaoId($busca, $quantidade, $id)
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 5;
        $offset = ($pagina - 1) * $limit;
        $receitas = Receita::$busca($id, $limit, $offset);
        $ultimaPagina = ceil(Receita::$quantidade($id) / $limit);
        return compact('pagina', 'receitas', 'ultimaPagina');
    }
}
