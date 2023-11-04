<?php
require_once __DIR__ . "/../../src/dao/usuariodao.php";
require_once __DIR__ . "/../../src/models/usuario.php";

$nome = trim(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
$status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_NUMBER_INT)?? 0;
$perfil = filter_input(INPUT_POST, "perfil", FILTER_SANITIZE_NUMBER_INT)?? 0;
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;

$dados = new Usuario($id, $nome, $email, new Perfil($perfil, "", ""));
$dao = new UsuarioDAO();
if ($id === 0) {
    if ($dao->save($dados)) {
        header("location: index.php?msg=Usu[ario criado com sucesso!", 201);
    } else {
        header("location: index.php?error=Erro ao criar usuário!", 301);
    }
} else {
    $dados->setStatus($status);
    if ($dao->update($dados)) {
        header("location: index.php?msg=Usuário atualizado com sucesso!", 204);
    } else {
        header("location: index.php?error=Erro ao alterar usuário!", 301);
    }
}
    