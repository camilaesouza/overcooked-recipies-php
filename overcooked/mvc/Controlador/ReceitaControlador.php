<?php
namespace Controlador;

use \Modelo\Receita;
use \Modelo\Usuario;
use \Modelo\Comentario;
use \Framework\DW3Sessao;

class ReceitaControlador extends Controlador
{

    public function index()
    {
        $query = empty($_POST['query']) ? null : $_POST['query'];
        $orderBy = empty($_POST['ordenar']) ? 'desc' : $_POST['ordenar'];

        $usuario = $this->getUsuarioSessao();
        $paginacao = $this->calcularPaginacao("buscarTodos", "contarTodos", $orderBy);

        if ($query) {
            $paginacao = $this->calcularPaginacao("buscarPorQuery", "contarTodos", $query);
        }

        $this->visao('receitas/index.php', [
            'mensagem' => DW3Sessao::getFlash('mensagem'),
            'receitas' => $paginacao['receitas'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'query' => $query,
            'ordenar' => $orderBy,
             'usuario' => $usuario
            ], 'autenticado.php');
    }

    public function criar()
    {
        $this->verificarLogado();
        $usuario = $this->getUsuarioSessao();

        $this->visao('receitas/criar.php', [
            'usuario' => $usuario
        ], 'autenticado.php');
    }

    public function armazenar()
    {
       $this->verificarLogado();

       $receita = new Receita(
            DW3Sessao::get('usuario'),
            $_POST['titulo'],
            $_POST['descricao'],
            $_POST['ingredientes'],
        );

       if ($receita->isValido()) {
            $receita->salvar();

            DW3Sessao::setFlash('mensagem', 'Receita cadastrada com sucesso.');
            $this->redirecionar(URL_RAIZ . 'receitas');

        } else {
            $this->setErros($receita->getValidacaoErros());

            $this->visao('receitas/criar.php', [
                'usuario' => $usuario
            ], 'autenticado.php');
        }
    }

    public function editar($id)
    {
        $this->verificarLogado();

        $usuario = $this->getUsuarioSessao();
        $receita = Receita::buscarId($id);

        if($usuario && $usuario->getId() != $receita->getUsuarioId()) {
            return $this->visao('usuarios/erroDePermissao.php');
        }

        $this->visao('receitas/editar.php', [
            'usuario' => $usuario,
            'receita' => $receita
        ], 'autenticado.php');
    }

    public function atualizar($id)
	{
		$this->verificarLogado();

        $usuario = $this->getUsuarioSessao();
		$receita = Receita::buscarId($id);

        if($usuario && $usuario->getId() != $receita->getUsuarioId()) {
            return $this->visao('usuarios/erroDePermissao.php');
        }

        $receita->setTitulo($_POST['titulo']);
        $receita->setDescricao($_POST['descricao']);
        $receita->setIngredientes($_POST['ingredientes']);

        if ($receita->isValido()) {
            $receita->salvar();

            DW3Sessao::setFlash('mensagem', 'Receita editada com sucesso.');
            $this->redirecionar(URL_RAIZ . 'receitas');

        } else {
            $this->setErros($receita->getValidacaoErros());

            $this->visao('receitas/editar.php', [
                'usuario' => $usuario,
                'receita' => $receita
            ], 'autenticado.php');
        }
	}

    public function mostrar($id)
    {
        $usuario = $this->getUsuarioSessao();
        $receita = Receita::buscarId($id);
        $comentarios = Comentario::buscarPorReceitaId($receita->getId());

        $this->visao('receitas/mostrar.php',[
            'usuario' => $usuario,
            'receita' => $receita,
            'comentarios' => $comentarios,
            'mensagem' => DW3Sessao::getFlash('mensagem')
        ], 'autenticado.php');
    }

    public function destruir($id)
    {
        $this->verificarLogado();

        $usuario = $this->getUsuarioSessao();
        $receita = Receita::buscarId($id);

        if($usuario && $usuario->getId() != $receita->getUsuarioId()) {
            return $this->visao('usuarios/erroDePermissao.php');
        }

        Receita::destruir($id);
        $receita = Receita::buscarId($id);

        if($receita) {
            DW3Sessao::setFlash('mensagem', 'Houve um erro ao deletar sua receita!');
            $this->redirecionar(URL_RAIZ . 'receitas');
        } else {
            DW3Sessao::setFlash('mensagem', 'Receita deletada com sucesso.');
            $this->redirecionar(URL_RAIZ . 'receitas');
        }
    }
}
