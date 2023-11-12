<?php
# para trabalhar com sessões sempre iniciamos com session_start.
session_start();
require_once __DIR__ . "/auth/seguranca.php";
# inclui o arquivo header
require_once 'layouts/site/header.php';

# verifica se existe sessão de usuario e se ele é administrador.
# se não existir redireciona o usuario para a pagina principal com uma mensagem de erro.
# sai da pagina.
if (Seguranca::isLogado() && Seguranca::isUsuario()) {
    header("Location: index.php?error=Usuário não tem permissão para acessar esse recurso");
    exit;
}
?>

<body>
    <?php require_once 'layouts/admin/menu.php'; ?>

    <main>
        <div class="main_opc">

            <section class="main_course" id="escola">
                <header class="main_course_header">

                </header>
                <div class="main_course_content">
                    <?php if (Seguranca::isAdminstrador()) : ?>
                        <article>
                            <h2 align="center">Usuários</h2>
                            <header>

                                <p align="center"><a href="usuarios/"><img src="assets/img/instrutor.png" width="350"></a></p>

                            </header>
                        </article>

                        <article>
                            <h2 align="center">Perfis</h2>
                            <header>

                                <p align="center">
                                    <a href="perfis/"><img src="assets/img/categorias.png" width="350"></a>
                                </p>

                            </header>
                        </article>
                    <?php endif ?>

                    <article>
                        <h2 align="center">Artigos</h2>
                        <header>

                            <p align="center"><a href="artigos/"><img src="assets/img/listar.png" width="350"></a></p>

                        </header>
                    </article>
                    
                    <?php if (Seguranca::isAdminstrador() || Seguranca::isGerente()) : ?>
                    <article>
                        <h2 align="center">Categorias</h2>
                        <header>

                            <p align="center"><a href="categorias/"><img src="assets/img/cadastro.png" width="350"></a></p>

                        </header>
                    </article>
                    <?php endif ?>

                </div>
                </article>
            </section>
        </div>

    </main>
    <!--FIM DOBRA PALCO PRINCIPAL-->

</body>


</html>