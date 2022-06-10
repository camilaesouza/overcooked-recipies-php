<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Receita;
use \Framework\DW3BancoDeDados;

class TesteReceita extends Teste
{
    public function testeInserir()
    {
        $receita = $this->criarReceita();
        
        $query = DW3BancoDeDados::query('SELECT * FROM receitas WHERE id = ' . $receita->getId());
        $bdComentarios = $query->fetchAll();
        $this->verificar(count($bdComentarios) == 1);
    }

    public function testeAtualizar()
    {
        $receita = $this->criarReceita();

        $receita->setTitulo("Macarrão com molho branco");
        $receita->salvar();

        $query = DW3BancoDeDados::query('SELECT * FROM receitas WHERE id = ' . $receita->getId());
        $bdReceita = $query->fetch();
        $this->verificar($bdReceita['titulo'] == "Macarrão com molho branco");
    }

    public function testeDestruir()
    {
        $receita = $this->criarReceita();
        Receita::destruir($receita->getId());
        
        $query = DW3BancoDeDados::query('SELECT * FROM receitas WHERE id = ' . $receita->getId());
        $bdReceita = $query->fetchAll();

        $this->verificar(count($bdReceita) == 0);
    }

    public function testeBuscarTodos()
    {
        $receita = $this->criarReceita();

        $receitas = Receita::buscarTodos();
        $this->verificar(count($receitas) == 1);
    }

    public function testeContarTodos()
    {
        $receita = $this->criarReceita();
        $receita2 = $this->criarReceita();

        $quantidadeDeReceitas = Receita::contarTodos();
        $this->verificar($quantidadeDeReceitas == 2);
    }

    public function testeBuscarId()
    {
        $receita = $this->criarReceita();
        $receitaBusca = Receita::buscarId($receita->getId());

        $this->verificar($receita->getId() == $receitaBusca->getId());
    }

    public function testeBuscarPorQuery()
    {
        $receita = $this->criarReceita();

        $receitas = Receita::buscarPorQuery(2, 0, 'Macarrão');
        $this->verificar(count($receitas) == 1);
    }

    private function criarReceita() 
    {
        $usuarioLogado = $this->logar();
        $receita = (new Receita($usuarioLogado->getId(), 'Macarrão', 'Delicioso e simples', 'Macarrão, molho, verduras'))->salvar();

        return $receita;
    }
}
