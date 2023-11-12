<?php
# para trabalhar com sessões sempre iniciamos com session_start.
session_start();

# inclui os arquivos header, menu e login.
require_once __DIR__ . "/layouts/site/header.php";
require_once __DIR__ . '/layouts/site/menu.php';
require_once __DIR__ . '/auth/login.php';
require_once __DIR__ . "/../src/dao/artigodao.php";
require_once __DIR__ . "/../src/dao/categoriadao.php";

const UPLOAD_DIR = "assets/img/artigos/";


$categoriaDAO = new CategoriaDAO();
$categorias = $categoriaDAO->getAll();

$categoriaId = isset($_GET['categoria']) ? $_GET['categoria'] : "0";
$filtroTitulo = isset($_GET['filtro']) ? trim($_GET['filtro']) : "";
$dao = new ArtigoDAO();
if ($categoriaId == "0" && $filtroTitulo == "") {
    $rows = $dao->getAll();
} else {
    $rows = $dao->getByCategoriaIdOrTitulo($categoriaId, $filtroTitulo);
}

?>

<!--DOBRA PALCO PRINCIPAL-->

<!--1ª DOBRA-->

<main>
    <?php if (isset($_GET['error'])  || isset($_GET['msg'])) : ?>
        <script>
            Swal.fire({
                icon: '<?= isset($_GET['error']) ? 'error' : 'success' ?>',
                title: 'PccSample',
                text: '<?= $_GET['error'] ?? $_GET['msg'] ?>',
            })
        </script>
    <?php endif ?>


    <!--INICIO SESSÃO SESSÃO DE ARTIGOS-->
    <section class="main_blog">
        <header class="main_blog_header">
            <h1 class="icon-blog">Nosso Últimos Artigos</h1>
            <p>Aqui você encontra os artigos necessários para auxiliar na sua caminhada web.</p>
            <div style="display: flex; justify-content: space-between;">
                <select name="categorias" onchange="filtroPorCategoria(this.value);" style="margin-top: 10px;width:50%;">
                    <option value="0">Todas as categorias</option>
                    <?php
                    foreach ($categorias as $categoria) {
                        echo "<option value='"
                            . $categoria['id'] . "'"
                            . ($categoriaId == $categoria['id'] ? ' selected' : '') . ">"
                            . $categoria['nome']
                            . "</option>";
                    }
                    ?>
                </select>
                <form style="width: 49%; display: flex;margin-top: 10px;gap: 5px;;">
                    <input 
                        type="text" 
                        name="filtro" 
                        placeholder="Informe o nome do artigo a ser buscado." 
                        value="<?= isset($_GET['filtro'])?$_GET['filtro']:'';?>" 
                        autofocus
                        style="width: 95%;">
                    <button type="submit" class="btn novo__form__btn__cadastrar">Buscar</button>
                </form>
                </div>
        </header>


        <?php foreach ($rows as $row) : ?>
            <?php $imagem = ($row['imagem'] == "" || is_null($row['imagem'])) ? "semimagem.jpg" : $row['imagem'];
            $imagem = UPLOAD_DIR . $imagem; ?>
            <article>
                <a href="artigos/show.php?id=<?= $row['id'] ?>">
                    <img src="<?= $imagem ?>" width="200px" height="200px" alt="<?= $row['titulo'] ?>" title="<?= $row['titulo'] ?>">
                </a>
                <p><a href="index.php?categoria=<?=$row['categoria_id']?>" class="category"><?= $row['categoria'] ?></a></p>
                <p class="title"><?= $row['titulo'] ?></p>
                <h2>
                    <p class="title" title="<?= $row['texto'] ?>">
                        <?= (strlen($row['texto']) > 100) ? substr($row['texto'], 0, 100) . "(...)" : substr($row['texto'], 0, strlen($row['texto'])) ?>
                    </p>
                </h2>
            </article>
        <?php endforeach ?>


    </section>

    <!--FIM SESSÃO SESSÃO DE ARTIGOS-->

    <!--INICIO SESSÃO OPTIN-->
    <article class="opt_in">
        <div class="opt_in_content">
            <header>
                <h1>Quer receber todas as novidades em seu e-mail?</h1>
                <p>Informe o seu nome e e-mail no campo ao lado e clique em Ok!</p>
            </header>
            <form>
                <input type="text" placeholder="Seu nome">
                <input type="email" placeholder="Seu email">
                <button type="submit">Ok</button>
            </form>
        </div>
    </article>

    <!--FIM SESSÃO OPTIN-->

    <!-- INICIO SESSÃO DOBRA  CURSOS-->
    <section class="main_course" id="escola">
        <header class="main_course_header">
            <img src="assets/img/logo.png" alt="img" title="img">
            <h1 class="icon-books">HTML5 e CSS3 Essentials</h1>
            <p>Aprenda a trabalhar com HTML5 e CSS3 para desenvolver seus projetos e entregar páginas que
                estejam dentro dos padrões da Web seguindo as boas práticas.</p>
        </header>
        <div class="main_course_content">
            <article>
                <header>
                    <h2>Curso 100% Online</h2>
                    <p>Todas as aulas são gravadas em estúdio profissional para que você tenha a máxima qualidade de
                        imagem e video</p>
                </header>
            </article>
            <article>
                <header>
                    <h2>Suporte Especializado</h2>
                    <p>Este curso possui suporte diretamente com um profissional da nossa equipe oficial</p>
                </header>
            </article>
            <article>
                <header>
                    <h2>Mais de 100 aulas divididas em 10 módulos</h2>
                    <p>A modularização que você precisa para compreender de maneira mais objetiva</p>
                </header>
            </article>
            <article>
                <header>
                    <h2>Certificado reconhecido em mais de 17 países</h2>
                    <p>Ao concluir o curso você terá um certificado com reconhecimento em diversos países da América
                        Latina</p>
                </header>
            </article>
        </div>
        <!-- FIM SESSÃO DOBRA  CURSOS-->

        <!--INICIO DOBRA REVIEWS-->
        <div class="main_course_fullwidth">
            <div class="main_course_ratting_content">
                <article class="main_course_rating_title">
                    <header>
                        <h2>Curso considerado 5 estrelas por nossos 100 alunos matriculados</h2>
                    </header>
                    <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                    <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                    <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                    <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                    <img src="assets/img/star.png" alt="Estrela" title="Estrela">
                </article>

                <section class="main_course_ratting_content_comment">
                    <header>
                        <h2>Veja o que estão falando sobre o curso</h2>
                    </header>
                    <article>
                        <header>
                            <h3> Instrutor Web</h3>
                            <p>03/03/2023</p>
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                        </header>
                        <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                            minhas
                            páginas em html5 e Css3</p>
                    </article>

                    <article>
                        <header>
                            <h3> Instrutor Web</h3>
                            <p>03/03/2023</p>
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                        </header>
                        <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                            minhas
                            páginas em html5 e Css3</p>
                    </article>

                    <article>
                        <header>
                            <h3> Instrutor Web</h3>
                            <p>03/03/2023</p>
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                        </header>
                        <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                            minhas
                            páginas em html5 e Css3</p>
                    </article>

                    <article>
                        <header>
                            <h3> Instrutor Web</h3>
                            <p>03/03/2023</p>
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                        </header>
                        <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                            minhas
                            páginas em html5 e Css3</p>
                    </article>

                    <article>
                        <header>
                            <h3> Instrutor Web</h3>
                            <p>03/03/2023</p>
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                        </header>
                        <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                            minhas
                            páginas em html5 e Css3</p>
                    </article>

                    <article>
                        <header>
                            <h3> Instrutor Web</h3>
                            <p>03/03/2023</p>
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                            <img src="assets/img/star.png" alt="Imagem" title="Imagem">
                        </header>
                        <p>O conteúdo é fantático, eu não tinha conhecimento nenhum e agora estou desenvolvendo
                            minhas
                            páginas em html5 e Css3</p>
                    </article>
                </section>
            </div>
        </div>
    </section>
    <!--DOBRA A ESCOLA-->
    <div class="main_school">
        <section class="main_school_content">
            <header class="main_school_header">
                <h1>Bem vindo a ETC - Escola técnica de Ceilândia</h1>
                <p>A sua Escola de programação e Marketing Digital</p>
            </header>
            <div class="main_school_content_left">
                <article class="main_school_content_left_content">
                    <header>
                        <p>
                            <span class="icon-facebook"><a href="#">Facebook</a>&nbsp;</span><span class="icon-google-plus2"><a href="#">Google+</a></span>&nbsp;<span class="icon-twitter"><a href="#">Twitter</a></span>
                        </p>
                        <h2>Tudo o que você precisa para ser um Webmaster FullStack em um só lugar</h2>
                    </header>
                    <p>Desde 1980 a ETC - vem criando os melhores cursos do mercado, entregamos ao aluno
                        conhecimento
                        prático e testado sem enrolção.Você tem acesso a aulas com a melhor qualidade, recursos que
                        aceleram seu aprendizado e muito mais...</p>
                    <p>Que tal estudar, e ter o certificado da escola eleita a melhor do Brasil com reconhecimento
                        em
                        mais de 17 países pela Latin American Quality Institute?</p>
                </article>


                <section class="main_school_list">
                    <header>
                        <h2>Confira nossos prêmios</h2>
                    </header>
                    <article>
                        <header>
                            <h3 class="icon-trophy">Qualidade e Excelência - Master Pesquisas</h3>
                        </header>
                    </article>

                    <article>
                        <header>
                            <h3 class="icon-trophy">Qualidade e Atendimento - Master Pesquisas</h3>
                        </header>
                    </article>

                    <article>
                        <header>
                            <h3 class="icon-trophy">Prêmio Diamante - Master Pesquisas</h3>
                        </header>
                    </article>

                    <article>
                        <header>
                            <h3 class="icon-trophy">Estrela do Sul - Master Pesquisas</h3>
                        </header>
                    </article>

                    <article>
                        <header>
                            <h3 class="icon-trophy">Medalha de Ouro a Excelência - LAQ</h3>
                        </header>
                    </article>

                    <article>
                        <header>
                            <h3 class="icon-trophy">Brazil Quality Certification - LAQI</h3>
                        </header>
                    </article>

                    <article>
                        <header>
                            <h3 class="icon-trophy">Melhor Plataforma EAD - Digital Awards</h3>
                        </header>
                    </article>
                </section>
            </div>
            <div class="main_school_content_right">
                <img src="assets/img/upinside.png" width="200" alt="Imagem" title="Imagem">
            </div>
            <article class="main_school_adress">
                <header>
                    <h2 class="icon-map2">Nos Encontre</h2>
                </header>
                <p>St. N, Área Especial QNN 14 - Ceilândia, Brasília - DF</p>
            </article>
        </section>
    </div>

    <!--INICIO DOBRA TUTOR-->
    <section class="main_tutor" id="contato">
        <div class="main_tutor_content">
            <header>
                <h1>Conheça seu Instrutor WEB, seu tutor nesse curso</h1>
                <p>EU vou te ajudar a criar sua webpage em Html5 e Css3</p>
            </header>
            <div class="main_tutor_content_img">
                <img src="assets/img/instrutor.png" width="200" title="Instrutor" alt="Instrutor">
            </div>
            <article class="main_tutor_content_history">
                <header>
                    <h2>Formado em Ciências da Computação e apaixonado pela Web</h2>
                </header>
                <p>Como muitos, comecei na programação por conta dos jogos! Com o tempo, o amor pela programação foi
                    crescendo a ponto de tomar como profissão e me especializar na área. Hoje, com a bagagem que
                    tenho,
                    compartilho meu conhecimento com todos os alunos da UpInside Treinamentos
                </p>
            </article>

            <section class="main_tutor_social_network">
                <header>
                    <h2>Me siga nas redes sociais</h2>
                </header>
                <article>
                    <header>
                        <h3><a href="#" class="icon-facebook">Meu Facebook</a></h3>
                    </header>

                </article>

                <article>
                    <header>
                        <h3><a href="#" class="icon-facebook2">Minha FanPage</a></h3>
                    </header>

                </article>

                <article>
                    <header>
                        <h3><a href="#" class="icon-google-plus2">Meu Google+</a></h3>
                    </header>

                </article>

                <article>
                    <header>
                        <h3><a href="#" class="icon-instagram">Meu Instagram</a></h3>
                    </header>

                </article>


            </section>
        </div>
    </section>
    <!--FIM DOBRA TUTOR-->
    <script>
        function filtroPorCategoria(valorId) {
            window.location.href = "index.php?categoria=" + valorId;
        }
    </script>
</main>

<!-- inclui o arquivo de rodape do site -->
<?php require_once 'layouts/site/footer.php'; ?>