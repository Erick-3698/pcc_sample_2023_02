<?php
require_once __DIR__ . '/../database/conexao.php';


class ArtigoDAO
{
    private $dbh;

    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    public function getAll()
    {
        $query = "SELECT * FROM artigos;";

        $stmt = $this->dbh->query($query);
        $rows = $stmt->fetchAll();
        $this->dbh = null;

        return $rows;
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM artigos WHERE id = :id;";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_BOTH);
        $this->dbh = null;

        return $row;
    }

    public function delete(int $id): int
    {
        try {
            $query = "DELETE FROM artigos WHERE id = :id;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $result = (int) $stmt->rowCount();
            $this->dbh = null;

            return $result;
        } catch (\PDOException $e) {
            return 0;
        }
    }

    public function save(Artigo $artigo): int
    {
        try {
            $query = "INSERT INTO artigos (titulo, texto, status, data_publicacao, imagem, categoria_id, usuario_id) 
                VALUES (:titulo, :texto, :status, :data_publicacao, :imagem, :categoria_id, :usuario_id);";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(':titulo', $artigo->getTitulo());
            $stmt->bindValue(':texto', $artigo->getTexto());
            $stmt->bindValue(':status', $artigo->getStatus());
            $stmt->bindValue(':data_publicacao', $artigo->getDataPublicacao());
            $stmt->bindValue(':imagem', $artigo->getImage());
            $stmt->bindValue(':categoria_id', $artigo->getCategoria()->getId());
            $stmt->bindValue(':usuario_id', $artigo->getUsuario()->getId());

            $result = (int) $stmt->execute();
            $this->dbh = null;

            return $result;
        } catch (\PDOException $e) {
            return 0;
        }
    }

    public function update(Artigo $artigo): int
    {
        try {
            $query = "UPDATE artigos SET 
                titulo = :titulo, 
                texto = :texto, 
                status = :status, 
                data_publicacao = :data_publicacao, 
                imagem = :imagem, 
                categoria_id = :categoria_id, 
                usuario_id = :usuario_id
                WHERE id = :id;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(':titulo', $artigo->getTitulo());
            $stmt->bindValue(':texto', $artigo->getTexto());
            $stmt->bindValue(':status', $artigo->getStatus());
            $stmt->bindValue(':data_publicacao', $artigo->getDataPublicacao());
            $stmt->bindValue(':imagem', $artigo->getImage());
            $stmt->bindValue(':categoria_id', $artigo->getCategoria()->getId());
            $stmt->bindValue(':usuario_id', $artigo->getUsuario()->getId());
            $stmt->bindValue(':id', $artigo->getId());

            $result = $stmt->execute();
            $this->dbh = null;

            return $result;
        } catch (\PDOException $e) {
            return 0;
        }
    }
}
