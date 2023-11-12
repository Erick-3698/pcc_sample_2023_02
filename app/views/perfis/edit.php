<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../src/dao/perfildao.php";
require_once __DIR__ . "/../auth/seguranca.php";

if (!Seguranca::isAdminstrador()) {
    header("location: ../index.php?error=Usuário não tem permissão para acessar esse recurso.", 301);
    exit;
}
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;

$dao = new PerfilDAO();
$perfil = $dao->getById($id);
if (!$perfil) {
    header("location: index.php?error=Perfil não encontrado!", 301);
}
?>
<main>
    <div class="main_opc">

        <section class="main_course" id="escola">
            <header class="novo__form__titulo">
                <h2>Perfis</h2>
            </header>
            <div class="novo__form__section">
                <form method="post" action="store.php" class="novo__form">
                    <input type="hidden" name="id" value="<?= $perfil['id'] ?? 0 ?>">
                    <div class="novo__form__section">
                        <input type="text" name="sigla" placeholder="Informe a sigla" maxlength="3" required autofocus value="<?= $perfil['sigla'] ?? '' ?>">
                    </div>
                    <div class="novo__form__section">
                        <input type="text" name="nome" placeholder="Informe o nome" required value="<?= $perfil['nome'] ?? '' ?>">
                    </div>
                    <div class="novo__form__section">
                        <button type="submit" class="btn">Save</button>
                        <a href="index.php" class="btn">Voltar</a>
                    </div>
                </form>

        </section>
    </div>
</main>

</body>

</html>