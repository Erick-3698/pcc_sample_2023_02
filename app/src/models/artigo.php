<?php
require_once __DIR__ . "/enumstatus.php";
require_once __DIR__ . "/categoria.php";
require_once __DIR__ . "/usuario.php";

class Artigo
{
    private $id;
    private $titulo;
    private $texto;
    private $status = EnumStatus::ATIVO;
    private $dataPublicacao;
    private $image;
    private $categoria;
    private $usuario;

    public function __construct($id, $titulo, $texto, $status, $dataPublicacao, $image, $categoria, $usuario)
    {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->texto = $texto;
        $this->status = $status;
        $this->dataPublicacao = $dataPublicacao;
        $this->image = $image;
        $this->categoria = $categoria;
        $this->usuario = $usuario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getTexto()
    {
        return $this->texto;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getDataPublicacao()
    {
        return $this->dataPublicacao;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function setTexto($texto)
    {
        $this->texto = $texto;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setDataPublicacao($dataPublicacao)
    {
        $this->dataPublicacao = $dataPublicacao;
    }
    public function setImage($image)
    {
        $this->image = $image;
    }
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }
}
