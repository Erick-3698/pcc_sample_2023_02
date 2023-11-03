<?php

class Categoria
{
    private $id;
    private $nome;
    private $status;

    public function __construct($id, $nome, $status)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->status = $status;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
}
