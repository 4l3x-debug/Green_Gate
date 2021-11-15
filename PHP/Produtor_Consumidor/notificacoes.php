<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Notificações</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-notificacoes.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">

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

    if($dados_usuario['tp_usuario'] == 3){
        $sql_suporte = 'select * from suporte where id_pf_juridico='.$id.';';
        $query_suporte = mysqli_query($conectar,$sql_suporte);

?>

    <!-- Cabeçalho -->

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="../index.php"><img src="../../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="figuras-produtor">
                    <a href="painel_produtor_consumidor.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href="#"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->


    <section class="pagina-usuario">

        <div class="notificacoes">

            <span><strong>Notificações</strong></span>

        <?php

        while($suporte = mysqli_fetch_array($query_suporte)){

        ?>

        <div class="fundo-notificacoes">

        <?php
            
            if($suporte['tp_usuario_remetente'] == 0){
                $sql_remetente = 'select * from pf_fisico where id_pf_fisico='.$suporte['id_remetente'].';';
                $query_remetente = mysqli_query($conectar,$sql_remetente);
            }else if($suporte['tp_usuario_remetente'] == 1){
                $sql_remetente = 'select * from pf_juridico where id_pf_juridico='.$suporte['id_remetente'].';';
                $query_remetente = mysqli_query($conectar,$sql_remetente);
            }

            while($remetente = mysqli_fetch_array($query_remetente)){
                echo ('<div class="foto-usuario"><img src="../../IMG/Imagem_Usuario/'.$remetente['imagem'].'"></div><div class="notificacao">'.$remetente['nome'].' mandou mensagem!</div>');
            }

        ?>

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
        header('location:../invalido.php');
    }
    ?>

    </body>
</html>