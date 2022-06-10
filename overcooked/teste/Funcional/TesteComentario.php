<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Receita;
use \Modelo\Comentario;
use \Framework\DW3BancoDeDados;

class TesteComentario extends Teste
{
	public function testeArmazenar()
    {
		$usuarioLogado = $this->logar();
		$receita = (new Receita($usuarioLogado->getId(), 'Macarrão', 'Delicioso e simples', 'Macarrão, molho, verduras'))->salvar();
        
		$resposta = $this->post(URL_RAIZ . 'comentarios/' . $receita->getId(), [
            'comentario' => 'Receita muito boa',
            'receitaId' => $receita->getId(),
            'usuarioId' => $usuarioLogado->getId(),
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas/' . $receita->getId());
        $resposta = $this->get(URL_RAIZ . 'receitas/' . $receita->getId());
        $this->verificarContem($resposta, 'Comentario cadastrado com sucesso');

        $query = DW3BancoDeDados::query('SELECT * FROM comentarios WHERE comentario = "Receita muito boa" and receita_id = ' . $receita->getId());
        $bdComentarios = $query->fetchAll();
        $this->verificar(count($bdComentarios) == 1);
    }

   public function testeDestruir()
    {
        $usuarioLogado = $this->logar();
		$receita = (new Receita($usuarioLogado->getId(), 'Macarrão', 'Delicioso e simples', 'Macarrão, molho, verduras'))->salvar();
		$comentario = (new Comentario('Testei e a receita ficou uma delicia', $receita->getId(), $usuarioLogado->getId()))->salvar();

        $resposta = $this->delete(URL_RAIZ . 'comentarios/' . $comentario->getId());

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas/' . $receita->getId());
        $resposta = $this->get(URL_RAIZ . 'receitas/' . $receita->getId());
        $this->verificarContem($resposta, 'Comentário deletado com sucesso.');

        $comentarioEditada = Comentario::buscarId($comentario->getId());
        $this->verificar($comentarioEditada == null);
    }
}
