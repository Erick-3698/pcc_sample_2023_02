<?php 
require_once __DIR__ ."/../layouts/admin/header.php"; 
?>

<form method="post" action="store.php">
    <input type="text" 
        name="nome" 
        placeholder="Informe o nome"
        required
        autofocus
    >
    <select name="status">
        <option value="1">ATIVO</option>
        <option value="0">INATIVO</option>
    </select>
    <button type="submit">Save</button>
</form>
<a href="index.php">Voltar</a>

<?php require_once __DIR__ ."/../layouts/admin/footer.php" ?>
<?php ?>