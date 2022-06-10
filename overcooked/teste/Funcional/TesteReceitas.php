<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Receita;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteReceitas extends Teste
{
	public function testeListagem()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'receitas');
    }

    public function testeListagemLogado()
    {
        $this->logar();

        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'receitas');
    }

    public function testeCriarDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'receitas/criar');
        $this->verificar(strpos($resposta['html'], 'Oh não! Você não tem acesso para essa tela') !== false);
    }

    public function testeCriarLogado()
    {
        $this->logar();
        $resposta = $this->get(URL_RAIZ . 'receitas/criar');

        $this->verificarContem($resposta, 'receitas/criar');
    }

    public function testeEditarLogado()
    {
        $usuarioLogado = $this->logar();
        $receita = (new Receita($usuarioLogado->getId(), 'Macarrão', 'Delicioso e simples', 'Macarrão, molho, verduras'))->salvar();

        $resposta = $this->get(URL_RAIZ . 'receitas/editar/' . $receita->getId());
        $this->verificarContem($resposta, 'receitas/editar/' . $receita->getId());
    }

    public function testeEditarDeslogado()
    {
        $usuarioReceita = (new Usuario('Camila', 'camilareceita@teste.com.br', '12345678'))->salvar();
        $receita = (new Receita($usuarioReceita->getId(), 'Macarrão', 'Delicioso e simples', 'Macarrão, molho, verduras'))->salvar();

        $resposta = $this->get(URL_RAIZ . 'receitas/editar/' . $receita->getId());
        $this->verificar(strpos($resposta['html'], 'Oh não! Você não tem acesso para essa tela') !== false);
    }

    public function testeArmazenar()
    {
        $usuarioLogado = $this->logar();

        $resposta = $this->post(URL_RAIZ . 'receitas/criar', [
            'titulo' => 'Bife com bacon',
            'descricao' => 'Delicioso para jantar a um',
            'ingredientes' => 'Bife, bacon, oleo',
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'Receita cadastrada com sucesso.');

        $query = DW3BancoDeDados::query('SELECT * FROM receitas');
        $bdReceitas = $query->fetchAll();
        $this->verificar(count($bdReceitas) == 1);
    }

    public function testeAtualizar()
    {
        $usuarioLogado = $this->logar();
        $receita = (new Receita($usuarioLogado->getId(), 'Macarrão', 'Delicioso e simples', 'Macarrão, molho, verduras'))->salvar();

        $resposta = $this->patch(URL_RAIZ . 'receitas/' . $receita->getId(), [
            'titulo' => 'Bife com bacon',
            'descricao' => 'Delicioso para jantar a um',
            'ingredientes' => 'Bife, bacon, oleo',
        ]);

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'Receita editada com sucesso.');

        $receitaEditada = Receita::buscarId($receita->getId());
        $this->verificar($receitaEditada->getTitulo() == 'Bife com bacon');
        $this->verificar($receitaEditada->getDescricao() == 'Delicioso para jantar a um');
        $this->verificar($receitaEditada->getIngredientes() == 'Bife, bacon, oleo');
    }

    public function testeDestruir()
    {
        $usuarioLogado = $this->logar();
        $receita = (new Receita($usuarioLogado->getId(), 'Macarrão', 'Delicioso e simples', 'Macarrão, molho, verduras'))->salvar();

        $resposta = $this->delete(URL_RAIZ . 'receitas/' . $receita->getId());

        $this->verificarRedirecionar($resposta, URL_RAIZ . 'receitas');
        $resposta = $this->get(URL_RAIZ . 'receitas');
        $this->verificarContem($resposta, 'Receita deletada com sucesso.');

        $receitaEditada = Receita::buscarId($receita->getId());
        $this->verificar($receitaEditada == null);
    }
}
