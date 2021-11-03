<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<title>Green Gate | Lojas</title>
	<link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-lojas.css">
    <link rel="stylesheet" href="../FONTAW/css/all.css">
    <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
</head>
<body>

    <?php

        include('conexao.php');

    ?>

        <!-- Cabeçalho -->

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

    <!-- Banner -->
    <figure class="banner">    
        <img src="../IMG/banner.png" align="banner">
    </figure>

    <!-- Seção de Lojas -->

    <section class="main-lojas">

            <?php

                $sql_empresa = 'select * from pf_juridico order by id_pf_juridico ASC;';
                $resul_empresa = mysqli_query($conectar, $sql_empresa);

                while($dados_empresa = mysqli_fetch_array($resul_empresa)){
                    echo ('<div class="espacamento-lojas"><a href=""><article class="lojas">
                    <img src="../IMG/Imagem_Empresa/Logo_Empresa/'.$dados_empresa['imagem'].'" alt="'.$dados_empresa['nome'].'">
                    </article></a></div>');
                }

            ?>    

    </section>

    <!-- Categorias Lojas -->

    <section class="secao-categorias">
        <div class="categorias">
            <div class="espacamento-categoria">
                <a href="#">
                    <i class="fas fa-tshirt"></i>
                </a>
            </div>
            <div class="espacamento-categoria">    
                <a href="#">
                    <i class="fas fa-air-freshener"></i>
                </a>
            </div>
            <div class="espacamento-categoria">
                <a href="#">
                    <i class="fas fa-mug-hot"></i>
                </a>
            </div>    
            <div class="espacamento-categoria">
                <a href="#">
                    <i class="fas fa-leaf"></i>
                </a>
            </div>
            <div class="espacamento-categoria">
                <a href="#">
                    <i class="fas fa-soap"></i>
                </a>
            </div>
            <div class="espacamento-categoria">
                <a href="#">
                    <i class="fas fa-home"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Seção Produtos -->

    <section class="secao-produtos">
        <h2>Produtos mais pesquisados</h2>
        
        <div class="tamanho-produtos">
            <div class="espacamento-produtos">
                <a href="#"><article class="produtos">
                    <img src="../IMG/produto_1.png" alt="escova_de_dente">
                </article></a>
            </div>
            <div class="espacamento-produtos">
                <a href="#"><article class="produtos">
                    <img src="../IMG/produto_2.png" alt="sabonete">
                </article></a>
            </div>
            <div class="espacamento-produtos">
                <a href="#"><article class="produtos">
                    <img src="../IMG/produto_3.png" alt="eco_bag">
                </article></a>
            </div>
        </div>
    </section>
    <h2 id="todos-produtos"> Todos os Produtos </h2> <br>
    <section class="sessao-produtos">
        <?php
            $sql_select = 'SELECT * FROM produto ORDER BY id_produto ASC;';
            $sql_query = mysqli_query($conectar, $sql_select);

            while($dados_produto = mysqli_fetch_array($sql_query)){
                echo ('<div class="container-produtos"> <div class="info">  
                <img src="../IMG/Produtos/'.$dados_produto['imagem'].'" alt="'.$dados_produto['imagem'].'">  
                <span class="preco"> R$'.$dados_produto['preco'].'</span>
                <p><a href="produto.php?id_produto='.$dados_produto['id_produto'].'" class="descricao">'.$dados_produto['nome_produto'].'</a></p>
            </div> </div>');
            }
        ?>
        <div class="paginas">
            
        </div>
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
</body>
</html>