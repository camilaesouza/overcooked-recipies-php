<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Comentario;
use \Modelo\Usuario;
use \Modelo\Receita;
use \Framework\DW3BancoDeDados;

class TesteComentario extends Teste
{
    public function testeInserir()
    {
        $comentario = $this->criarComentario();
        
        $query = DW3BancoDeDados::query('SELECT * FROM comentarios WHERE id = ' . $comentario->getId());
        $bdComentarios = $query->fetchAll();
        $this->verificar(count($bdComentarios) == 1);
    }

    public function testeDestruir()
    {
        $comentario = $this->criarComentario();
        Comentario::destruir($comentario->getId());
        
        $query = DW3BancoDeDados::query('SELECT * FROM comentarios WHERE id = ' . $comentario->getId());
        $bdComentarios = $query->fetchAll();

        $this->verificar(count($bdComentarios) == 0);
    }

    public function testeBuscarId()
    {
        $comentario = $this->criarComentario();
        $comentarioBusca = Comentario::buscarId($comentario->getId());

        $this->verificar($comentario->getId() == $comentarioBusca->getId());
    }

    public function testeBuscarPorReceitaId()
    {
        $comentario = $this->criarComentario();
        $comentariosPorReceita = Comentario::buscarPorReceitaId($comentario->getReceitaId());

        $this->verificar(count($comentariosPorReceita) == 1);
    }

    private function criarComentario() 
    {
        $usuarioLogado = $this->logar();
		$receita = (new Receita($usuarioLogado->getId(), 'Macarrão', 'Delicioso e simples', 'Macarrão, molho, verduras'))->salvar();
		$comentario = (new Comentario('Testei e a receita ficou uma delicia', $receita->getId(), $usuarioLogado->getId()))->salvar();

        return $comentario;
    }
}
