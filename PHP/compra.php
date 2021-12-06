<html>

<head>
    <?php
    session_start();
    include('conexao.php');
    include('barra_rolagem.php');

    if (isset($_SESSION['id_usuario'])) {
        $tp_usuario = $_SESSION['tp_usuario'];
        $id_usuario = $_SESSION['id_usuario'];

        if ($tp_usuario == 0 or $tp_usuario == 2) {
            $sql_usuario = 'select * from pf_fisico where id_pf_fisico = ' . $id_usuario . ';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);

            $caminho = '?id_usuario=' . $dados_usuario['id_pf_fisico'] . '&tp_usuario=' . $dados_usuario['tp_usuario'] . '';

            if ($tp_usuario == 0) {
                $usuario = 'Administrador';
                $caminho_painel = '' . $usuario . '/painel_adm';
            } else {
                $usuario = 'Consumidor';
                $caminho_painel = '' . $usuario . '/painel_consumidor';
            }
        } elseif ($tp_usuario == 1 or $tp_usuario == 3) {
            $sql_usuario = 'select * from pf_juridico where id_pf_juridico = ' . $id_usuario . ';';
            $resul_usuario = mysqli_query($conectar, $sql_usuario);
            $dados_usuario = mysqli_fetch_array($resul_usuario);

            $caminho = '?id_usuario=' . $dados_usuario['id_pf_juridico'] . '&tp_usuario=' . $dados_usuario['tp_usuario'] . '';

            if ($tp_usuario == 1) {
                $usuario = 'Produtor';
                $caminho_painel = '' . $usuario . '/painel_produtor';
            } else {
                $usuario = 'Produtor_Consumidor';
                $caminho_painel = '' . $usuario . '/painel_produtor_consumidor';
            }
        } else {
        }
    } else {
    }
    ?>

    <style type="text/css">
        .box-user {
            height: 17%;
        }

        .usuario {
            position: relative;
            top: 6px;
            right: 12px;
        }

    </style>
    <link rel="stylesheet" type="text/css" href="../CSS/style-compra.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-lojas.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-escolher-endereco.css">
    <link rel="stylesheet" href="../FONTAW/css/all.css">
    <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
    <script type="text/javascript" src="../JS/script_box_user.js"></script>
    <script type="text/javascript" src="../JS/script_escolher_endereco.js"></script>
</head>

<body>

