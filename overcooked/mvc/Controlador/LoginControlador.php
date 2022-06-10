<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function criar()
    {
        $this->visao('login/criar.php', [
            'mensagem' => DW3Sessao::getFlash('mensagem')
        ]);
    }

    public function armazenar()
    {
        $usuario = Usuario::buscarLogin($_POST['login']);

        if ($usuario && $usuario->verificarSenha($_POST['senha'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            $this->redirecionar(URL_RAIZ);

        } else {
            $this->setErros(['login' => 'Usuário ou senha inválidos.']);
            $this->visao('login/criar.php');
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
