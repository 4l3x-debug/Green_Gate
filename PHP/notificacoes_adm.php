<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Notificações</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">

        <style type="text/css">

        .pagina-usuario{
            display: flex;
            justify-content: center;
            padding: 0;
        }

        .notificacoes {
            width: 32%;
            height: 90%;
            background-color: #FFF;
            border-radius: 15px;
            top: 5%;
            position: absolute;
            overflow: auto;
        }

        span {
            position: absolute;
            font-size: 23px;
            width: 88%;
            height: 8%;
            padding: 20px 20px 0 30px;
            border-bottom: 1px solid #ebebeb;
        }
        
        .fundo-notificacoes {
            width: 100%;
            height: 11%;
        }

        </style>

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

        $sql_total = 'select * from suporte, empresa;';
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
                    <a href="pagina_usuario_adm.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href="notificacoes_adm.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->


    <section class="pagina-usuario">

        <div class="notificacoes">

            <span><strong>Notificações</strong></span>


        <?php

            while($notificacoes = mysqli_fetch_array($resul_total)){

        ?>


            <div class="fundo-notificacoes">

                

            </div>

        <?php
            }
        ?>    
            
        </div>

    </section>

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