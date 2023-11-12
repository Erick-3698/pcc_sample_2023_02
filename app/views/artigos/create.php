<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../src/dao/categoriadao.php";
require_once __DIR__ . "/../auth/seguranca.php";

if (Seguranca::isUsuario()) {
    header("location: ../index.php?error=Usuário não tem permissão para acessar esse recurso.", 301);
    exit;
}
$dao = new CategoriaDAO();
$rows = $dao->getAll();

?>
<main>
    <div class="main_opc">

        <section class="main_course" id="escola">
            <header class="novo__form__titulo">
                <h2>Artigos</h2>
            </header>

            <div class="novo__form__section">
                <form method="post" action="store.php" enctype="multipart/form-data" class="novo__form">
                    <div class="novo__form__section">
                        <label>Data da Publicação</label>
                        <input type="date" name="dataPublicacao" required>
                    </div>

                    <div class="novo__form__section">
                        <label>Título</label>
                        <input type="text" name="titulo" placeholder="Informe o título" required autofocus>
                    </div>

                    <div class="novo__form__section">
                        <label>Texto</label>
                        <textarea name="texto" cols="30" rows="10"></textarea>
                    </div>

                    <div class="novo__form__section">
                        <label>Status</label>
                        <select name="status">
                            <option value="1">ATIVO</option>
                            <option value="0">INATIVO</option>
                        </select>
                    </div>

                    <div class="novo__form__section">
                        <label>Categoria</label>
                        <select name="categoria">
                            <?php foreach ($rows as $row) : ?>
                                <option value="<?= $row['id'] ?>"><?= $row['nome'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <div class="novo__form__section">
                        <label>Imagem</label>
                        <input type="file" name="imagem" placeholder="Informe o imagem" accept="image/png, image/jpeg" required>
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