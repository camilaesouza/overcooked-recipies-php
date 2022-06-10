<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_ID = 'SELECT * FROM usuarios WHERE id = ?';
    const BUSCAR_LOGIN = 'SELECT * FROM usuarios WHERE email = ?';
    const INSERIR = 'INSERT INTO usuarios(nome, email, senha) VALUES (?, ?, ?)';
    const CONTAR_TODOS = 'SELECT count(id) FROM usuarios';

    private $id;
    private $nome;
    private $email;
    private $senha;
    private $senhaPlana;

    public function __construct(
        $nome = null,
        $email = null,
        $senhaPlana = null,
        $id = null
        ) {
        $this->nome = $nome;
        $this->email = $email;
        $this->senhaPlana = $senhaPlana;
        $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    public function salvar()
    {
        $this->inserir();

        return $this;
    }

    public function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(2, $this->email, PDO::PARAM_STR);
        $comando->bindValue(3, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarLogin($login)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_LOGIN);
        $comando->bindValue(1, $login, PDO::PARAM_STR);
        $comando->execute();
        $registro = $comando->fetch();

        $usuario = null;
        if ($registro) {
            $usuario = new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['id']
                );
            $usuario->senha = $registro['senha'];
        }

        return $usuario;
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();

        $registro = $comando->fetch();
        return new Usuario(
                $registro['nome'],
                $registro['email'],
                '',
                $registro['id']
            );
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    protected function verificarErros()
    {
        if ($this->nome == null) {
            $this->setErroMensagem('nome', 'Campo nome é obrigátorio!');
        }

        if (!(filter_var($this->email, FILTER_VALIDATE_EMAIL))) {
            $this->setErroMensagem('email', 'Campo email é inválido!');
        }

        if (!!$this->buscarLogin($this->email)) {
            $this->setErroMensagem('email', 'Email já cadastrado!');
        }

        if ($this->senhaPlana == null) {
            $this->setErroMensagem('senha', 'Campo senha é obrigátorio!');

        } elseif (strlen($this->senhaPlana) < 8) {
            $this->setErroMensagem('senha', 'Campo senha deve conter no mínimo 8 caracteres');
        }
    }
}
