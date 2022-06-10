<?php
namespace Teste\Funcional;

use \Teste\Teste;

class TesteRelatorios extends Teste
{
    public function testeIndex()
    {
        $resposta = $this->get(URL_RAIZ . 'relatorios');
        $this->verificarContem($resposta, 'relatorios');
    }
}
