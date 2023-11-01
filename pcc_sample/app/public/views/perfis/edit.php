<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../../src/dao/perfildao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
$dao = new PerfilDAO();
$perfil = $dao->getById($id);
if (!$perfil) {
    header("location: index.php?error=Perfil não encontrado!", 301);
}
?>

<form method="post" action="store.php">
    <input type="hidden" 
        name="id" 
        value="<?= $perfil['id'] ?? 0 ?>"
    >
    <input type="text" 
        name="sigla" 
        placeholder="Informe a sigla" 
        maxlength="3" 
        required 
        autofocus 
        value="<?= $perfil['sigla'] ?? '' ?>"
    >
    <input type="text" 
        name="nome" 
        placeholder="Informe o nome" 
        required 
        value="<?= $perfil['nome'] ?? '' ?>"
    >
    <button type="submit">Save</button>
</form>
<a href="index.php">Voltar</a>

<?php require_once __DIR__ . "/../layouts/admin/footer.php" ?>
<?php ?>