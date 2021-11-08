<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title> Green Gate | Loja | Produto </title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
    <link rel="stylesheet" href="../CSS/produto.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icone.ico" type="image/x-icon">
    <link rel="stylesheet" href="../FONTAW/css/all.css">

</head>
<body>

    <?php
        session_start();

        include("conexao.php");

        $sql = 'select * from produto where id_produto = '.$_GET['id_produto'].';';
        $query = mysqli_query($conectar, $sql);
        $dados_produto = mysqli_fetch_array($query);

    ?>


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

                    <div class="figuras">
                        <a href=""><i class="fas fa-search"></i></a>
                        <a href="login.php"><i class="fas fa-user-circle"></i></a>
                        <a href=""><i class="fas fa-shopping-bag"></i></a>
                    </div>
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