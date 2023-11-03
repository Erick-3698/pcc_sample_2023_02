<?php
    # inclui a classe de conexao com o banco de dados.
    require_once __DIR__ . "/../../src/dao/usuariodao.php";

    # verifica se os dados do formulario foram passados via método POST.
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
    
        # cria duas variaveis (nome, password) para armazenar os dados passados via método POST.
        $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
        $password = isset($_POST['password']) ? md5(trim($_POST['password'])) : '';

        $usuarioDAO = new UsuarioDAO();
        $row = $usuarioDAO->login($nome, $password);

        # se o resultado retornado for diferente de NULL, cria uma sessão com os dados do usuario.
        # e redireciona para a pagina de administracao de usuarios.
        # se não, destroi toodas as sessões existentes e redireciona para a pagina inicial.
        if($row) {
            $_SESSION['usuario'] = [
                'id' => $row['id'],
                'nome' => $row['nome'],
                'perfil' => $row['sigla'],
            ];
            // var_dump($row); exit;
            if($row['perfil'] === 'ADM') {
                header('location: usuario_admin.php');
            } else {
                header('location: index.php');
            }
        } else {
            session_destroy();
            header('location: index.php?error=Usuário ou senha inválidos.');
        }
     
    }
?>
<!--POP LOGIN-->
<div class="overlay"></div>
<div class="modal">

    <div class="div_login">
        <form action="index.php" method="post">
            <h1>Login</h1><br>
            <input type="text" name="nome" placeholder="Informe o nome do usuário." class="input" required autofocus>
            <br><br>
            <input type="password" name="password" placeholder="Informe o nome do password." class="input" required>
            <br><br>
            <button class="button">Enviar</button>
        </form>
    </div>

</div>
<!--FIM POP LOGIN-->