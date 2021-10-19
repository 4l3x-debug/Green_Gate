<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Segurança</title>
        <link rel="stylesheet" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-editar-perfil-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-alterar-senha.css">
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
                    <a href="notificacoes_produtor.php"><i class="far fa-bell"></i></a>
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
                <a href="editar_perfil_produtor.php"><li><i class="fas fa-user-edit"></i>
                    Perfil
                </li></a>
                <a href="alterar_senha.php"><li><i class="fas fa-user-lock"></i>
                    Segurança
                </li></a>
                <a href="deletar_produtor.php"><li><i class="fas fa-user-times"></i>
                    Deletar
                </li></a>
                <a href="invalido.php"><li><i class="fas fa-sign-out-alt"></i>
                    Sair
                </li></a>         
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main editar-perfil">

            <form action="#" method="POST">

                <table class="fundo-senha">

                <tr>
                    <td class="perguntas">Senha antiga:</td>
                    <td class="respostas"><input type="password" name="senha_antiga"></td>
                </tr>

                <tr>
                    <td class="perguntas">Nova senha:</td> 
                    <td class="respostas"><input type="password" name="nova_senha"></td>
                </tr>
                
                <tr>
                    <td class="perguntas">Confirmação:</td>
                    <td class="respostas"><input type="password" name="confirmacao"></td>
                </tr>

                <tr>
                    <td class="botao" colspan="2" align="center"><input type="submit" name="salvar" value="Salvar"></td>
                </tr>

                </table>

            </form>

        </section>

    <?php

    if(isset($_POST['salvar'])){
        $senha_antiga = $_POST['senha_antiga'];
        $nova_senha = $_POST['nova_senha'];
        $confirmacao = $_POST['confirmacao'];

        if($confirmacao == $nova_senha){
            if($dados_usuario['senha'] == md5($senha_antiga)){

                $sql_update_senha = 'update usuario set senha="'.md5($nova_senha).'" where usuario.id_usuario='.$id.';';
                $update_senha = mysqli_query($conectar,$sql_update_senha);

                if($update_senha){
                    echo ('<script>window.alert("Senha alterada com sucesso!");window.location="alterar_senha.php"</script>');
                }else{
                    echo ('<script>window.alert("Erro ao salvar!");window.location="alterar_senha.php"</script>');
                }

            }else{
                echo ('<script>window.alert("Erro na senha antiga!");window.location="alterar_senha.php"</script>');
            }

        }else{    
            echo ('<script>window.alert("Erro na confirmação da nova senha!");window.location="alterar_senha.php"</script>');
        }
    }    

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