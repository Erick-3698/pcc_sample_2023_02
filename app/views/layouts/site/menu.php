<?php require_once __DIR__ . "/../../auth/seguranca.php"; ?>
<header class="main_header">
    <div class="main_header_content">
        <a href="#" class="logo">
            <img src="assets/img/logo.png" alt="Bem vindo ao projeto prático Html5 e Css3 Essentials" title="Bem vindo ao projeto prático Html5 e Css3 Essentials"></a>

        <nav class="main_header_content_menu">
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Blog</a></li>
                <li><a href="#escola">Escola</a></li>
                <li><a href="#contato">Contato</a></li>
                <?php
                # verifica se existe sessão de usuario e se ele é administrador.
                # se não for o primeiro caso, verifica se a sessao existe.
                # por ultimo adiciona somente o link para o login se a sessão não existir. 

                if (Seguranca::isLogado() && !Seguranca::isUsuario()) {
                    echo "<li><a href='usuario_admin.php'>Admin</a></li>";
                    echo "<li><a href='auth/logout.php'>Sair</a></li>";
                } else if (isset($_SESSION['usuario'])) {
                    echo "<li><a href='auth/logout.php'>Sair</a></li>";
                } else {
                    echo "<li><a href='auth/login.php' class='modal-link'>Login</a>";
                }
                ?>
            </ul>
        </nav>
    </div>
    <?php if (Seguranca::isLogado()): ?>
        <p style="text-align: right;color: #fff;padding: 10px 20px;"><b>Usuário: </b><?=Seguranca::getUsuarioLogado()?></p>
    <?php endif ?>
</header>