<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Segurança</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-editar-perfil.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-alterar-senha.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-box-user.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../../JS/script_box_user.js"></script>
    </head>

    <style type="text/css">
    
    .editar-perfil td{
        width: 160px;
    }

    </style>

    <body class="corpo-painel-produtor">

    <?php
        include('../conexao.php');

        session_start();
        if(!isset($_SESSION['id_usuario'])){
            unset($_SESSION['id_usuario']);
            header('location:../invalido.php');
        }

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        if($dados_usuario['tp_usuario'] == 0){

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

    <!-- Menu para Administrar -->

    <main>
    <aside class="main-aside-produtor" onclick="boxFechar()">
        <nav>
            <ul class="icon-aside">
                <strong>Categorias</strong>
                <a href="editar_perfil.php"><li><i class="fas fa-user-edit"></i>
                    Perfil
                </li></a>
                <a href="#"><li><i class="fas fa-user-lock"></i>
                    Segurança
                </li></a>
                <a href="deletar.php"><li><i class="fas fa-user-times"></i>
                    Deletar
                </li></a>    
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main editar-perfil" onclick="boxFechar()">

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
    </main>    

    <?php

    if(isset($_POST['salvar'])){
        $senha_antiga = $_POST['senha_antiga'];
        $nova_senha = $_POST['nova_senha'];
        $confirmacao = $_POST['confirmacao'];

        if($confirmacao == $nova_senha){
            if($dados_usuario['senha'] == md5($senha_antiga)){

                $sql_update_senha = 'update pf_fisico set senha="'.md5($nova_senha).'" where pf_fisico.id_pf_fisico='.$id.';';
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
        header('location:../invalido.php');
    }

    ?>

    </body>
</html>