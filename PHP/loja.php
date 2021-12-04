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
        <title>Green Gate | Página Usuário</title>
        <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-produtor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pagina-usuario.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-painel-consumidor.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
        <link rel="stylesheet" type="text/css" href="../CSS/style-pesquisar.css">
        <link rel="stylesheet" href="../FONTAW/css/all.css">
        <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
        <script type="text/javascript" src="../JS/script_box_user.js"></script>

        <style type="text/css">
            .foto-usuario img{
                display: flex;
                justify-content: center;
            }
            
            .pagina-usuario {
                padding-top: 65px;
                height: 100%;
            }

            .exibir-produtos{
                display: flex;
                justify-content: left;
                margin: 50px 90px;
                margin-top: 0;
            }

            #titulo-produtos{
                margin: 35px 75px;
            }

            table{
                margin-bottom: 25px;
            }
        </style>
        
    </head>
    
    <body class="corpo-painel-produtor">

    <!-- Dados do Usuário -->
    
    <?php
        $id_empresa = $_GET['id_empresa'];
        $sql_empresa = 'select * from pf_juridico where id_pf_juridico = '.$id_empresa.';';
        $resul_empresa = mysqli_query($conectar, $sql_empresa);
        $dados_empresa = mysqli_fetch_array($resul_empresa);

    ?>

    <!-- Cabeçalho -->

        <section id="background-box">
            <div id="abrir">
                <nav class="box-user">
                    <ul>
                        <a href=" <?php echo($caminho_painel); ?>.php"><li class="list um">
                            <span><i class="fas fa-user-circle"></i>Perfil</span>
                        </li></a>
                        <a href="<?php echo($usuario); ?>/editar_perfil.php"><li class="list">
                            <span><i class="fas fa-cog"></i>Configurações</span>
                        </li></a>
                        <a href="invalido.php"><li style="border-top: 1px solid #ebebeb;" class="list dois">
                            <span>Sair</span>
                        </li></a>
                    </ul>
                </nav>
            </div>
        </section>

        <section class="main-nav-produtor">
            <nav>
                <div class="logo">
                    <figure>
                        <a href="index.php"><img src="../IMG/logotipo.png" alt="Logotipo"></a>
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

                <?php
                    if(!isset($_SESSION['id_usuario'])){
                ?>                    

                <div class="figuras" style="top: 40%;">
                    <a href="login.php"><i class="fas fa-user-circle"></i></a>
                    <a href=""><i class="fas fa-shopping-cart"></i></a>
                </div>

                <?php
                    }else{
                        
                    echo ('<div class="figuras" style="top: 30%;">
                        <div class="search-box">
                            <form action="" method="GET">
                                <input type="text" name="conteudo" placeholder="Pesquisar...">
                                <input type="submit" name="pesquisar" value=""><i class="fas fa-search"></i>
                            </form>
                        </div>
                        <a href="#" onclick="box()"><div class="usuario">
                            <img src="../IMG/Imagem_Usuario/'.$dados_usuario['imagem'].'">
                        </div></a>
                        <a href=""><i class="fas fa-shopping-cart"></i></a>
                    </div>');

                    }    
                ?>
            </nav>
        </section>
    </header>

    <!-- Conteúdo -->


    <section class="pagina-usuario" onclick="boxFechar()">  

    <div class="fundo-foto-usuario">
        <div class="foto-usuario">
            <?php echo ('<img src="../IMG/Imagem_Usuario/'.$dados_empresa['imagem'].'"alt="'.$dados_empresa['nome'].'"/>'); ?>
        </div>
    </div>

    <div class="nome-usuario">

    <?php

    echo $dados_empresa['nome'];

    ?>

    </div>

    <table>

        <tr>

            <div class="dados-usuario primeira">

            <td> Email: <?php echo $dados_empresa['email']; ?> </td>
            <td> CNPJ: <?php echo $dados_empresa['cnpj']; ?> </td>
            <td> Data de Cadastro: <?php echo $dados_empresa['data_cadastro']; ?> </td>    

            </div>

        </tr>

        <tr>    

            <div class="dados-usuario segunda">

            <td style="line-height: 22px;"> Razão Social: <?php echo $dados_empresa['razao']; ?> </td>

            <td> Gênero: 
                <?php if($dados_empresa['genero'] == 'M'){ echo ("Masculino"); }else if($dados_empresa['genero'] == 'F') { echo("Feminino");} else{echo('---');} ?> </td>
            <td> Telefone: <?php echo $dados_empresa['celular']; ?> </td>
                
            </div>

        </tr>    

    </table>
        
    </section>
    
    <h2 id="titulo-produtos">Produtos</h2>
    <section class="exibir-produtos">

        <?php
            $sql_select = 'select * from produto where id_produtor='.$id_empresa.' order by id_produto ASC;';
            $sql_query = mysqli_query($conectar, $sql_select);

            while($dados_produto = mysqli_fetch_array($sql_query)){
                echo ('<div class="container-produtos"><a href="produto.php?id_produto='.$dados_produto['id_produto'].'" class="descricao"><div class="info">  
                <img src="../IMG/Imagem_Produtos/'.$dados_produto['imagem'].'" alt="'.$dados_produto['nome_produto'].'">  
                <span class="preco"> R$'.$dados_produto['preco'].'</span>
                <p>'.$dados_produto['nome_produto'].'</p>
            </div></a></div>');
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