<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Suporte</title>
        <link rel="stylesheet" href="../CSS/index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor-suporte.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
    </head>
    <body class="corpo-painel-produtor">

    <?php
        include('conexao.php');

        session_start();
        if(!isset($_SESSION['entrar'])){

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from usuario where id_usuario = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        $sql_total = 'select * from empresa where id_produtor ='.$id.';';
        $resul_total = mysqli_query($conectar, $sql_total);

    ?>

    <!-- Cabeçalho -->

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="index.php"><img src="../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="figuras-produtor">
                    <a href="pagina_usuario_produtor.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href=""><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Menu para Administrar -->

    <main>
    <aside class="main-aside-produtor">
        <nav>
            <ul class="icon-aside">
                <strong>Categorias</strong>
                <a href="painel_produtor.php"><li><i class="fas fa-store-alt"></i>
                    Lojas
                </li></a>
                <a href="login_empresa.php"><li><i class="fas fa-wrench"></i>
                    Administrar
                </li></a>
                <a href="painel_produtor_suporte.php"><li><i class="fas fa-headset"></i>
                    Suporte
                </li></a>
                <a href="invalido.php"><li><i class="fas fa-sign-out-alt"></i>
                    Sair
                </li></a>         
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main mensagem">

            <div class="formulario-suporte">
                <h1>Suporte</h1>
                <form action="#" method="POST">

                    <div class="linha primeira">
                        Assunto:
                        <input type="text" name="assunto">
                    </div>

                    <div class="linha segunda">
                        <textarea name="conteudo"></textarea>
                    </div>

                    <div class="botao">
                        <i class="fas fa-paper-plane"><input type="submit" name="enviar" value=""></i>
                    </div>

                </form>
            </div>

        </section>

        <?php

        if(isset($_POST['enviar'])){
            $assunto = $_POST['assunto'];
            $conteudo = $_POST['conteudo'];
            $data_envio = date("Y-m-d");

            $sql_suporte = 'insert into suporte(assunto,conteudo,data_envio,id_usuario) values ("'.$assunto.'","'.$conteudo.'","'.$data_envio.'",'.$id.');';
            $suporte = mysqli_query($conectar,$sql_suporte);

            if($suporte){
                echo ('<script>window.alert("Enviado com sucesso!");window.location="painel_produtor_suporte.php"</script>');
            }else{
                echo ('<script>window.alert("Erro ao enviar!");window.location="painel_produtor_suporte.php"</script>');
            }

        }else{}

        ?>   

    <!-- Rodapé -->

    <footer class="main-footer">
        <section class="cont-footer">
            <div>
                <p>Para quem se compromete com o meio ambiente.</p>
            </div>
        </section>

        <div id="linha-vert"></div>

        <div class="footer-icon">
            <a href="https://www.facebook.com/Green-Gate-103711395206238"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>  

    <?php

    }else{
        unset($_SESSION['entrar']);
        header('location:invalido.php');
    }

    ?>

    </body>
</html>