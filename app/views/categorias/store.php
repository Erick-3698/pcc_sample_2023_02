<?php
require_once __DIR__ . "/../../src/dao/categoriadao.php";
require_once __DIR__ . "/../../src/models/categoria.php";

$nome = trim(filter_input(INPUT_POST, "nome", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_NUMBER_INT)?? 0;
$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;

$dados = new Categoria($id, $nome, $status);
$dao = new CategoriaDAO();
if ($id === 0) {
    if ($dao->save($dados)) {
        header("location: index.php?msg=Categoria criado com sucesso!", 201);
    } else {
        header("location: index.php?error=Erro ao criar categoria!", 301);
    }
} else {
    if ($dao->update($dados)) {
        header("location: index.php?msg=Categoria atualizado com sucesso!", 204);
    } else {
        header("location: index.php?error=Erro ao alterar categoria!", 301);
    }
}
    