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

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/style-index.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-box-user.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style-pesquisar.css">
    <link rel="stylesheet" href="../CSS/style-sobre.css">
    <link rel="stylesheet" href="../FONTAW/css/all.css">
    <link rel="shortcut icon" href="../IMG/icone.ico" type="image/x-icon">
    <script type="text/javascript" src="../JS/script_box_user.js"></script>
    <title>Green Gate</title>

    <style type="text/css">
        .box-user{
            height: 17%;
        }

        .main-fundo-sobre svg{
            position: absolute;
            bottom: -28px;
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
                    <div class="search-box">
                        <form method="GET">
                            <input type="text" name="conteudo" placeholder="Pesquisar...">
                            <input type="submit" name="pesquisar" value=""><i class="fas fa-search"></i>
                        </form>
                    </div>
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

    <?php
        if(!isset($_GET['pesquisar'])){
    ?>
    
    <section class="main-fundo-sobre">
    <div class="container-sobre">
        <h1>Sobre Nós</h1>
        <p>O Green Gate é uma plataforma de venda de produtos sustentáveis que tem por objetivo <span class="enfase"> tornar o consumo sustentável um hábito na vida dos Brasileiros.</span></p>
    </div>

    <div class="img">
            <img src="../IMG/imagem_sobre.png" alt="natureza">
    </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9fdc5" fill-opacity="1" d="M0,160L60,149.3C120,139,240,117,360,133.3C480,149,600,203,720,234.7C840,267,960,277,1080,261.3C1200,245,1320,203,1380,181.3L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
    </section>

    <section class="texto-sobre">
        <div class="explicacao">
            <p>Com o Green Gate você pode comprar produtos sustentáveis do conforto de sua casa, além de ajudar microempreendedores e, claro, o Meio Ambiente.</p>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#fff" fill-opacity="1" d="M0,160L60,149.3C120,139,240,117,360,133.3C480,149,600,203,720,234.7C840,267,960,277,1080,261.3C1200,245,1320,203,1380,181.3L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
    </section>

    <section class="objetivos">
        <h2>Objetivos</h2>

        <div class="objetivo">
            <div class="geral">
                <div class="icon">
                    <i class="fas fa-leaf"></i>
                </div>
                
                <h3>Sustentabilidade</h3>
                <span>Populariza o consumo sustentável</span>
            </div>
            
            <div class="geral">
                <div class="icon">
                    <i class="fas fa-tractor"></i> 
                </div>

                <h3>Microempresas</h3>
                <span>Visibiliza o trabalho dos produtores</span>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f9fdc5" fill-opacity="1" d="M0,160L60,149.3C120,139,240,117,360,133.3C480,149,600,203,720,234.7C840,267,960,277,1080,261.3C1200,245,1320,203,1380,181.3L1440,160L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path></svg>
    </section>

    <section class="slogan">
        <div style="height: 350px; margin-bottom: 15px;">
            <p>"Green Gate, para quem se compromete com o Meio Ambiente"</p>
        </div>
    </section>

    <?php
    }else{

        $conteudo_lojas = $_GET['conteudo'];
        $sql_pesquisar_lojas = 'select * from pf_juridico where tp_usuario = 1 and nome LIKE "'.$conteudo_lojas.'%" ORDER by nome ASC;';
        $resul_pesquisar_lojas = mysqli_query($conectar,$sql_pesquisar_lojas);

        $conteudo_produtos = $_GET['conteudo'];
        $sql_pesquisar_produtos = 'select * from produto where nome_produto LIKE "'.$conteudo_produtos.'%" ORDER by nome_produto ASC;';
        $resul_pesquisar_produtos = mysqli_query($conectar,$sql_pesquisar_produtos);
    ?>

    <section class="conteudo-pesquisar">

    <h2>Lojas</h2>

    <div class="lojas-pesquisadas">
    
    <?php
        while($dados_pesquisar_lojas = mysqli_fetch_array($resul_pesquisar_lojas)){
            echo ('<div class="espacamento-lojas"><a href=""><article class="lojas">
            <img src="../IMG/Imagem_Usuario/'.$dados_pesquisar_lojas['imagem'].'" alt="'.$dados_pesquisar_lojas['nome'].'">
            </article></a></div>');
        }
    ?>

    </div>

    <h2>Produtos</h2>

    <div class="produtos_pesquisados">

    <?php
        while($dados_produto = mysqli_fetch_array($resul_pesquisar_produtos)){
            echo ('<div class="container-produtos"><a href="produto.php?id_produto='.$dados_produto['id_produto'].'" class="descricao"><div class="info">  
            <img src="../IMG/Imagem_Produtos/'.$dados_produto['imagem'].'" alt="'.$dados_produto['nome_produto'].'">  
            <span class="preco"> R$'.$dados_produto['preco'].'</span>
            <p>'.$dados_produto['nome_produto'].'</p>
        </div></a></div>');
        }
    ?>

    </div>

    </section>

    <?php
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