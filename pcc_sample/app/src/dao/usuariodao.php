<?php
require_once __DIR__ . '/../database/conexao.php';


class UsuarioDAO
{
    private $dbh;

    public function __construct()
    {
        $this->dbh = Conexao::getConexao();
    }

    public function getAll()
    {
        $query = "SELECT * FROM usuarios ORDER BY nome;";

        $stmt = $this->dbh->query($query);
        $rows = $stmt->fetchAll();
        $this->dbh = null;

        return $rows;
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM usuarios WHERE id = :id;";

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
            $query = "DELETE FROM usuarios WHERE id = :id;";

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

    public function save(Usuario $usuario): int
    {
        try {
            $query = "INSERT INTO usuarios (email, `password`, nome, `status`, data_cadastro, perfil_id) 
                VALUES (:email, :password, :nome, :status, :data_cadastro, :perfil_id);";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':password', $usuario->getPassword());
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':status', $usuario->getStatus());
            $stmt->bindValue(':data_cadastro', $usuario->getDataCadastro());
            $stmt->bindValue(':perfil_id', $usuario->getPerfil()->getId());

            $result = (int) $stmt->execute();
            $this->dbh = null;

            return $result;
        } catch (\PDOException $e) {
            return 0;
        }
    }

    public function update(Usuario $usuario): int
    {
        try {
            $query = "UPDATE usuarios SET 
                email = :email,
                nome = :nome,
                status = :status,
                perfil_id = :perfil_id
                WHERE id = :id;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':status', $usuario->getStatus());
            $stmt->bindValue(':perfil_id', $usuario->getPerfil()->getId());
            $stmt->bindValue(':id', $usuario->getId());

            $result = $stmt->execute();
            $this->dbh = null;

            return $result;
        } catch (\PDOException $e) {
            return 0;
        }
    }
}
