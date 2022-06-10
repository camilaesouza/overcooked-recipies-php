<?php
namespace Teste;

use \Modelo\Usuario;
use \Framework\DW3Teste;
use \Framework\DW3Sessao;

abstract class Teste extends DW3Teste
{
	public function logar()
	{
		$usuario = new Usuario('Camila', 'camila@teste.com.br', '12345678');
		$usuario->salvar();
		
		DW3Sessao::set('usuario', $usuario->getId());

		return $usuario;
	}
}
