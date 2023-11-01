<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../../src/dao/categoriadao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
$dao = new CategoriaDAO();
$categoria = $dao->getById($id);
if (!$categoria) {
    header("location: index.php?error=Categoria não encontrado!", 301);
}
?>

<form method="post" action="store.php">
    <input type="hidden" 
        name="id" 
        value="<?= $categoria['id'] ?? 0 ?>"
    >
    <input type="text" 
        name="nome" 
        placeholder="Informe o nome"
        required
        autofocus
        value="<?= $categoria['nome'] ?? '' ?>"
    >
    <select name="status">
        <option value="1" <?=$categoria['status']=="1"? 'selected': ''?>>ATIVO</option>
        <option value="0" <?=$categoria['status']=="0"? 'selected': ''?>>INATIVO</option>
    </select>
    <button type="submit">Save</button>
</form>
<a href="index.php">Voltar</a>
<?php require_once __DIR__ . "/../layouts/admin/footer.php" ?>
<?php ?>