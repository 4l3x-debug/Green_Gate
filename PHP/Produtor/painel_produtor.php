<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Green Gate | Página Usuário</title>
        <link rel="stylesheet" type="text/css" href="../../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" href="../../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../../IMG/icone.ico" type="image/x-icon">

        <style type="text/css">
            .foto-usuario img{
                display: flex;
                justify-content: center;
            }
        </style>
        
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

                <div class="lista-menu">
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../lojas.php">Loja</a></li>
                        <li><a href="../sobre.php">Sobre</a></li>
                        <li><a href="../suporte.php">Suporte</a></li>
                    </ul>
                </div>

                <div class="figuras-produtor">
                    <a href="#"><i class="fas fa-user-circle"></i>
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
            <a href="lojas.php" class="icon"><i class="fas fa-store-alt"></i>Produtos</a>
            <a href="avaliacoes.php" class="icon"><i class="fas fa-tasks"></i>Avaliações</a>
            <a href="../invalido.php" class="icon"><i class="fas fa-headset"></i>Suporte</a>
        </aside>

        <section id="principal">
            <span style="font-size: 30px; cursor:pointer; color: #ADAD7B;" onclick="abrirNav()">&#9776;</span>
        </section>


    <p>
        <a href="editar_perfil.php">Editar Perfil</a>
    </p>     

    <div class="fundo-foto-usuario">
        <div class="foto-usuario">
            <?php echo ('<img src="../../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'"alt="'.$dados_usuario['nome'].'"/>'); ?>
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
            <td> CNPJ: <?php echo $dados_usuario['cnpj']; ?> </td>
            <td> Data de Cadastro: <?php echo $dados_usuario['data_cadastro']; ?> </td>    

            </div>

        </tr>

        <tr>    

            <div class="dados-usuario segunda">

            <td> Razão Social: <?php echo $dados_usuario['razao']; ?> </td>

            <td> Gênero: 
                <?php if($dados_usuario['genero'] == 'M'){ echo ("Masculino"); }else if($dados_usuario['genero'] == 'F') { echo("Feminino");} else{echo('---');} ?> </td>
            <td> Telefone: <?php echo $dados_usuario['celular']; ?> </td>
                
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
            header('location:../invalido.php');
        }

        }else{
            unset($_SESSION['entrar']);
            header('location:../invalido.php');
        }

        ?>

    </body>
</html>