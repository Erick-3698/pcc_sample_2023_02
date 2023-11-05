<!--DOBRA CABEÇALHO-->

<header class="main_header">
    <div class="main_header_content">
        <a href="index.php" class="logo">
            <img src="assets/img/logo.png" alt="Bem vindo ao projeto prático Html5 e Css3 Essentials" title="Bem vindo ao projeto prático Html5 e Css3 Essentials"></a>

        <nav class="main_header_content_menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="auth/logout.php">Sair</a></li>

            </ul>
        </nav>
    </div>
    <p style="text-align: right;color: #fff;padding-right:20px; padding-bottom: 5px;"><b>Usuário: </b><?=Seguranca::getUsuarioLogado()?></p>
</header>

<style>
    .main_cta {
        width: 100%;
        background-image: url("assets/img/bg_main_home.png");
        background-color: #2d3142;
        background-repeat: no-repeat;
        background-position: center center;
        background-size: cover;
    }
</style>