<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Deletar</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-editar-perfil-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-deletar-produtor.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">
    </head>
    <body class="corpo-painel-produtor">

    <?php
        include('../conexao.php');

        session_start();
        if(!isset($_SESSION['entrar'])){

        $id = $_SESSION['id_usuario'];
        $sql_usuario = 'select * from pf_juridico where id_pf_juridico = '.$id.';';
        $resul_usuario = mysqli_query($conectar, $sql_usuario);
        $dados_usuario = mysqli_fetch_array($resul_usuario);

        if($dados_usuario['tp_usuario'] == 1){

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
                    <a href="painel_produtor.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_usuario['nome']; ?>        
                        </div>
                    </a>
                    <a href="notificacoes.php"><i class="far fa-bell"></i></a>
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
                <a href="editar_perfil.php"><li><i class="fas fa-user-edit"></i>
                    Perfil
                </li></a>
                <a href="alterar_senha.php"><li><i class="fas fa-user-lock"></i>
                    Segurança
                </li></a>
                <a href="endereco.php"><li><i class="fas fa-map-marked-alt"></i>
                    Endereços
                </li></a>  
                <a href="#"><li><i class="fas fa-user-times"></i>
                    Deletar
                </li></a>
                <a href="../invalido.php"><li><i class="fas fa-sign-out-alt"></i>
                    Sair
                </li></a>         
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main deletar-produtor">

        <div class="deletar-perfil">


            <p>Deletar Perfil</p>
            <span>Ao excluir o perfil os dados serão apagados, ou seja não será possível recuperar as informações.</span>
            <div class="botao-excluir">
                <i class="fas fa-eraser">
                    <form action="#" method="POST">
                        <input type="submit" name="deletar" value="">
                    </form>                
                </i>
            </div>
        
        </div>

        </section>
    </main>
        <?php

        if(isset($_POST['deletar'])){

            $sql_deletar_conta = 'delete from pf_juridico where pf_juridico.id_pf_juridico='.$id.';';
            $deletar_conta = mysqli_query($conectar, $sql_deletar_conta);

            if($deletar_conta){
                echo ('<script>window.alert("Apagado com sucesso!");window.location="../index.php"</script>');
            }else{
                echo ('<script>window.alert("Erro ao apagar!");window.location="deletar.php"</script>');
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

    }else{
        unset($_SESSION['entrar']);
        header('location:../invalido.php');
    }

    ?>

    </body>
</html>