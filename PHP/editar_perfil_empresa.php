<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Editar Perfil</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-editar-perfil.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">

        <style type="text/css">
            
        .main-aside-produtor {
            height: 930px;
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
                    <a href="pagina_usuario_produtor.php"><i class="fas fa-user-circle"></i>
                        <div class="usuario">
                            <?php echo $dados_empresa['nome_empresa']; ?>        
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
                <a href="editar_perfil_empresa.php"><li><i class="fas fa-user-edit"></i>
                    Perfil
                </li></a>
                <a href="deletar_empresa.php"><li><i class="fas fa-user-times"></i>
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

                <table class="fundo-editar-perfil">

                <tr>
                    <td>Nome:</td>
                    <td><input type="text" name="nome" value="<?php echo $dados_empresa['nome_empresa']; ?>"></td>
                </tr>

                <tr>
                    <td>Razão:</td> 
                    <td><input type="text" name="razao" value="<?php echo $dados_empresa['razao']; ?>"></td>
                </tr>
                
                <tr>
                    <td>Email:</td>
                    <td><input type="email" name="email" value="<?php echo $dados_empresa['email'] ?>"></td>
                </tr>

                <tr>
                    <td>Telefone:</td> 
                    <td><input type="text" name="telefone" value="<?php echo $dados_empresa['telefone']; ?>"></td>
                </tr>

                <tr>
                    <td>CNPJ:</td> 
                    <td><input type="text" name="cnpj" value="<?php echo $dados_empresa['cnpj']; ?>"></td>
                </tr>

                <tr>
                    <td>CEP:</td> 
                    <td><input type="text" name="cep" value="<?php echo $dados_empresa['cep']; ?>"></td>
                </tr>

                <tr>
                    <td>Estado:</td>
                    <td><input type="text" name="estado" value="<?php echo $dados_empresa['estado']; ?>"></td>
                </tr>

                <tr>
                    <td>Cidade:</td>
                    <td><input type="text" name="cidade" value="<?php echo $dados_empresa['cidade']; ?>"></td>
                </tr>

                <tr>
                    <td>Bairro:</td>
                    <td><input type="text" name="bairro" value="<?php echo $dados_empresa['bairro']; ?>"></td>
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
        $razao = $_POST['razao'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $cnpj = $_POST['cnpj'];
        $cep = $_POST['cep'];
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];

        $sql_update = 'update empresa set nome_empresa="'.$nome.'", email="'.$email.'", telefone="'.$telefone.'", cnpj="'.$cnpj.'", razao="'.$razao.'", cep="'.$cep.'", estado="'.$estado.'", cidade="'.$cidade.'", bairro="'.$bairro.'" where empresa.id_empresa='.$dados_empresa['id_empresa'].';';
        $update = mysqli_query($conectar,$sql_update);

        if($update){
            echo ('<script>window.alert("Mudança feita com sucesso!");window.location="editar_perfil_empresa.php"</script>');
        }else{
            echo ('<script>window.alert("Erro ao salvar!");window.location="editar_perfil_empresa.php"</script>');
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