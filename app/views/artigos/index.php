<?php
require_once __DIR__ . "/../layouts/admin/header.php";
require_once __DIR__ . "/../../src/dao/artigodao.php";
require_once __DIR__ . "/../auth/seguranca.php";

if (Seguranca::isUsuario()) {
    header("location: ../index.php?error=Usuário não tem permissão para acessar esse recurso.", 301);
    exit;
}
$dao = new ArtigoDAO();
$rows = $dao->getAll();

?>
<main>
    <div class="main_opc">
        <section class="main_course" id="escola">
            <header class="novo__form__titulo">
                <h2>Artigos</h2>
            </header>

            <?php if (isset($_GET['error'])  || isset($_GET['msg'])) : ?>
                <script>
                    Swal.fire({
                        icon: '<?= isset($_GET['error']) ? 'error' : 'success' ?>',
                        title: 'PccSample',
                        text: '<?= $_GET['error'] ?? $_GET['msg'] ?>',
                    })
                </script>
            <?php endif ?>


            <div class="main_course_content">
                <div style="text-align: right;width: 100%;">
                    <button class="btn" style="min-height: 40px; margin-bottom: 10px;" onclick="javascript:window.location='create.php'">Novo</button>
                </div>

                <section>
                    <table border="0" class="table" style="width:98vw;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Título</th>
                                <th>Data publicação</th>
                                <th>Categoria</th>
                                <th>Status</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!$rows) : ?>
                                <tr>
                                    <td colspan="5"><strong>Não existem dados cadastrados.</strong></td>
                                </tr>
                                <?php else : $count = 1;
                                foreach ($rows as $row) :  ?>
                                    <tr>
                                        <td><?= $count++;  ?></td>
                                        <td><?= $row["titulo"] ?></td>
                                        <td><?= $row["data_publicacao"] ?></td>
                                        <td><?= $row["categoria"] ?></td>
                                        <td><?= $row["status"] == "1" ? 'ATIVO': 'INATIVO' ?></td>
                                        <td>
                                            <div style="display:flex;">
                                                <a href="edit.php?id=<?= $row['id'] ?>" class="btn">Editar</a>&nbsp;
                                                <form action="delete.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                                                    <button class="btn" name="botao" value="deletar" onclick="return confirm('Deseja excluir o registro?');">Apagar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                            <?php endforeach;
                            endif ?>
                        </tbody>
                    </table>
                </section>
            </div>
        </section>
    </div>

</main>

</body>

</html>