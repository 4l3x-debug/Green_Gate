<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Notificações</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-notificacoes.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-box-user.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../../JS/script_box_user.js"></script>

        <style type="text/css">
            .box-user span{
                padding: 0;
                border: 0;
            }

            .figuras-produtor{
                right: 50px;
            }

            .figuras-produtor a i{
                padding: 0;
            }

            .pagina-usuario a{
                color: #000;
                position: relative;
                width: 100%;
                z-index: 1;
                display: block;
                cursor: pointer;
            }
        </style>

    </head>
    <body class="corpo-painel-produtor">

    <?php

    include('../conexao.php');

    session_start();
    if(!isset($_SESSION['id_usuario'])){
        unset($_SESSION['id_usuario']);
        header('location:../invalido.php');
    }
    
    $id = $_SESSION['id_usuario'];
    $sql_usuario = 'select * from pf_juridico where id_pf_juridico = '.$id.';';
    $resul_usuario = mysqli_query($conectar, $sql_usuario);
    $dados_usuario = mysqli_fetch_array($resul_usuario);

    if($dados_usuario['tp_usuario'] == 1){
        $sql_suporte = 'select * from suporte where id_pf_juridico='.$id.';';
        $query_suporte = mysqli_query($conectar,$sql_suporte);

?>

    <!-- Cabeçalho -->

        <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
                    <ul>
                        <a href="painel_produtor.php"><li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li></a>
                        <a href="editar_perfil.php"><li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li></a>
                        <a href="../invalido.php"><li style="border-top: 1px solid #ebebeb;" class="list dois">
                            <span>Sair</span>
                        </li></a>
                    </ul>
                </nav>
            </div>
        </section>

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="../index.php"><img src="../../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="figuras-produtor">
                    <div class="usuario">
                        <a href="#" onclick="box()">
                            <?php echo ('<img src="../../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'">'); ?>     
                        </a>
                    </div>
                    <a href="#"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->


    <section class="pagina-usuario" onclick="boxFechar()">

        <div class="notificacoes">

            <span><strong>Notificações</strong></span>

        <?php

        while($suporte = mysqli_fetch_array($query_suporte)){

        echo ('<a href="mensagem_notificacao.php?suporte='.$suporte['id_suporte'].'" class="fundo-notificacoes">');
            
            if($suporte['tp_usuario_remetente'] == 0 or $suporte['tp_usuario_remetente'] == 2){
                $sql_remetente = 'select * from pf_fisico where id_pf_fisico='.$suporte['id_remetente'].';';
                $query_remetente = mysqli_query($conectar,$sql_remetente);
            }else if($suporte['tp_usuario_remetente'] == 3){
                $sql_remetente = 'select * from pf_juridico where id_pf_juridico='.$suporte['id_remetente'].';';
                $query_remetente = mysqli_query($conectar,$sql_remetente);
            }

            while($remetente = mysqli_fetch_array($query_remetente)){
                echo ('<div class="foto-usuario"><img src="../../IMG/Imagem_Usuario/'.$remetente['imagem'].'"></div><div class="notificacao">'.$remetente['nome'].' mandou mensagem!</div>');
            }

        ?>

        </a>

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
            <a href="https://www.facebook.com/Green-Gate-103711395206238" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>

    <?php

    }else{
        header('location:../invalido.php');
    }
    ?>

    </body>
</html>