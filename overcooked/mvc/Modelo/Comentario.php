<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Comentario extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM comentarios WHERE id = ?';
    const BUSCAR_POR_RECEITA_ID = 'SELECT * FROM comentarios WHERE receita_id = ? order by data_criacao ASC';
    const INSERIR = 'INSERT INTO comentarios(comentario, receita_id, usuario_id, data_criacao) VALUES (?, ?, ?, now())';
    const DELETAR = 'DELETE FROM comentarios WHERE id = ?';

    private $id;
    private $comentario;
    private $receitaId;
    private $usuarioId;
    private $dataCriacao;

    public function __construct(
        $comentario,
        $receitaId,
        $usuarioId,
        $id = null,
        $dataCriacao = null
        ) {
        $this->id = $id;
        $this->comentario = $comentario;
        $this->receitaId = $receitaId;
        $this->usuarioId = $usuarioId;
        $this->dataCriacao = $dataCriacao;
    }

    public function getid()
    {
        return $this->id;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function getReceitaId()
    {
        return $this->receitaId;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getDataCriacao()
    {
        $date = date_create($this->dataCriacao);
        return date_format($date, 'd/m/Y H:i:s');
    }

    public function getUsuario()
    {
        return Usuario::buscarId($this->getUsuarioId());
    }

    public function salvar()
    {
        $this->inserir();

        return $this;
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->comentario);
        $comando->bindValue(2, $this->receitaId);
        $comando->bindValue(3, $this->usuarioId);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id,  PDO::PARAM_INT);
        $comando->execute();
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registro = $comando->fetch();

        if($registro) {
            return new Comentario(
            $registro['comentario'],
            $registro['receita_id'],
            $registro['usuario_id'],
            $registro['id'],
            $registro['data_criacao'],
            );
        }

        return null;
    }

    public static function buscarPorReceitaId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_RECEITA_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $comentarios = [];
        foreach ($registros as $registro) {
            $comentarios[] = new Comentario(
                $registro['comentario'],
                $registro['receita_id'],
                $registro['usuario_id'],
                $registro['id'],
                $registro['data_criacao'],
                );
        }
        return $comentarios;
    }

    protected function verificarErros()
    {
        if (strlen($this->comentario) < 3) {
            $this->setErroMensagem('comentario', 'Campo comentário precisa ter no mínimo 3 caracteres.');
        }
    }
}
