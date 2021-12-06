<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Suporte</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-box-user.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-suporte.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-mensagem-notificacao.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../../JS/script_box_user.js"></script>
    </head>
    
    <body class="corpo-painel-produtor">

    <!-- Dados do Usuário -->

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

        if($dados_usuario['tp_usuario'] == 1){ // if tp_usuario

        $id_suporte = $_GET['suporte'];

        $sql_mensagem = 'select * from suporte where id_suporte='.$id_suporte.';';
        $resul_mensagem = mysqli_query($conectar,$sql_mensagem);
        $dados_mensagem = mysqli_fetch_array($resul_mensagem);

        if($dados_mensagem['tp_usuario_remetente'] == 0 or $dados_mensagem['tp_usuario_remetente'] == 2){
            $sql_remetente = 'select * from pf_fisico where id_pf_fisico='.$dados_mensagem['id_remetente'].';';
            $resul_remetente = mysqli_query($conectar,$sql_remetente);
            $remetente = mysqli_fetch_array($resul_remetente);

            if($dados_mensagem['tp_usuario_remetente'] == 0){
                $tp_usuario = 'Administrador';
            }else{
                $tp_usuario = 'Consumidor';
            }
        }else if($dados_mensagem['tp_usuario_remetente'] == 3){
            $sql_remetente = 'select * from pf_juridico where id_pf_juridico='.$dados_mensagem['id_remetente'].';';
            $resul_remetente = mysqli_query($conectar,$sql_remetente);
            $remetente = mysqli_fetch_array($resul_remetente);

            if($dados_mensagem['tp_usuario_remetente'] == 1){
                $tp_usuario = 'Produtor';
            }else{
                $tp_usuario = 'Produtor Consumidor';
            }
        }else{}

    ?>

    <!-- Cabeçalho -->

        <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
                    <ul>
                        <a href="painel_adm.php"><li class="list um">
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
                    <a href="#" onclick="box()">
                        <div class="usuario">
                            <?php echo ('<img src="../../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'">'); ?>     
                        </div>
                    </a>
                    <a href="notificacoes.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->

    <section class="pagina-usuario" onclick="boxFechar()">

        <section class="suporte">
                <h1>Mensagem</h1>

                    <div class="linha">
                        De: <div class="primeira" style="width: 403px;"><?php echo($remetente['email']);?></div>

                        Tipo de Usuário: <div class="primeira" style="width: 155px;"><?php echo($tp_usuario);?></div>
                    </div>

                    <div class="linha">
                        <div class="segunda" style="margin-right: 7px;">Assunto:</div><div class="segunda" style="width: 658px; border-bottom: 1px solid #ebebeb;text-align: left;"><?php echo($dados_mensagem['assunto']);?></div>
                    </div>

                    <div class="linha" style="display: flex; justify-content: center; text-align: left;">
                        <div class="terceira"><?php echo($dados_mensagem['conteudo']);?></div>
                    </div>

                    <form action="#" method="POST">
                        <input type="submit" name="excluir" value="Excluir">
                    </form>

                    <button><a href="suporte.php">Responder</a></button>
            </section>
        
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

    <!-- Deletar Suporte -->
    
    <?php
        
        if(isset($_POST['excluir'])){

            $sql_deletar_conta = 'delete from suporte where suporte.id_suporte='.$id_suporte.';';
            $deletar_conta = mysqli_query($conectar, $sql_deletar_conta);

            if($deletar_conta){
                echo ('<script>window.alert("Apagado com sucesso!");window.location="notificacoes.php"</script>');
            }else{
                echo ('<script>window.alert("Erro ao apagar!");window.location="mensagem_notificacao.php"</script>');
            }
        }

        }else{ // else tp_usuario
            header('location:../invalido.php');
        }

        ?>

    </body>
</html>