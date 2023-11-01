<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../../src/dao/perfildao.php";

$dao = new PerfilDAO();
$perfis = $dao->getAll();
?>
<ul>
    <?php foreach ($perfis as $perfil) : ?>
        <li>
            <a href="edit.php?id=<?=$perfil['id']?>"><?=$perfil["nome"]?></a> |
            <a href="delete.php?id=<?=$perfil['id']?>">Delete</a>
        </li>
    <?php endforeach ?>
</ul>
<a href="create.php">Novo</a>
<?php require_once __DIR__ . "/../layouts/admin/footer.php" ?>
<?php ?>