<?php
    session_start();
    
    /* Resgate do banco */

    /* Nome */
    $nome_produto = "Kit Bemglô";

    $sql = 'select * from produto where nome = "'.$nome_produto.'";';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title> Green Gate | Loja | Produto </title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS/produto.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icone.ico" type="image/x-icon">

</head>
<body>
    <!--NavBar-->
        <section class="main-nav">
        <nav>
            <div class="logo">
                <figure>
                    <a href="index
                    .html"><img src="../IMG/logotipo.png" alt="Logotipo"></a>
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

    <!--Produto-->
    <div id="all">
    <div id="fundo">
    <section class="sessao-produto">

        <div class="container-produto">
            <img src="prod_kitbemglo.png"> 
        </div>
        
        <div class="container-info"> 

            <br><br>
            <span id="nome-produto"> Kit Bemglô </span> <br>

            <div id="preco-space">
                <span id="cifra"> R$ </span> <span id="preco"> 40,00 </span> 
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
                    O Kit Bemglô Sustentável contém um canudo curvado de Aço Inox reutilizável, escovinha de limpeza + 1 saquinho de tecido  100% algodão, com  barbante na boca para fechamento. Podem ir na lava-louças, são resistentes e possuem alta durabilidade. São seguros para uso com bebidas e comida.
                </span>
            </div>      
        </div>
    </section>

</body>
</html>
