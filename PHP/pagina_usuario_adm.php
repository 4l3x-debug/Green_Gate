<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Usuário</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pagina-usuario.css">
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

        if($dados_usuario['usuario'] == 0){

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
                    <a href="pagina_usuario_adm.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href="notificacoes.php"><i class="far fa-bell"></i></a>
                </div>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->


    <section class="pagina-usuario">

    <p>
        <a href="editar_perfil_adm.php">Editar Perfil</a>
    </p>     

    <div class="fundo-foto-usuario">
        <div class="foto-usuario">
            <?php echo ('<img src="../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'"alt="'.$dados_usuario['nome'].'"/>'); ?>
        </div>
    </div>

    <div class="nome-usuario">

    <?php

    echo $dados_usuario['nome'];

    ?>

    </div>

    <table>

        <tr>

            <div class="dados-usuario primeira">

            <td> Email: <?php echo $dados_usuario['email']; ?> </td>
            <td> CPF: <?php echo $dados_usuario['cpf']; ?> </td>
            <td> Data de Cadastro: <?php echo $dados_usuario['data_cadastro']; ?> </td>    

            </div>

        </tr>

        <tr>    

            <div class="dados-usuario segunda">

            <td> Gênero: <?php  

            if($dados_usuario['genero'] == 'M'){ echo ("Masculino"); }else { echo("Feminino");} ?> </td>
            <td> Telefone: <?php echo $dados_usuario['celular']; ?> </td>
            <td> Data de Nascimento: <?php echo $dados_usuario['data_nascimento']; ?> </td>
                
            </div>

        </tr>    

    </table>
        
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
            header('location:invalido.php');
        }

        }else{
            unset($_SESSION['entrar']);
            header('location:invalido.php');
        }

    ?>

    </body>
</html>