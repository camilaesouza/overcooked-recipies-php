<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Receita extends Modelo
{
    const BUSCAR_TODOS_BY_DESC = 'SELECT * FROM receitas order by data_criacao DESC LIMIT ? OFFSET ?';
    const BUSCAR_TODOS_BY_ASC = 'SELECT * FROM receitas order by data_criacao ASC LIMIT ? OFFSET ?';
    const BUSCAR_ID = 'SELECT * FROM receitas WHERE id = ?';
    const INSERIR = 'INSERT INTO receitas(usuario_id, titulo, descricao, ingredientes, data_criacao) VALUES (?, ?, ?, ?, now())';
    const ATUALIZAR = 'UPDATE receitas SET titulo = ?, descricao = ?, ingredientes = ? WHERE id = ?';
    const DELETAR = 'DELETE FROM receitas WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM receitas';
    const BUSCAR_POR_QUERY = 'SELECT * FROM receitas where ingredientes like ? LIMIT ? OFFSET ?';

    private $id;
    private $titulo;
    private $descricao;
    private $ingredientes;
    private $dataCriacao;
    private $usuarioId;

    public function __construct(
        $usuarioId,
        $titulo,
        $descricao,
        $ingredientes,
        $id = null,
        $dataCriacao = null
        ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->descricao = $descricao;
        $this->titulo = $titulo;
        $this->ingredientes = $ingredientes;
        $this->dataCriacao = $dataCriacao;
    }

    public function getid()
    {
        return $this->id;
    }

    public function getUsuario()
    {
        return $this->usuario = Usuario::buscarId($this->usuarioId);
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getIngredientes()
    {
        return $this->ingredientes;
    }

    public function getDataCriacao()
    {
        $date = date_create($this->dataCriacao);
        return date_format($date, 'd/m/Y');
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setIngredientes($ingredientes)
    {
        $this->ingredientes = $ingredientes;
    }

    public function salvar()
    {
        if ($this->getid() == null) {
            $this->inserir();
        } else {
            $this->atualizar();
        }

        return $this;
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuarioId);
        $comando->bindValue(2, $this->titulo);
        $comando->bindValue(3, $this->descricao);
        $comando->bindValue(4, $this->ingredientes);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public function atualizar()
    {
        $comando = DW3BancoDeDados::prepare(self::ATUALIZAR);
        $comando->bindValue(1, $this->titulo, PDO::PARAM_STR);
        $comando->bindValue(2, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(3, $this->ingredientes, PDO::PARAM_STR);
        $comando->bindValue(4, $this->id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function destruir($id)
    {
        $comentarios = Comentario::buscarPorReceitaId($id);

        foreach ($comentarios as $comentario) {
            Comentario::destruir($comentario->getId());
        }

        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id,  PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarTodos($limit = 2, $offset = 0, $orderBy = 'desc')
    {
        if ($orderBy == 'asc') {
            $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_BY_ASC);
        } else {
            $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS_BY_DESC);
        }

        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();

        $receitas = [];
        foreach ($registros as $registro) {
            $receitas[] = new Receita(
                $registro['usuario_id'],
                $registro['titulo'],
                $registro['descricao'],
                $registro['ingredientes'],
                $registro['id'],
                $registro['data_criacao'],
                );
        }
        return $receitas;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();

        if($registro) {
            return new Receita(
            $registro['usuario_id'],
            $registro['titulo'],
            $registro['descricao'],
            $registro['ingredientes'],
            $registro['id'],
            $registro['data_criacao'],
            );
        }

        return null;
    }

    public static function buscarPorQuery($limit = 2, $offset = 0, $query = '')
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_QUERY);
        $comando->bindValue(1, "%$query%", PDO::PARAM_STR);
        $comando->bindValue(2, $limit, PDO::PARAM_INT);
        $comando->bindValue(3, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();

        $receitas = [];
        foreach ($registros as $registro) {
            $receitas[] = new Receita(
                $registro['usuario_id'],
                $registro['titulo'],
                $registro['descricao'],
                $registro['ingredientes'],
                $registro['id'],
                $registro['data_criacao'],
                );
        }

        return $receitas;
    }

    protected function verificarErros()
    {
        if (strlen($this->titulo) <= 5) {
            $this->setErroMensagem('titulo', 'Campo título precisa ter no mínimo 5 caracteres.');
        }

        if (strlen($this->titulo) > 255) {
            $this->setErroMensagem('titulo', 'Campo título precisa ter no máximo 255 caracteres.');
        }

        if (strlen($this->descricao) <= 5) {
            $this->setErroMensagem('descricao', 'Campo descrição precisa ter no mínimo 10 caracteres.');
        }

        if (strlen($this->descricao) > 255) {
            $this->setErroMensagem('descricao', 'Campo descrição precisa ter no máximo 255 caracteres.');
        }

        if (strlen($this->ingredientes) <= 15) {
            $this->setErroMensagem('ingredientes', 'Campo ingredientes precisa ter no mínimo 15 caracteres.');
        }
    }
}
