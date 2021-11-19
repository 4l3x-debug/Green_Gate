<?php
    session_start();
    include('conexao.php');
    include ('barra_rolagem.php');

    if($_SESSION){
        $tp_usuario = $_GET['tp_usuario'];
        $id_usuario = $_GET['id_usuario'];

        if($tp_usuario == 0 or $tp_usuario == 2){
            $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id_usuario.';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);

            if($tp_usuario == 0){
                $caminho_painel = 'Administrador/painel_adm';
            }else{
                $caminho_painel = 'Consumidor/painel_consumidor';
            }
        }
        elseif($tp_usuario == 1 or $tp_usuario == 3){
            $sql_usuario = 'select * from pf_juridico where id_pf_juridico = '.$id_usuario.';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);

            if($tp_usuario == 1){
                $caminho_painel = 'Produtor/painel_produtor';
            }else{
                $caminho_painel = 'Produtor_Consumidor/painel_produtor_consumidor';
            }
        }

    }else{
        $tp_usuario = 0;
        $id_usuario = 0;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
    <link rel="stylesheet" href="../FONTAW/css/all.css">
    <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
    <script type="text/javascript" src="../JS/script_box_user.js"></script>
    <title>Green Gate</title>

    <style type="text/css">
        .box-user{
            height: 17%;
        }
        .usuario {
            position: relative;
            top: 6px;
            right: 12px;
        }
    </style>
</head>

<body>
    <header>

        <!-- Cabeçalho -->

        <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
                    <ul>
                        <a href=" <?php echo($caminho_painel); ?>.php"><li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li></a>
                        <a href="editar_perfil.php"><li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li></a>
                        <a href="invalido.php"><li style="border-top: 1px solid #ebebeb;" class="list dois">
                            <span>Sair</span>
                        </li></a>
                    </ul>
                </nav>
            </div>
        </section>

        <section class="main-nav">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="index.php"><img src="../IMG/logotipo.png" alt="Logotipo"></a>
                    </figure>
                </div>

                <div class="lista-menu">
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="lojas.php">Loja</a></li>
                        <li><a href="sobre.php">Sobre</a></li>
                        <li><a href="suporte.php">Suporte</a></li>
                    </ul>
                </div>

                    <?php
                        if(!isset($_SESSION['id_usuario'])){
                            echo('<div class="figuras" style="top: 40%;"><a href=""><i class="fas fa-search"></i></a><a href="login.php"><i class="fas fa-user-circle"></i></a><a href=""><i class="fas fa-shopping-bag"></i></a></div>');
                        }

                        else{
                            echo ('<div class="figuras" style="top: 30%;"><a href=""><i class="fas fa-search"></i></a><a href="#" onclick="box()"><div class="usuario"><img src="../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'"></div></a><a href=""><i class="fas fa-shopping-bag"></i></a></div>');
                        }    
                    ?>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->

    <section class="main-conteudo" onclick="boxFechar()">
        <div class="conteudo">

            <section class="slide">
                <img class="foto" src="../IMG/slider_1.png">
                <img class="foto" src="../IMG/slider_2.png">
                <img class="foto" src="../IMG/slider_3.png">
            </section>

            <a href="#"><button>Saiba Mais</button></a>
        </div>

    </section>

    <section class="imagem_1" onclick="boxFechar()">

        <?php
            $sql_produto = 'select * from produto limit 0,3;';
            $resul_produto = mysqli_query($conectar,$sql_produto);

        while($produto = mysqli_fetch_array($resul_produto)){

            echo('<div class="espacamento-produtos"><div class="box-shadow-imagem"><a href="produto.php?id_produto='.$produto['id_produto'].'"><article class="produtos">
                    <img src="../IMG/Imagem_Produtos/'.$produto['imagem'].'" alt="'.$produto['nome_produto'].'">
            </article></a></div></div>');

        }

        ?>

    </section>

    <div class="box-anuncio" onclick="boxFechar()">
        <div class="anuncio">
            <img src="../IMG/anuncio.png">
        </div>
    </div>

    <section class="imagem_1" onclick="boxFechar()">
    
    <?php

        $sql_produto_um = 'select * from produto limit 3,3;';
        $resul_produto_um = mysqli_query($conectar,$sql_produto_um);

        while($produto_um = mysqli_fetch_array($resul_produto_um)){

            echo('<div class="espacamento-produtos"><div class="box-shadow-imagem"><a href="produto.php?id_produto='.$produto_um['id_produto'].'"><article class="produtos">
                    <img src="../IMG/Imagem_Produtos/'.$produto_um['imagem'].'" alt="'.$produto_um['nome_produto'].'">
            </article></a></div></div>');

        }

    ?>

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
</body>

</html>