<?php
    session_start();

    include("conexao.php");

    $sql = 'select * from produto where id_produto = '.$_GET['id_produto'].';';
    $query = mysqli_query($conectar, $sql);

    while ($dados_produto = mysqli_fetch_array($query)) {
        $nome_produto = $dados_produto['nome_produto'];
        $marca = $dados_produto['marca'];
        $preco = $dados_produto['preco'];
        $descricao = $dados_produto['descricao'];
        $data_validade = $dados_produto['dt_validade'];
        $imagem = $dados_produto['imagem'];

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
            <?php
                echo('<img src="../IMG/'.$imagem.'" alt="'.$imagem.'">');
            ?>
        </div>
        
        <div class="container-info"> 

            <br><br>
            <span id="nome-produto">
                 <?php
                    echo($nome_produto);
                 ?>
            </span><br>

            <div id="preco-space">
                <span id="cifra"> R$ </span> <span id="preco">
                    <?php
                        echo($preco);
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
                        echo($descricao."<br>");
                        echo("Marca: ".$marca);
                        }
                    ?>
                </span>
            </div>      
        </div>
    </section>

</body>
</html>