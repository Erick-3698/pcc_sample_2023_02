<?php
require_once __DIR__ . "/../../src/dao/categoriadao.php";

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
$dao = new CategoriaDAO();
if ($dao->delete($id)) {
    header("location: index.php?msg=Categoria excluido com sucesso!", 204);
} else {
    header("location: index.php?error=Erro ao excluir categoria!", 301);
}
exit;
