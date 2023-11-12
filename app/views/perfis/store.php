<?php
require_once __DIR__ . "/../../src/dao/perfildao.php";
require_once __DIR__ . "/../../src/models/perfil.php";

$nome = trim(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$sigla = strtoupper(trim(filter_input(INPUT_POST, "sigla", FILTER_SANITIZE_FULL_SPECIAL_CHARS)));
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;

$perfil = new Perfil($id, $nome, $sigla);
$dao = new PerfilDAO();
if ($id === 0) {
    if ($dao->save($perfil)) {
        header("location: index.php?msg=Perfil criado com sucesso!", 201);
    } else {
        header("location: index.php?error=Erro ao criar perfil!", 301);
    }
} else {
    if ($dao->update($perfil)) {
        header("location: index.php?msg=Perfil atualizado com sucesso!", 204);
    } else {
        header("location: index.php?error=Erro ao alterar perfil!", 301);
    }
}
    