<?php
require_once __DIR__ . "/../../src/dao/usuariodao.php";

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
$dao = new UsuarioDAO();
if ($dao->delete($id)) {
    header("location: index.php?msg=Usuário excluido com sucesso!", 204);
} else {
    header("location: index.php?error=Erro ao excluir usuário!", 301);
}
exit;
