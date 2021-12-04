<html>
    <head>
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
        
                    $caminho = '?id_usuario='.$dados_usuario['id_pf_fisico'].'&tp_usuario='.$dados_usuario['tp_usuario'].';';
        
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
        
                    $caminho = '?id_usuario='.$dados_usuario['id_pf_juridico'].'&tp_usuario='.$dados_usuario['tp_usuario'].';';
        
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
        <link rel="stylesheet" type="text/css" href="../CSS/style-compra.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-lojas.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../JS/script_box_user.js"></script>
    </head>
    <body>
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

    <?php
        $sql = 'select * from produto where id_produto = '.$_GET['id_produto'].';';
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
                <div class="espaco-valor"> <span class="valor-preco"> <?php echo ('R$ '.$dados_produto['preco']); ?> </span> </div>
            </div>

            <div class="info-qtd"> 
                <div class="espaco-qtd-titulo"> <span> Quantidade </span> </div>
                
                <div class="espaco-qtd">
                    <span><?php echo($_GET['qtd'])?></span> 
                </div>
            </div>
        </div>
    </section>
    <section class="sessao-confirmar">
        <div class="container-confirmar">
            <?php
                $valor_total = $dados_produto['preco'] * $_GET['qtd'];
            ?>
            <div class="espaco-total"> <span class="valor-total"> Valor total: R$ <?php echo ($valor_total); ?> </span> </div> <br>
            <div class="espaco-continuar"> 
                <?php
                    echo(
                        "<a href='boleto.php?user=".$_SESSION['id_usuario']."&id_produto=".$dados_produto['id'].">Comprar</a>"
                    );
                ?>
            </div>
        </div>
    </section>
    
    <?php
        $id1 = $dados_produto['id_produto']++;
        $string = ('select * from produto;');
        $sql = mysqli_query($conectar, $string);
        $data = mysqli_fetch_array($sql);
    ?>

    <section class="compre-tbm">
        <div class="espaco-titulo-compre"> <span> Compre Também </span> </div>
        <div class="container-compre-tbm">
        <div> <img src="../IMG/Imagem_Produtos/<?php echo $dados_produto['imagem'];?>" alt="<?php echo $dados_produto['nome_produto'];?>"> </div>
        <div class="compre-container-info"> 
            <div class="compre-info"> <span id="nome-produto-compre"> <?php echo $dados_produto['nome_produto']; ?> </span> </div>         
            <div class="compre-info"> <span id="descricao-produto-compre"> <?php echo $dados_produto['descricao']; ?> </span> </div>
            <div class="compre-info"> <span id="preco-produto-compre"> <?php echo 'R$ '.$dados_produto['preco']; ?> </span> </div>
            <div class="espaco-compre-tbm"> <a href=""> Ver Produto </a> </div>
        </div>

        <div> <img src="../IMG/Imagem_Produtos/<?php echo $dados_produto['imagem'];?>" alt="<?php echo $dados_produto['nome_produto'];?>"> </div>
        <div class="compre-container-info"> 
            <div class="compre-info"> <span id="nome-produto-compre"> <?php echo $dados_produto['nome_produto']; ?> </span> </div>         
            <div class="compre-info"> <span id="descricao-produto-compre"> <?php echo $dados_produto['descricao']; ?> </span> </div>
            <div class="compre-info"> <span id="preco-produto-compre"> <?php echo 'R$ '.$dados_produto['preco']; ?> </span> </div>
            <div class="espaco-compre-tbm"> <a href=""> Ver Produto </a> </div>
        </div>

        <div> <img src="../IMG/Imagem_Produtos/<?php echo $dados_produto['imagem'];?>" alt="<?php echo $dados_produto['nome_produto'];?>"> </div>
        <div class="compre-container-info"> 
            <div class="compre-info"> <span id="nome-produto-compre"> <?php echo $dados_produto['nome_produto']; ?> </span> </div>         
            <div class="compre-info"> <span id="descricao-produto-compre"> <?php echo $dados_produto['descricao']; ?> </span> </div>
            <div class="compre-info"> <span id="preco-produto-compre"> <?php echo 'R$ '.$dados_produto['preco']; ?> </span> </div>
            <div class="espaco-compre-tbm"> <a href=""> Ver Produto </a> </div>
        </div>
        
        </div>
    </section>
    </body>
</html>