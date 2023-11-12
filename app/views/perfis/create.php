<?php 
require_once __DIR__ . "/../layouts/admin/header.php"; 
require_once __DIR__ . "/../auth/seguranca.php";

if (!Seguranca::isAdminstrador()) {
    header("location: ../index.php?error=Usuário não tem permissão para acessar esse recurso.", 301);
    exit;
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
                    <div class="novo__form__section">
                        <label>Sigla</label>
                        <input class="input" type="text" name="sigla" placeholder="Informe a sigla" maxlength="3" required autofocus>
                    </div>
                    <div class="novo__form__section">
                        <label>Nome</label>
                        <input type="text" name="nome" placeholder="Informe o nome" required>
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