<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{
    public function mostrar()
    {
        $this->verificarLogado();
        $usuario = $this->getUsuarioSessao();

        $this->visao('usuarios/mostrar.php',[
            'usuario' => $usuario
        ], 'autenticado.php');
    }
    
    public function criar()
    {
        $usuario = $this->getUsuarioSessao();

        $this->visao('usuarios/criar.php',[
            'usuario' => $usuario
        ]);
    }

    public function armazenar()
    {
        $usuario = new Usuario($_POST['nome'], $_POST['email'], $_POST['senha']);

        if ($usuario->isValido()) {
            $usuario->salvar();

            DW3Sessao::setFlash('mensagem', 'Usuário cadastrado com sucesso!');
            $this->redirecionar(URL_RAIZ . 'login');

        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php',[
                'usuario' => $usuario
            ]);
        }
    }
}
