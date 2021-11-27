<?php
    session_start();
    include ('conexao.php');
    include ('barra_rolagem.php');

    if(isset($_SESSION['id_usuario'])){
        $tp_usuario = $_SESSION['tp_usuario'];
        $id_usuario = $_SESSION['id_usuario'];

        if($tp_usuario == 0 or $tp_usuario == 2){
            $sql_usuario = 'select * from pf_fisico where id_pf_fisico = '.$id_usuario.';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);

            $caminho = '?id_usuario='.$dados_usuario['id_pf_fisico'].'&tp_usuario='.$dados_usuario['tp_usuario'].'';

            if($tp_usuario == 0){
                $usuario = 'Administrador';
                $caminho_painel = ''.$usuario.'/painel_adm';
            }else{
                $usuario = 'Consumidor';
                $caminho_painel = ''.$usuario.'/painel_consumidor';
            }
        }
        elseif($tp_usuario == 1 or $tp_usuario == 3){
            $sql_usuario = 'select * from pf_juridico where id_pf_juridico = '.$id_usuario.';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);

            $caminho = '?id_usuario='.$dados_usuario['id_pf_juridico'].'&tp_usuario='.$dados_usuario['tp_usuario'].'';

            if($tp_usuario == 1){
                $usuario = 'Produtor';
                $caminho_painel = ''.$usuario.'/painel_produtor';
            }else{
                $usuario = 'Produtor_Consumidor';
                $caminho_painel = ''.$usuario.'/painel_produtor_consumidor';
            }
        }else{}

    }else{}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title> Green Gate | Loja | Produto </title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-produto.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
    <link rel="stylesheet" href="../FONTAW/css/all.css">
    <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
    <script type="text/javascript" src="../JS/script_box_user.js"></script>

    <style type="text/css">
        .usuario img{
            position: relative;
            top: 6px;
            right: 12px;
        }
    </style>

</head>
<body bgcolor="#fdfaef">

    <!-- Dados do Produto -->
    
    <?php
        $sql = 'select * from produto where id_produto = '.$_GET['id_produto'].';';
        $query = mysqli_query($conectar, $sql);
        $dados_produto = mysqli_fetch_array($query);
    ?>

        <!-- Box User Oculto -->

        <section id="background-box">
            <div id="abrir">
                <nav class="box-user" style="height: 17%;">
                    <ul>
                        <a href=" <?php echo($caminho_painel); ?>.php"><li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li></a>
                        <a href="<?php echo($usuario);?>/editar_perfil.php"><li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li></a>
                        <a href="invalido.php"><li style="border-top: 1px solid #ebebeb;" class="list dois">
                            <span>Sair</span>
                        </li></a>
                    </ul>
                </nav>
            </div>
        </section>

        <!-- Cabeçalho -->

        <header>
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
                ?>                    

                <div class="figuras" style="top: 40%;">
                    <a href=""><i class="fas fa-search"></i></a>
                    <a href="login.php"><i class="fas fa-user-circle"></i></a>
                    <a href=""><i class="fas fa-shopping-cart"></i></a>
                </div>
                
                <?php
                    }else{  

                echo ('<div class="figuras" style="top: 30%;">
                    <a href=""><i class="fas fa-search"></i></a>
                    <a href="#" onclick="box()"><div class="usuario">
                        <img src="../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'">
                    </div></a>
                    <a href=""><i class="fas fa-shopping-cart"></i></a></div>');
                
                    }    
                ?>
                </nav>
            </section>
        </header>

    <!--Produto-->

    <div id="all">
    <div id="fundo">
    <section class="sessao-produto">

        <div class="container-produto">
            <?php
                echo('<img src="../IMG/Imagem_Produtos/'.$dados_produto['imagem'].'" alt="'.$dados_produto['nome_produto'].'">');
            ?>
        </div>
        
        <div class="container-info"> 

            <br><br>
            <span id="nome-produto">
                 <?php
                    echo($dados_produto['nome_produto']);
                 ?>
            </span><br>

            <div id="preco-space">
                <span id="cifra"> R$ </span> <span id="preco">
                    <?php
                        echo($dados_produto['preco']);
                    ?> 
                </span> 
            </div>

            <div class="espaco-botao" href="compra.php">
                <img src=""> <a href="compra.php" > Comprar </a>
            </div>

            <input id="checkbox" type="checkbox">  
            
            <div class="espaco-carrinho"> 
                <label id="carrinho" for="checkbox"> <span id="carro"> Carrinho </span> </label> <br> 
            </div>

            <div class="detalhes"> 
                <h2> Detalhes do produto </h2> <br>
                <span> 
                    <?php
                        echo($dados_produto['descricao']."<br>");
                        echo("Marca: ".$dados_produto['marca']);
                    ?>
                </span>
            </div>      
        </div>
    </section>
    </div></div>

    <?php
        if(!isset($_SESSION['id_usuario'])){
            echo ('<script>window.alert("Faça o login primeiro!");window.location="login.php"</script>');
        }else{
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
            <a href="https://www.facebook.com/Green-Gate-103711395206238" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.instagram.com/green.gate_/" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fas fa-envelope"></i></a>
        </div>

        <div class="direitos">
            <p>© Green Gate 2021</p>
        </div>
    </footer>

</body>
</html>