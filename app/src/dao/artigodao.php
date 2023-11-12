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
        $query = "SELECT 
                    artigos.id, artigos.titulo, artigos.texto, artigos.status, artigos.data_publicacao,
                    artigos.imagem, artigos.categoria_id, artigos.usuario_id, 
                    categorias.nome as categoria,
                    usuarios.nome as usuario
                FROM artigos
                INNER JOIN categorias ON categorias.id = artigos.categoria_id
                INNER JOIN usuarios ON usuarios.id = artigos.usuario_id
                ORDER BY artigos.data_publicacao DESC, 
                    categorias.nome;";

        $stmt = $this->dbh->query($query);
        $rows = $stmt->fetchAll();
        $this->dbh = null;

        return $rows;
    }

    public function getByCategoriaIdOrTitulo($categoriaId, $titulo)
    {
        $query = "SELECT 
                    artigos.id, artigos.titulo, artigos.texto, artigos.status, artigos.data_publicacao,
                    artigos.imagem, artigos.categoria_id, artigos.usuario_id, 
                    categorias.nome as categoria,
                    usuarios.nome as usuario
                FROM artigos
                INNER JOIN categorias ON categorias.id = artigos.categoria_id
                INNER JOIN usuarios ON usuarios.id = artigos.usuario_id ";
        if ($titulo != "") {
            $query .= " WHERE artigos.titulo like :titulo";
        } else {
            $query .= " WHERE artigos.categoria_id = :categoriaId";
        }
        $query .= " ORDER BY artigos.data_publicacao DESC, 
                    categorias.nome;";

        $stmt = $this->dbh->prepare($query);
        if ($titulo != "") {
            $stmt->bindValue(':titulo', "%" . $titulo . "%" );
        } else {
            $stmt->bindValue(':categoriaId', $categoriaId);
        }
            $stmt->execute();
        $rows = $stmt->fetchAll();
        $this->dbh = null;

        return $rows;
    }

    public function getById(int $id)
    {
        $query = "SELECT 
                    artigos.id, artigos.titulo, artigos.texto, artigos.status, artigos.data_publicacao,
                    artigos.imagem, artigos.categoria_id, artigos.usuario_id, 
                    categorias.nome as categoria,
                    usuarios.nome as usuario
                FROM artigos
                INNER JOIN categorias ON categorias.id = artigos.categoria_id
                INNER JOIN usuarios ON usuarios.id = artigos.usuario_id
                WHERE artigos.id = :id;";

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
            $stmt->bindValue(':categoria_id', $artigo->getCategoria());
            $stmt->bindValue(':usuario_id', $artigo->getUsuario());

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
            $stmt->bindValue(':categoria_id', $artigo->getCategoria());
            $stmt->bindValue(':usuario_id', $artigo->getUsuario());
            $stmt->bindValue(':id', $artigo->getId());

            $result = $stmt->execute();
            $this->dbh = null;

            return $result;
        } catch (\PDOException $e) {
            return 0;
        }
    }
}
