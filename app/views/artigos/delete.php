<?php
require_once __DIR__ . "/../../src/dao/artigodao.php";

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
$dao = new ArtigoDAO();
if ($dao->delete($id)) {
    header("location: index.php?msg=Artigo excluido com sucesso!", 204);
} else {
    header("location: index.php?error=Erro ao excluir artigo!", 301);
}
exit;
