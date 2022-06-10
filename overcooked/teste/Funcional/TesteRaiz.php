<?php
namespace teste\Funcional;

use \teste\Teste;

class TesteRaiz extends Teste
{
	public function testeAcessar()
	{
		$resposta = $this->get(URL_RAIZ);
		$this->verificarRedirecionar($resposta, URL_RAIZ . 'inicio');
	}
}
