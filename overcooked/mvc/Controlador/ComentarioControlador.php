<?php
namespace Controlador;

use \Modelo\Comentario;
use \Modelo\Receita;
use \Framework\DW3Sessao;

class ComentarioControlador extends Controlador
{
    public function armazenar($receitaId)
    {
       $this->verificarLogado();

        $comentario = new Comentario(
                $_POST['comentario'],
                $receitaId,
                DW3Sessao::get('usuario'),
            );

        if ($comentario->isValido()) {
            $comentario->salvar();

            DW3Sessao::setFlash('mensagem', 'Comentario cadastrado com sucesso.');
            $this->redirecionar(URL_RAIZ . 'receitas/' . $receitaId);

        } else {
            $this->setErros($comentario->getValidacaoErros());

            $usuario = $this->getUsuarioSessao();
            $receita = Receita::buscarId($receitaId);
            $comentarios = Comentario::buscarPorReceitaId($receita->getId());

            $this->visao('receitas/mostrar.php',[
                'usuario' => $usuario,
                'receita' => $receita,
                'comentarios' => $comentarios,
                'mensagem' => DW3Sessao::getFlash('mensagem')
            ], 'autenticado.php');
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();

        $usuario = $this->getUsuarioSessao();
        $comentario = Comentario::buscarId($id);
        $receitaId = $comentario->getReceitaId();

        if($usuario && $usuario->getId() != $comentario->getUsuarioId()) {
            return $this->visao('usuarios/erroDePermissao.php');
        }

        Comentario::destruir($id);
        $comentario = Comentario::buscarId($id);

        if($comentario) {
            DW3Sessao::setFlash('mensagem', 'Houve um erro ao deletar seu comentário!');
            $this->redirecionar(URL_RAIZ . 'receitas/' . $receitaId);
        } else {
            DW3Sessao::setFlash('mensagem', 'Comentário deletado com sucesso.');
            $this->redirecionar(URL_RAIZ . 'receitas/' . $receitaId);
        }
    }
}
