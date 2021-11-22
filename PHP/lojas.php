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
	<title>Green Gate | Lojas</title>
	<link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-lojas.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
    <link rel="stylesheet" href="../FONTAW/css/all.css">
    <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
    <script type="text/javascript" src="../JS/script_box_user.js"></script>

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

    <!-- Cabeçalho -->

        <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
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

    <!-- Banner -->
    <figure class="banner">    
        <img src="../IMG/banner.png">
    </figure>

    <!-- Seção de Lojas -->

    <section class="main-lojas">

            <?php

                $sql_empresa = 'select * from pf_juridico order by id_pf_juridico ASC;';
                $resul_empresa = mysqli_query($conectar, $sql_empresa);

                while($dados_empresa = mysqli_fetch_array($resul_empresa)){
                    echo ('<div class="espacamento-lojas"><a href=""><article class="lojas">
                    <img src="../IMG/Imagem_Usuario/'.$dados_empresa['imagem'].'" alt="'.$dados_empresa['nome'].'">
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
            $sql_select = 'select * from produto order by id_produto ASC;';
            $sql_query = mysqli_query($conectar, $sql_select);

            while($dados_produto = mysqli_fetch_array($sql_query)){
                echo ('<div class="container-produtos"><a href="produto.php?id_produto='.$dados_produto['id_produto'].'" class="descricao"><div class="info">  
                <img src="../IMG/Imagem_Produtos/'.$dados_produto['imagem'].'" alt="'.$dados_produto['nome_produto'].'">  
                <span class="preco"> R$'.$dados_produto['preco'].'</span>
                <p>'.$dados_produto['nome_produto'].'</p>
            </div></a></div>');
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