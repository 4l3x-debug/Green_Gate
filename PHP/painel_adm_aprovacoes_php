<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Suporte</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-adm.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor-suporte.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">

        <style type="text/css">

        .main-aside-produtor{
            height: 800px;
        }    
            
        .main.aprovacoes{
            width: 80%;
            height: 800px;
            position: absolute;
            font-family: Caviar Dreams;
            overflow: auto;
        }

        .avaliacao-empresas {
            position: relative;
            width: 80%;
            height: 50%;
            left: 10%;
            top: 8%;
        }

        .avaliacao-empresas table{
            position: absolute;
            width: 90%;
            height: 50%;
            left: 5%;
            top: 10%;
        }

        .avaliacao-empresas table td{
            width: 20px;
            text-align: center;
            font-size: 15px;
        }

        .avaliacao-empresas section{
            background-color: #FFF;
            width: 100%;
            height: 70%;
            border-radius: 15px;
        }

        .botao a{
            position: absolute;
            color: #FFF;
            left: 36%;
            top: 27%;
            font-size: 19px;
        }

        </style>

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

        $sql_empresa = 'select * from empresa ORDER BY id_empresa ASC;';
        $resul_empresa = mysqli_query($conectar, $sql_empresa);
        $total_empresa = mysqli_num_rows($resul_empresa);

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
                    <a href="notificacoes_adm.php"><i class="far fa-bell"></i></a>
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
                <a href="painel_adm.php"><li><i class="fas fa-store-alt"></i>
                    Lojas
                </li></a>
                <a href="painel_adm_aprovacoes.php"><li><i class="far fa-check-square"></i> 
                    Aprovações
                </li></a>
                <a href="painel_adm_avaliacoes.php"><li><i class="fas fa-tasks"></i>
                    Avaliações
                </li></a>
                <a href="invalido.php"><li><i class="fas fa-sign-out-alt"></i>
                    Sair
                </li></a>         
            </ul>
        </nav>
    </aside>

    <!-- Conteúdo -->

        <section class="main aprovacoes">

        <?php

            while($dados_empresa = mysqli_fetch_array($resul_empresa)){

        echo('

        <div class="avaliacao-empresas">

            <section>
            
            <table>

                <tr>
                    <td>Nome: '.$dados_empresa['nome_empresa'].'</td>
                    <td colspan="2">Email: '.$dados_empresa['email'].'</td>
                    <td>Telefone: '.$dados_empresa['telefone'].'</td>
                </tr>

                <tr>
                    <td>Razão Social: '.$dados_empresa['razao'].'</td>
                    <td>CNPJ: '.$dados_empresa['cnpj'].'</td>
                    <td>Data de Cadastro: '.$dados_empresa['data_cadastro'].'</td>
                    <td>Produtor: '.$dados_empresa['id_produtor'].'</td>
                </tr>

                <tr>
                    <td>CEP: '.$dados_empresa['cep'].'</td>
                    <td>Estado: '.$dados_empresa['estado'].'</td>
                    <td>Cidade: '.$dados_empresa['cidade'].'</td>
                    <td>Bairro: '.$dados_empresa['bairro'].'</td>
                </tr>
                
            </table>

            <div class="botao"><a href="delete_avaliacao.php?del='.$dados_empresa['id_empresa'].'"><i class="fas fa-trash"></i></a></div>

            </section>

        </div>

        ');

        } 

        ?>

        </section>

    </main> 

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