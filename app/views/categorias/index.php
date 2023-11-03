<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../../src/dao/categoriadao.php";

$dao = new CategoriaDAO();
$categorias = $dao->getAll();
?>
<ul>
    <?php foreach ($categorias as $categoria) : ?>
        <li>
            <a href="edit.php?id=<?=$categoria['id']?>"><?=$categoria["nome"]?></a> |
            <a href="delete.php?id=<?=$categoria['id']?>">Delete</a>
        </li>
    <?php endforeach ?>
</ul>
<a href="create.php">Novo</a>
<?php require_once __DIR__ . "/../layouts/admin/footer.php" ?>
<?php ?>