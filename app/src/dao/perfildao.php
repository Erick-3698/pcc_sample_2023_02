<?php
require_once __DIR__ . '/../database/conexao.php';

class PerfilDAO
{
    private $dbh;

    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    public function getAll()
    {
        $query = "SELECT * FROM perfis;";

        $stmt = $this->dbh->query($query);
        $rows = $stmt->fetchAll();
        $this->dbh = null;

        return $rows;
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM perfis WHERE id = :id;";

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
            $query = "DELETE FROM perfis WHERE id = :id;";

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

    public function save(Perfil $perfil): int
    {
        try {
            $query = "INSERT INTO perfis (nome, sigla) 
                VALUES (:nome, :sigla);";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(':nome', $perfil->getNome());
            $stmt->bindValue(':sigla', $perfil->getSigla());

            $result = (int) $stmt->execute();
            $this->dbh = null;

            return $result;
        } catch (\PDOException $e) {
            return 0;
        }
    }

    public function update(Perfil $perfil): int
    {
        try {
            $query = "UPDATE perfis SET 
                nome = :nome,
                sigla = :sigla
                WHERE id = :id;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(':nome', $perfil->getNome());
            $stmt->bindValue(':sigla', $perfil->getSigla());
            $stmt->bindValue(':id', $perfil->getId());

            $result = $stmt->execute();
            $this->dbh = null;

            return $result;
        } catch (\PDOException $e) {
            return 0;
        }
    }
}
