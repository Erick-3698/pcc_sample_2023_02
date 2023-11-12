<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../src/dao/artigodao.php";

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;

$dao = new ArtigoDAO();
$artigo = $dao->getById($id);
if (!$artigo) {
    header("location: index.php?error=Artigo não encontrado!", 301);
}
$dataPublicacao = date_create($artigo['data_publicacao']);
$dataPublicacao = date_format($dataPublicacao, "d/m/Y");

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

                    <div class="novo__form__section">
                        <img src="<?=$imagem?>" alt="<?=$artigo['titulo']?>" title="<?=$artigo['titulo'] ?>" style="height:300px;width:100%;">
                    </div>

                    <div class="novo__form__section">
                        <label>Data da Publicação:</label>
                        <input type="text" name="dataPublicacao" value="<?= $dataPublicacao ?>" disabled>
                    </div>

                    <div class="novo__form__section">
                        <label>Título</label>
                        <input type="text" name="titulo" placeholder="Informe o título" value="<?= $artigo['titulo'] ?>" disabled>
                    </div>

                    <div class="novo__form__section">
                        <label>Texto</label>
                        <textarea name="texto" cols="30" rows="10" disabled><?= $artigo['texto'] ?></textarea>
                    </div>

                    <div class="novo__form__section">
                        <label>Status</label>
                        <input type="text" value="<?= $artigo['status'] == '1' ? 'ATIVO' : 'INATIVO' ?>" disabled>
                    </div>

                    <div class="novo__form__section">
                        <label>Categoria</label>
                        <input type="text" name="titulo" placeholder="Informe o título" value="<?= $artigo['categoria'] ?>" disabled>
                    </div>
                    
                    <div class="novo__form__section">
                        <a href="../index.php" class="btn">Voltar</a>
                    </div>
                </form>

            </div>
        </section>
    </div>
</main>

</body>

</html>