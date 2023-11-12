<?php
require_once __DIR__ . "/../../src/dao/perfildao.php";

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
$dao = new PerfilDAO();
if ($dao->delete($id)) {
    header("location: index.php?msg=Perfil excluido com sucesso!", 204);
} else {
    header("location: index.php?error=Erro ao excluir perfil!", 301);
}
exit;
