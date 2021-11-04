<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Suporte</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-suporte.css">
        
    </head>
    <body class="corpo-painel-produtor">

    <?php
        include('../conexao.php');

        session_start();
        if(!isset($_SESSION['entrar'])){ // if entrar

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        if($dados_usuario['tp_usuario'] == 2){ // if tp_usuario

    ?>

    <!-- Cabeçalho -->

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="../index.php"><img src="../../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="lista-menu">
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../lojas.php">Loja</a></li>
                        <li><a href="../sobre.php">Sobre</a></li>
                        <li><a href="../suporte.php">Suporte</a></li>
                    </ul>
                </div>

                <div class="figuras-produtor">
                    <a href="painel_adm"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href="../notificacoes.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->


    <section class="pagina-usuario">

    <!-- Menu Lateral Oculto -->

        <script type="text/javascript" src="../../JS/script_painel_consumidor.js"></script>

        <aside id="menuOculto" class="menuOculto">
            <a href="javascript: void(0)" class="btnFechar" onclick="fecharNav()"><i class="fas fa-times"></i></a>
            <a href="pedidos.php" class="icon"><i class="fas fa-boxes"></i>Pedidos</a>
            <a href="suporte.php" class="icon"><i class="fas fa-headset"></i>Suporte</a>
            <a href="../invalido.php" class="icon"><i class="fas fa-sign-out-alt"></i>Sair</a>
        </aside>

        <section id="principal">
            <span style="font-size: 30px; cursor:pointer; color: #ADAD7B;" onclick="abrirNav()">&#9776;</span>
        </section>

        <section class="suporte">
                <h1>Suporte</h1>
                <form action="#" method="POST">

                    <div class="linha primeira">
                        Para:
                        <input type="email" name="email">

                        Tipo de Usuário:
                        <select name="usuario">
                            <option selected value disabled="">Selecione</option>
                            <option value="1">Administrador</option>
                            <option value="2">Produtor</option>
                        </select>
                    </div>

                    <div class="linha segunda">
                        Assunto:
                        <input type="text" name="assunto">
                    </div>

                    <div class="linha terceira">
                        <textarea name="conteudo" style="resize: none"></textarea>
                    </div>

                    <div class="botao">
                        <i class="fas fa-paper-plane"><input type="submit" name="enviar" value=""></i>
                    </div>

                </form>
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

            if(empty($_POST['email']) or empty($_POST['assunto']) or empty($_POST['conteudo']) or empty($_POST['usuario'])){

                echo ('<script>window.alert("Preencha os campos do formulário!");window.location="suporte.php"</script>');

            }else{

            $email = $_POST['email'];
            $usuario = $_POST['usuario'];
            $assunto = $_POST['assunto'];
            $conteudo = $_POST['conteudo'];
            $data_envio = date("Y-m-d");

            if($usuario == 2){

                $sql_pf_juridico = 'select *from pf_juridico where email = "'.$email.'";';
                $resul = mysqli_query($conectar, $sql_pf_juridico);
                $dados = mysqli_fetch_array($resul);

                $sql_suporte = 'insert into suporte(assunto, conteudo, data_envio, id_pf_fisico, id_pf_juridico) values ("'.$assunto.'", "'.$conteudo.'", "'.$data_envio.'", null, '.$dados['id_pf_juridico'].');';

                $suporte = mysqli_query($conectar, $sql_suporte);

                if($suporte){
                    echo ('<script>window.alert("Mensagem enviada com sucesso!");window.location="suporte.php"</script>');
                }else{
                    echo ('<script>window.alert("Erro ao enviar a mensagem!");window.location="suporte.php"</script>');
                }

            }else if($usuario == 1){

                $sql_pf_fisico = 'select *from pf_fisico where email = "'.$email.'";';
                $resul = mysqli_query($conectar, $sql_pf_fisico);
                $dados = mysqli_fetch_array($resul);

                $sql_suporte = 'insert into suporte(assunto, conteudo, data_envio, id_pf_fisico, id_pf_juridico) values ("'.$assunto.'", "'.$conteudo.'", "'.$data_envio.'", '.$dados['id_pf_fisico'].', null);';

                $suporte = mysqli_query($conectar, $sql_suporte);

                if($suporte){
                    echo ('<script>window.alert("Mensagem enviada com sucesso!");window.location="suporte.php"</script>');
                }else{
                    echo ('<script>window.alert("Erro ao enviar a mensagem!");window.location="suporte.php"</script>');
                }


            }
            

            } // else empty

        } // else enviar

        }else{ // else tp_usuario
            header('location:../invalido.php');
        }

        }else{ // else entrar
            unset($_SESSION['entrar']);
            header('location:../invalido.php');
        }

        ?>

    </body>
</html>S