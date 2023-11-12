<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../src/dao/perfildao.php";
require_once __DIR__ . "/../../src/dao/usuariodao.php";
require_once __DIR__ . "/../auth/seguranca.php";

if (!Seguranca::isAdminstrador()) {
    header("location: ../index.php?error=Usuário não tem permissão para acessar esse recurso.", 301);
    exit;
}
$perfilDAO = new PerfilDAO();
$rows = $perfilDAO->getAll();

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT) ?? 0;

$dao = new UsuarioDAO();
$usuario = $dao->getById($id);
if (!$usuario) {
    header("location: index.php?error=Usuário não encontrado!", 301);
}
?>
<main>
    <div class="main_opc">

        <section class="main_course" id="escola">
            <header class="novo__form__titulo">
                <h2>Usuários</h2>
            </header>
            <div class="novo__form__section">
                <form method="post" action="store.php" class="novo__form">
                    <input type="hidden" name="id" value="<?=$usuario['id']?>">
                    <div class="novo__form__section">
                        <label>Nome</label>
                        <input class="input" type="nome" name="nome" value="<?=$usuario['nome']?>" size="60" required autofocus>
                    </div>
                    <div class="novo__form__section">
                        <label>E-mail</label>
                        <input type="email" name="email" placeholder="Informe o e-mail do usuário." value="<?=$usuario['email']?>" required>
                    </div>
                    <div class="novo__form__section">
                        <label>Status</label>
                        <select name="status">
                            <option value="1" <?=$usuario['status'] == '1' ? 'selected': ''?>>ATIVO</option>
                            <option value="0" <?=$usuario['status'] == '0' ? 'selected': ''?>>INATIVO</option>
                        </select>
                    </div>
                    <div class="novo__form__section">
                        <label>Perfil</label>
                        <select name="perfil">
                            <?php foreach($rows as $row):?>
                                <option 
                                    value="<?=$row['id']?>"
                                    <?=$usuario['perfil_id'] == $row['id'] ? 'selected': ''?> 
                                ><?=$row['nome']?></option>
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