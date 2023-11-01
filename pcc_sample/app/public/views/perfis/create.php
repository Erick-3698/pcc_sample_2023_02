<?php 
require_once __DIR__ ."/../layouts/admin/header.php"; 
?>

<form method="post" action="store.php">
    <input type="text" 
        name="sigla" 
        placeholder="Informe a sigla"
        maxlength="3"
        required
        autofocus
    >
    <input type="text" 
        name="nome" 
        placeholder="Informe o nome"
        required
    >
    <button type="submit">Save</button>
</form>
<a href="index.php">Voltar</a>

<?php require_once __DIR__ ."/../layouts/admin/footer.php" ?>
<?php ?>