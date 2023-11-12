<?php
require_once __DIR__ . "/enumstatus.php";
require_once __DIR__ . "/perfil.php";
class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $password;
    private $status;
    private $dataCadastro;
    private Perfil $perfil;


    public function __construct($id, $nome, $email, $perfil)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->perfil = $perfil;
        $this->status = EnumStatus::ATIVO;
        $this->password = md5("123");
        $this->dataCadastro = date("Y-m-d H:i:s");
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
    public function getPerfil()
    {
        return $this->perfil;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function getStatus()
    {
        return $this->status;
    }
    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }


    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function setPerfil($perfil)
    {
        $this->perfil = $perfil;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
