<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Framework\DW3BancoDeDados;

class TesteUsuarios extends Teste
{
	public function testeMostrar()
	{
        $this->logar();

		$resposta = $this->get(URL_RAIZ . 'usuarios');
		$this->verificarContem($resposta, 'Seu perfil');
	}

	public function testeCriar()
	{
		$resposta = $this->get(URL_RAIZ . 'usuarios/criar');
		$this->verificarContem($resposta, 'Registre-se');
	}

	public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'usuarios', [
            'nome' => 'Camila',
            'email' => 'camila@testeUsuario.com.br',
            'senha' => '12345678',
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'Usuário cadastrado com sucesso!');

        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE email = "camila@testeUsuario.com.br"');
        $bdUsuarios = $query->fetchAll();

        $this->verificar(count($bdUsuarios) == 1);
    }
}
