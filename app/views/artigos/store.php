<?php
require_once __DIR__ . "/../../src/dao/artigodao.php";
require_once __DIR__ . "/../../src/models/usuario.php";
require_once __DIR__ . "/../../src/models/categoria.php";
require_once __DIR__ . "/../../src/models/artigo.php";

session_start();

const UPLOAD_DIR = __DIR__ ."/../assets/img/artigos/";

$usuario = $_SESSION['usuario'];
if (!$usuario) {
    header('location: ../auth/login.php', 301);
    exit;
}
$usuarioId = $usuario['id'];


$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;
$titulo = trim(filter_input(INPUT_POST, "titulo", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$texto = trim(filter_input(INPUT_POST, "texto", FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$dataPublicacao = trim(filter_input(INPUT_POST, "dataPublicacao", FILTER_SANITIZE_FULL_SPECIAL_CHARS));

$categoriaId = filter_input(INPUT_POST, "categoria", FILTER_SANITIZE_NUMBER_INT)?? 0;

$status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_NUMBER_INT)?? 0;
$status = $status == "1" ? EnumStatus::ATIVO : EnumStatus::INATIVO;

$imagem = getImagem();

if ($id != "0" && $imagem == null) {
    $imagem = filter_input(INPUT_POST, "imagem", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

$dados = new Artigo($id, $titulo, $texto, $status, $dataPublicacao, $imagem, $categoriaId, $usuarioId);
// var_dump($dados, $titulo); exit;
$dao = new ArtigoDAO();
if ($id === 0) {
    if ($dao->save($dados)) {
        header("location: index.php?msg=Artigo criado com sucesso!", 201);
    } else {
        header("location: index.php?error=Erro ao criar artigo!", 301);
    }
} else {
    if ($dao->update($dados)) {
        header("location: index.php?msg=Artigo atualizado com sucesso!", 204);
    } else {
        header("location: index.php?error=Erro ao alterar artigo!", 301);
    }
}


function getImagem() 
{
    if ($_FILES['file']["tmp_name"] == "") {
        return null;
    }
    $tmp = $_FILES['file']['tmp_name'];
    $type = explode('.', $_FILES['file']['name'])[1];
    $filename = uniqid("", true) . '.'. $type;
    $filenamewithpath = UPLOAD_DIR . $filename;
    $success = move_uploaded_file($tmp, $filenamewithpath);
    if ($success) {
        return $filename;
    } else {
        return null;
    }
    
}