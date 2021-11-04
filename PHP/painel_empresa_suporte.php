<?php
    include ('barra_rolagem.php');
?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Suporte</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor-suporte.css">
            <link rel="stylesheet" type="text/css" href="../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">

        <style type="text/css">
            .formulario-suporte{
                width: 63%;
                left: 22%;
            }
        </style>

    </head>
    <body class="corpo-painel-produtor">

    <?php

    include('conexao.php');
        session_start();
        if(!isset($_SESSION['entrar'])){

            if(!isset($_SESSION['entrar_empresa'])){

                $id = $_SESSION['id_usuario'];
                $cnpj_empresa = $_SESSION['cnpj_empresa'];

                $sql_usuario = 'select *from usuario where id_usuario='.$id.';';
                $resul_usuario = mysqli_query($conectar, $sql_usuario);
                $dados_usuario = mysqli_fetch_array($resul_usuario);

            if($dados_usuario['usuario'] == 1){
                
                $sql_empresa = 'select * from empresa where cnpj='.$cnpj_empresa.';';
                $resul_empresa = mysqli_query($conectar, $sql_empresa);
                $dados_empresa = mysqli_fetch_array($resul_empresa);


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
                    <a href="painel_empresa.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_empresa['nome_empresa']; ?>        
                        </div>
                    </a>
                    <a href="notificacoes_produtor.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->

       <section class="pagina-usuario">

    <!-- Menu para Administrar -->

        <script type="text/javascript" src="../JS/script_painel_consumidor.js"></script>

        <aside id="menuOculto" class="menuOculto">
            <a href="javascript: void(0)" class="btnFechar" onclick="fecharNav()"><i class="fas fa-times"></i></a>
            <a href="painel_empresa.php" class="icon"><i class="fas fa-store-alt"></i>Loja</a>
            <a href="painel_empresa_produtos.php" class="icon"><i class="fas fa-tags"></i>Produtos</a>
            <a href="painel_empresa_avaliacoes.php" class="icon"><i class="fas fa-tasks"></i>Avaliações</a>
            <a href="painel_empresa_suporte.php" class="icon"><i class="fas fa-headset"></i>Suporte</a>
        </aside>

        <section id="principal">
            <span style="font-size: 30px; cursor:pointer; color: #ADAD7B;" onclick="abrirNav()">&#9776;</span>
        </section>

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

        if(isset($_POST['enviar'])){

            if(empty($_POST['assunto']) or empty($_POST['conteudo'])){

                echo ('<script>window.alert("Preencha os campos do formulário!");window.location="painel_produtor_suporte.php"</script>');

            }else{

            $assunto = $_POST['assunto'];
            $conteudo = $_POST['conteudo'];
            $data_envio = date("Y-m-d");

            $sql_suporte = 'insert into suporte(assunto,conteudo,data_envio,id_usuario) values ("'.$assunto.'","'.$conteudo.'","'.$data_envio.'",'.$dados_empresa['id_empresa'].');';
            $suporte = mysqli_query($conectar,$sql_suporte);

            if($suporte){
                echo ('<script>window.alert("Enviado com sucesso!");window.location="painel_produtor_suporte.php"</script>');
            }else{
                echo ('<script>window.alert("Erro ao enviar!");window.location="painel_produtor_suporte.php"</script>');
            }

            }

        }else{}

            }else{
                header('location:invalido.php');
            }

            }else{
                unset($_SESSION['entrar_empresa']);
                header('location:painel_produtor.php');
            }

        }else{
          unset($_SESSION['entrar']);
          header('location:invalido.php');
        }
    ?>

    </body>
</html>