<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../src/dao/categoriadao.php";
require_once __DIR__ . "/../../src/dao/artigodao.php";
require_once __DIR__ . "/../auth/seguranca.php";

if (Seguranca::isUsuario()) {
    header("location: ../index.php?error=Usuário não tem permissão para acessar esse recurso.", 301);
    exit;
}
$categoriaDAO = new CategoriaDAO();
$rows = $categoriaDAO->getAll();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;

$dao = new ArtigoDAO();
$artigo = $dao->getById($id);
if (!$artigo) {
    header("location: index.php?error=Artigo não encontrado!", 301);
}
$dataPublicacao = date_create($artigo['data_publicacao']);
$dataPublicacao = date_format($dataPublicacao, "Y-m-d");

$imagem = (!empty(trim($artigo["imagem"])) ) ? $artigo["imagem"] : "semimagem.jpg";
$imagem = "../assets/img/artigos/" . $imagem;
?>
<main>
    <div class="main_opc">

        <section class="main_course" id="escola">
            <header class="novo__form__titulo">
                <h2>Artigos</h2>
            </header>

            <div class="novo__form__section">
                <form method="post" action="store.php" enctype="multipart/form-data" class="novo__form">
                    <input type="hidden" name="id" value="<?= $artigo['id'] ?>">
                    <input type="hidden" name="imagem" value="<?= $artigo['imagem'] ?>">

                    <div class="novo__form__section">
                        <label>Data da Publicação</label>
                        <input type="date" name="dataPublicacao" value="<?= $dataPublicacao ?>" required>
                    </div>

                    <div class="novo__form__section">
                        <label>Título</label>
                        <input type="text" name="titulo" placeholder="Informe o título" value="<?= $artigo['titulo'] ?>" required autofocus>
                    </div>

                    <div class="novo__form__section">
                        <label>Texto</label>
                        <textarea name="texto" cols="30" rows="10"><?= $artigo['texto'] ?></textarea>
                    </div>

                    <div class="novo__form__section">
                        <label>Status</label>
                        <select name="status">
                            <option value="1" <?= $artigo['status'] == '1' ? 'selected' : '' ?>>ATIVO</option>
                            <option value="0" <?= $artigo['status'] == '0' ? 'selected' : '' ?>>INATIVO</option>
                        </select>
                    </div>

                    <div class="novo__form__section">
                        <label>Categoria</label>
                        <select name="categoria">
                            <?php foreach ($rows as $row) : ?>
                                <option value="<?= $row['id'] ?>" <?= $artigo['categoria_id'] == $row['id'] ? 'selected' : '' ?>><?= $row['nome'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="novo__form__section">
                        <label>Imagem</label>
                        <input type="file" name="file" placeholder="Informe o imagem" accept="image/png, image/jpeg" value="<?=$artigo['imagem'] ?>">
                    </div>

                    <div class="novo__form__section">
                        <img src="<?=$imagem?>" alt="<?=$artigo['titulo']?>" title="<?=$artigo['titulo'] ?>" style="width:200px;">
                    </div>

                    <div class="novo__form__section">
                        <button type="submit" class="btn">Save</button>
                        <a href="index.php" class="btn">Voltar</a>
                    </div>
                </form>

            </div>
        </section>
    </div>
</main>

</body>

</html>