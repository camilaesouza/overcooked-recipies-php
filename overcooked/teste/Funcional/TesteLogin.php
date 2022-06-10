<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'login');
    }

    public function testeLogar()
    {
        (new Usuario('Camila', 'camila@teste.com.br', '12345678'))->salvar();

        $resposta = $this->post(URL_RAIZ . 'login', [
            'login' => 'camila@teste.com.br',
            'senha' => '12345678'
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ);
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeDeslogar()
    {
        (new Usuario('Camila', 'camila@teste.com.br', '12345678'))->salvar();

        $resposta = $this->post(URL_RAIZ . 'login', [
            'login' => 'camila@teste.com.br',
            'senha' => '12345678'
        ]);

        $resposta = $this->delete(URL_RAIZ . 'login');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

}
