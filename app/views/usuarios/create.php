<?php 
require_once __DIR__ . "/../layouts/admin/header.php"; 
require_once __DIR__ . "/../../src/dao/perfildao.php";
require_once __DIR__ . "/../auth/seguranca.php";

if (!Seguranca::isAdminstrador()) {
    header("location: ../index.php?error=Usuário não tem permissão para acessar esse recurso.", 301);
    exit;
}

$dao = new PerfilDAO();
$rows = $dao->getAll();
?>
<main>
    <div class="main_opc">

        <section class="main_course" id="escola">
            <header class="novo__form__titulo">
                <h2>Usuários</h2>
            </header>
            <div class="novo__form__section">
                <form method="post" action="store.php" class="novo__form">
                    <div class="novo__form__section">
                        <label>Nome</label>
                        <input class="input" type="nome" name="nome" placeholder="Informe o nome do usuário." size="60" required autofocus>
                    </div>
                    <div class="novo__form__section">
                        <label>E-mail</label>
                        <input type="email" name="email" placeholder="Informe o e-mail do usuário." required>
                    </div>
                    <div class="novo__form__section">
                        <label>Status</label>
                        <select name="status" disabled>
                            <option value="1">ATIVO</option>
                            <option value="0">INATIVO</option>
                        </select>
                    </div>
                    <div class="novo__form__section">
                        <label>Perfil</label>
                        <select name="perfil">
                            <?php foreach($rows as $row):?>
                                <option value="<?=$row['id']?>"><?=$row['nome']?></option>
                            <?php endforeach ?>
                        </select>
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