<section id="endereco">
        <a href="#" onclick="fechar()"><i class="fas fa-times"></i></a>
        <div class="escolher-endereco">
            <h2>Escolha o Endereço</h2>
            
            <?php
            
            if($tp_usuario == 2){
            
            $sql_endereco = 'select * from endereco where id_pf_fisico='.$id_usuario.';';
            $endereco = mysqli_query($conectar,$sql_endereco);

            } elseif($tp_usuario == 3){
        
            $sql_endereco = 'select * from endereco where id_pf_fisico='.$id_usuario.';';
            $endereco = mysqli_query($conectar,$sql_endereco);
    
            } else{}

            echo('<div class="alinhamento">

            <span>Endereço:</span>
            <form action="boleto.php?id_prod='.$_GET['id_produto'].'" method="POST">
                <select name="endereco">
                    <option selected value disabled="">Selecione</option>');
            
            
                while($dados_endereco = mysqli_fetch_array($endereco)){
                    echo('<option value="'.$dados_endereco['n_residencial'].'">');
                    echo($dados_endereco['logradouro']);
                    echo(', ');
                    echo($dados_endereco['n_residencial']);
                }
            ?>
                </select>
                <input type="submit" name="continuar" value="Continuar">
            </form>

            </div>
            
        </div>
    </section>

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
                if (!isset($_SESSION['id_usuario'])) {
                ?>

                    <div class="figuras" style="top: 40%;">
                        <a href=""><i class="fas fa-search"></i></a>
                        <a href="login.php"><i class="fas fa-user-circle"></i></a>
                        <a href="carrinho.php"><i class="fas fa-shopping-cart"></i></a>
                    </div>

                <?php
                } else {

                    echo ('<div class="figuras" style="top: 30%;">
                    <a href=""><i class="fas fa-search"></i></a>
                    <a href="#" onclick="box()"><div class="usuario">
                        <img src="../IMG/Imagem_Usuario/' . $dados_usuario['imagem'] . '">
                    </div></a>
                    <a href="carrinho.php"><i class="fas fa-shopping-cart"></i></a></div>');
                }
                ?>
            </nav>
        </section>
    </header>

    <?php
    $sql = 'select * from produto where id_produto = ' . $_GET['id_produto'] . ';';
    $query = mysqli_query($conectar, $sql);
    $dados_produto = mysqli_fetch_array($query);

    ?>

    <section class="sessao-compra">
        <div class="fundo-compra">
            <div class="imagem-produto">
                <img src="../IMG/Imagem_Produtos/<?php echo $dados_produto['imagem']; ?>" alt="">
            </div>
            <div class="info-produto">
                <div class="espaco-nome"> <span class="nome"> <?php echo $dados_produto['nome_produto']; ?> </span> </div>
                <div class="espaco-marca"> <span class="marca"> Marca: <?php echo $dados_produto['marca']; ?> </span> </div>
                <span class="descri"> Descrição: <?php echo $dados_produto['descricao']; ?> </span>
            </div>

            <div class="info-valor">
                <div class="espaco-valor-titulo"> <span class="titulo-valor"> Valor Unitário </span> </div>
                <div class="espaco-valor"> <span class="valor-preco"> <?php echo ('R$ ' . $dados_produto['preco']); ?> </span> </div>
            </div>

            <div class="info-qtd">
                <div class="espaco-qtd-titulo"> <span> Quantidade </span> </div>

                <div class="espaco-qtd">
                    <span><?php echo ($_GET['qtd']) ?></span>
                </div>
            </div>
        </div>
    </section>
    <section class="sessao-confirmar">
        <div class="container-confirmar">
            <?php

                $numero = number_format($dados_produto['preco']);
                $valor_total = $numero * $_GET['qtd'];
                $_SESSION['valorTotal'] = $valor_total;
                $qtd = $_GET['qtd'];
                $_SESSION['qtd'] = $qtd;
            ?>
            <div class="espaco-total">
                <span class="valor-total" id="valorTotal"> Valor total: R$ <?php echo ($valor_total); ?> </span>
            </div>
            <br>
            <div class="espaco-continuar">
                <?php echo ("<a onclick='abrir()'>Comprar</a>"); ?>
            </div>
        </div>
    </section>

    

    <?php
    $sql_produtos = 'select * from produto ORDER by nome_produto ASC limit 0,3;';
    $resul_produtos = mysqli_query($conectar, $sql_produtos);

    ?>
    <section class="compre-tbm">
        <div class="espaco-titulo-compre"> <span> Compre Também </span> </div>
        <div class="container-compre-tbm">

    <?php
        while($produtos = mysqli_fetch_array($resul_produtos)){
    ?>
            <div> <img src="../IMG/Imagem_Produtos/<?php echo $produtos['imagem']; ?>" alt="<?php echo $produtos['nome_produto']; ?>"> </div>
            <div class="compre-container-info" style="padding-right: 25px;">
                <div class="compre-info"> <span id="nome-produto-compre"> <?php echo $produtos['nome_produto']; ?> </span> </div>
                <div class="compre-info"> <span id="descricao-produto-compre"> <?php echo $produtos['descricao']; ?> </span> </div>
                <div class="compre-info"> <span id="preco-produto-compre"> <?php echo 'R$ ' . $produtos['preco']; ?> </span> </div>
                <div class="espaco-compre-tbm"> <?php echo ('<a href="produto.php?id_produto='.$produtos['id_produto'].'"> Ver Produto </a> </div>');?>
            </div>

    <?php
        }
    ?>

        </div>
    </section>
</body>

</html>