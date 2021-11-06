<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Editar Perfil</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-editar-perfil.css">
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

        if($dados_usuario['tp_usuario'] == 3){

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
                    <a href="../notificacoes.php"><i class="far fa-bell"></i></a>
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
                <a href="#"><li><i class="fas fa-user-edit"></i>
                    Perfil
                </li></a>
                <a href="alterar_senha.php"><li><i class="fas fa-user-lock"></i>
                    Segurança
                </li></a>
                <a href="endereco.php?edit=0"><li><i class="fas fa-map-marked-alt"></i>
                    Endereços
                </li></a>  
                <a href="deletar.php"><li><i class="fas fa-user-times"></i>
                    Deletar
                </li></a>
                <a href="../invalido.php"><li><i class="fas fa-sign-out-alt"></i>
                    Sair
                </li></a>         
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main editar-perfil">

            <form action="#" method="POST">

                <table class="fundo-editar-perfil">

                <tr>
                    <td>Nome:</td>
                    <td><input type="text" name="nome" value="<?php echo $dados_usuario['nome']; ?>"></td>
                </tr>

                <tr>
                    <td>E-mail:</td> 
                    <td><input type="text" name="email" value="<?php echo $dados_usuario['email']; ?>"></td>
                </tr>
                
                <tr>
                    <td>Telefone:</td>
                    <td><input type="text" name="telefone" value="<?php echo $dados_usuario['celular'] ?>"></td>
                </tr>

                <tr>
                    <td>Razão Social:</td> 
                    <td><input type="text" name="razao" value="<?php echo $dados_usuario['razao']; ?>"></td>
                </tr>

                <tr>
                    <td>Gênero:</td> 
                    <td><select name="genero">
                        <option value="<?php echo $dados_usuario['genero']; ?>">
                            <?php if($dados_usuario['genero'] == 'M'){ echo ("Masculino"); }else if($dados_usuario['genero'] == 'F') { echo("Feminino");} else{ echo ('');} ?>
                        </option>
                        <option value="F">Feminino</option>
                        <option value="M">Masculino</option>
                    </select></td>
                </tr>

                <tr>
                    <td>CNPJ:</td>
                    <td><input type="text" name="cnpj" value="<?php echo $dados_usuario['cnpj']; ?>"></td>
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
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $razao = $_POST['razao'];
        $genero = $_POST['genero'];
        $cnpj = $_POST['cnpj'];

        $sql_update = 'update pf_juridico set nome="'.$nome.'", email="'.$email.'", celular="'.$telefone.'", razao="'.$razao.'", genero="'.$genero.'", cnpj="'.$cnpj.'" where pf_juridico.id_pf_juridico='.$id.';';
        $update = mysqli_query($conectar, $sql_update);

        if($update){
            echo ('<script>window.alert("Mudança feita com sucesso!");window.location="editar_perfil.php"</script>');
        }else{
            echo ('<script>window.alert("Erro ao salvar!");window.location="editar_perfil.php"</script>');
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