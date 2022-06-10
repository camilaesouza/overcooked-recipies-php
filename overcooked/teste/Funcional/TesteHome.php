<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteHome extends Teste
{
    public function testeIndex()
    {
        $resposta = $this->get(URL_RAIZ . 'inicio');
        $this->verificarContem($resposta, 'Conheça receitas');
    }
}
